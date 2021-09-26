<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BlogModel');
    }

    public function index()
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($user) {
            if ($user['id_role'] == 2) {
                redirect('home');
            } else {
                $data['content'] = "admin/blog_konten";
                $data['js'] = array("blog_konten.js?r=" . rand());
                $this->load->view("template/adminlte", $data);
            }
        } else {
            redirect('home');
        }
    }

    public function create()
    {
        $data['content'] = "admin/blog_create";
        $data['kategori'] = $this->BlogModel->get_kategori();
        $data['js'] = array("blog_create.js?r=" . rand());
        $this->load->view("template/adminlte", $data);
    }

    public function edit($id)
    {
        $cekid = $this->db->get_where('blog_data', ['id_blog' => $id])->num_rows();
        if ($cekid > 0) {
            $data['content'] = "admin/blog_edit";
            $data['js'] = array("blog_edit.js?r=" . rand());
            $data['konten'] = $this->BlogModel->get_konten($id);
            $data['kategori'] = $this->BlogModel->get_kategori();
            $this->load->view("template/adminlte", $data);
        } else {
            echo 'Error 404 Not Found';
            die;
        }
    }

    public function create_()
    {
        $upload = $_FILES['foto']['name'];
        if ($upload) {
            $nmfile = date('YmdHis');
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '2024';
            $config['upload_path'] = './assets/blog';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('message', '<div class="alert tutup alert-danger" role="alert">' . $error['error'] . '</div>');
                redirect('admin/blog/create');
            } else {
                $fileupload = $this->upload->data();
                $filename = pathinfo($fileupload['full_path']);
                $foto = base_url('assets/blog/' . $filename['basename']);
            }
        } else {
            $foto = null;
        }

        $result = $this->BlogModel->konten_add($foto);
        if ($result) {
            $this->session->set_flashdata('message', '<div class="alert tutup alert-success" role="alert">Konten Blog berhasil ditambahkan!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert tutup alert-danger" role="alert">Error!</div>');
        }
        redirect('admin/blog/');
    }

    public function update_()
    {
        $upload = $_FILES['foto']['name'];
        if ($upload) {
            //unlink file sebelumnya
            $src = $this->input->post('foto_');
            $file_name = str_replace(base_url(), '', $src);
            unlink($file_name);

            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '2024';
            $config['upload_path'] = './assets/blog';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('message', '<div class="alert tutup alert-danger" role="alert">' . $error['error'] . '</div>');
                redirect('admin/blog/create');
            } else {
                $fileupload = $this->upload->data();
                $filename = pathinfo($fileupload['full_path']);
                $foto = base_url('assets/blog/' . $filename['basename']);
            }
        } else {
            $foto = $this->input->post('foto_');
        }

        $result = $this->BlogModel->konten_update($foto);
        if ($result) {
            $this->session->set_flashdata('message', '<div class="alert tutup alert-success" role="alert">Konten Blog berhasil di Update!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert tutup alert-danger" role="alert">Error!</div>');
        }
        redirect('admin/blog/');
    }

    function delete_image()
    {
        $src = $this->input->post('src');
        $file_name = str_replace(base_url(), '', $src);
        if (unlink($file_name)) {
            echo 'File Delete Successfully';
        }
    }

    function upload_image()
    {
        if ($_FILES["image"]["name"]) {
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '2024';
            $config['upload_path'] = './assets/blog/img-konten';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('message', '<div class="alert tutup alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('admin/blog/create');
            } else {
                $fileupload = $this->upload->data();
                $filename = pathinfo($fileupload['full_path']);
                echo base_url('assets/blog/img-konten/' . $filename['basename']);
            }
        }
    }

    public function update()
    {
        $data['content'] = "admin/blog_update";
        $data['kategori'] = $this->BlogModel->get_kategori();
        $this->load->view("template/adminlte", $data);
    }

    public function konten_()
    {
        $list = $this->BlogModel->konten_data();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->judul . '<br>' . $this->BlogModel->get_kategori_IN($field->kategori, 'html') . '<br><i class="fas fa-user-circle"></i> ' . $field->nama_penulis . ', ' . $this->UserModel->format_tanggal($field->tanggal_dibuat);
            $row[] = ($field->status == 1) ? '<span class="badge badge-success">Published</span>' : '<span class="badge badge-secondary">Draft</span>';
            $row[] = '<a href="' . base_url('admin/blog/edit/' . $field->id_blog) . '" class="btn btn-info btn-sm">Edit</a>
                      <button type="button" class="ml-1 btn btn-danger delete btn-sm" data-id="' . $field->id_blog . '" data-judul="' . $field->judul . '">Hapus</button>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->BlogModel->count_all_konten(),
            "recordsFiltered" => $this->BlogModel->count_konten_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function konten_delete($id)
    {
        $cekid = $this->db->get_where('blog_data', ['id_blog' => $id]);
        if ($cekid->num_rows() == 0) {
            echo 'Error';
            die;
        } else {
            //unlink file sebelumnya
            $src = $cekid->row()->foto;
            $file_name = str_replace(base_url(), '', $src);
            unlink($file_name);

            if ($this->BlogModel->konten_delete($id)) {
                $r['title'] = 'Sukses!';
                $r['icon'] = 'success';
                $r['status'] = 'Berhasil di Hapus!';
            } else {
                $r['title'] = 'Maaf!';
                $r['icon'] = 'error';
                $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
            }
            echo json_encode($r);
        }
    }

    public function kategori()
    {
        $data['content'] = "admin/blog_kategori";
        $data['js'] = array("blog_kategori.js?r=" . rand());
        $this->load->view("template/adminlte", $data);
    }

    public function kategori_()
    {
        $list = $this->BlogModel->kategori_data();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->nama_kategori;
            $row[] = ($field->status == 1) ? '<span class="badge badge-success">On</span>' : '<span class="badge badge-danger">Off</span>';
            $row[] = '<button type="button" class="btn btn-info btn-sm edit" data-id="' . $field->id_kategori . '" data-kategori="' . $field->nama_kategori . '" data-status="' . $field->status . '">Edit</button>
                      <button type="button" class="ml-1 btn btn-danger delete btn-sm" data-id="' . $field->id_kategori . '" data-kategori="' . $field->nama_kategori . '">Hapus</button>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->BlogModel->count_all_kategori(),
            "recordsFiltered" => $this->BlogModel->count_kategori_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function kategori_add()
    {
        if ($this->BlogModel->kategori_add()) {
            $d['status'] = true;
        } else {
            $d['status'] = false;
        }
        echo json_encode($d);
    }

    public function kategori_update()
    {
        if ($this->BlogModel->kategori_update()) {
            $d['status'] = true;
        } else {
            $d['status'] = false;
        }
        echo json_encode($d);
    }

    public function kategori_delete($id)
    {
        $cekid = $this->db->get_where('blog_kategori', ['id_kategori' => $id])->num_rows();
        if ($cekid == 0) {
            echo 'Error';
            die;
        } else {
            $result = $this->BlogModel->kategori_delete($id);
            if ($result == 'sukses') {
                $r['title'] = 'Sukses!';
                $r['icon'] = 'success';
                $r['status'] = 'Berhasil di Hapus!';
            } else if ($result == 'gagal') {
                $r['title'] = 'Gagal!';
                $r['icon'] = 'error';
                $r['status'] = 'Tidak dapat di Hapus, karena kategori ini dipakai pada konten Blog!';
            } else {
                $r['title'] = 'Maaf!';
                $r['icon'] = 'error';
                $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
            }
            echo json_encode($r);
        }
    }
}
