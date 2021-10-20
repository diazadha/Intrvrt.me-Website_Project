<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Merchandise extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MerchandiseModel');
    }

    public function index()
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($user) {
            if ($user['id_role'] == 2) {
                redirect('home');
            } else {
                $data['profil'] = $this->db->get('profile_perusahaan')->row();
                $data['content'] = "admin/merchandise";
                $data['js'] = array("merchandise.js?r=" . rand());
                $this->load->view("template/adminlte", $data);
            }
        } else {
            redirect('home');
        }
    }

    public function kategori()
    {
        $data['profil'] = $this->db->get('profile_perusahaan')->row();
        $data['content'] = "admin/merchandise_kategori";
        $data['js'] = array("merchandise_kategori.js?r=" . rand());
        $this->load->view("template/adminlte", $data);
    }

    public function kategori_()
    {
        $list = $this->MerchandiseModel->kategori_data();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->nama_kategori_merch;
            $row[] = ($field->status == 1) ? '<span class="badge badge-success">On</span>' : '<span class="badge badge-danger">Off</span>';
            $row[] = '<button type="button" class="btn btn-info btn-sm edit" data-id="' . $field->id_kategori_merch . '" data-kategori="' . $field->nama_kategori_merch . '" data-status="' . $field->status . '">Edit</button>
                      <button type="button" class="ml-1 btn btn-danger delete btn-sm" data-id="' . $field->id_kategori_merch . '" data-kategori="' . $field->nama_kategori_merch . '">Hapus</button>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->MerchandiseModel->count_all_kategori(),
            "recordsFiltered" => $this->MerchandiseModel->count_kategori_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function kategori_add()
    {
        if ($this->MerchandiseModel->kategori_add()) {
            $d['status'] = true;
        } else {
            $d['status'] = false;
        }
        echo json_encode($d);
    }

    public function kategori_update()
    {
        if ($this->MerchandiseModel->kategori_update()) {
            $d['status'] = true;
        } else {
            $d['status'] = false;
        }
        echo json_encode($d);
    }

    public function kategori_delete($id)
    {
        $cekid = $this->db->get_where('merchandise_kategori', ['id_kategori_merch' => $id])->num_rows();
        if ($cekid == 0) {
            echo 'Error';
            die;
        } else {
            $result = $this->MerchandiseModel->kategori_delete($id);
            if ($result == 'sukses') {
                $r['title'] = 'Sukses!';
                $r['icon'] = 'success';
                $r['status'] = 'Berhasil di Hapus!';
            } else if ($result == 'gagal') {
                $r['title'] = 'Gagal!';
                $r['icon'] = 'error';
                $r['status'] = 'Tidak dapat di Hapus, karena kategori ini dipakai pada Merchandise!';
            } else {
                $r['title'] = 'Maaf!';
                $r['icon'] = 'error';
                $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
            }
            echo json_encode($r);
        }
    }

    public function merchandise_()
    {
        $list = $this->MerchandiseModel->merchandise_data();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->nama_merch;
            $row[] = $field->nama_kategori_merch;
            $row[] = $field->stock;
            $row[] = $field->harga;
            $row[] = $field->diskon;
            $row[] = '<a class="btn btn-info btn-sm" href="' . base_url("admin/merchandise/edit/") . $field->id_merch .'/'. $field->foto .'">Edit</a>
                      <button type="button" class="ml-1 btn btn-danger delete btn-sm" data-id="' . $field->id_merch . '" data-merchandise="' . $field->nama_merch . '" data-group="' . $field->foto .'">Hapus</button>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->MerchandiseModel->count_all_merchandise(),
            "recordsFiltered" => $this->MerchandiseModel->count_merchandise_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function merchandise_add()
    {
        if ($this->MerchandiseModel->merchandise_add()) {
            $d['status'] = true;
        } else {
            $d['status'] = false;
        }
        echo json_encode($d);
    }

    public function merchandise_update()
    {
        if ($this->MerchandiseModel->merchandise_update()) {
            $d['status'] = true;
        } else {
            $d['status'] = false;
        }
        echo json_encode($d);
    }

    public function merchandise_delete($id,$group)
    {
        $cekid          = $this->db->get_where('merchandise', ['id_merch' => $id])->num_rows();
        $detail         = $this->db->get_where('foto_merchandise', ['group_foto' => $group]);
        if ($cekid == 0) {
            echo 'Error';
            die;
        } else {
            
            if ($this->MerchandiseModel->merchandise_delete($id)) {
                $detail = $this->MerchandiseModel->detailfoto($group);
                foreach ($detail as $dt) {
                    $file_name = './assets/uploads/foto_merchandise/' . $dt['foto'];
                    unlink($file_name);
                }
                $this->MerchandiseModel->foto_delete($group);
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

    public function tambah()
    {
        $data['profil'] = $this->db->get('profile_perusahaan')->row();
        $data['merch'] = $this->db->get('merchandise')->row();
        $data['content'] = "admin/tambah_merch";
        $data['js'] = array("merchandise.js?r=" . rand());
        $data['kategori'] = $this->MerchandiseModel->datakategori()->result_array();
        $this->load->view("template/adminlte", $data);
    }

    public function tambah_merch()
    {
        $upload = $_FILES['foto']['name'];
        if ($upload) {
            $numberOfFile = sizeof($upload);
            $files = $_FILES['foto'];
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['upload_path']      = './assets/uploads/foto_merchandise';
            $config['encrypt_name']     = TRUE;
            $this->load->library('upload', $config);
            if ($numberOfFile <= 5){
                for ($i = 0; $i < $numberOfFile; $i++) {
                    $_FILES['foto']['name'] = $files['name'][$i];
                    $_FILES['foto']['type'] = $files['type'][$i];
                    $_FILES['foto']['tmp_name'] = $files['tmp_name'][$i];
                    $_FILES['foto']['error'] = $files['error'][$i];
                    $_FILES['foto']['size'] = $files['size'][$i];
    
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('foto')) {
                        $data = $this->upload->data();
                        $fotoName = $data['file_name'];
                        $cek = $this->MerchandiseModel->cekData();
                        if (!$cek) {
                            $group_foto = 1;
                        } else {
                            $group_foto = $cek['group_foto'] + 1;
                        }
                        $insert[$i]['foto'] = $fotoName;
                        $insert[$i]['group_foto'] = $group_foto;
                        $insert[$i]['date_created'] = date('d-m-Y H:i:s');
                    }
                }
            } else{
                $this->session->set_flashdata('message', '<div class="alert tutup alert-warning" role="alert">Upload Maksimal 5 foto</div>');
                redirect('admin/merchandise');
            }
            
            if (!$insert && !$data) {
                $this->session->set_flashdata('message', '<div class="alert tutup alert-warning" role="alert">Tidak ada data yang disimpan</div>');
                redirect('admin/merchandise');
            } else {
                if ($this->MerchandiseModel->upload($insert, $data['file_name']) > 0) {
                    $lastid = $this->MerchandiseModel->cekData();
                    $this->MerchandiseModel->tambah_merchandise($group_foto,$lastid['id']);
                    $this->session->set_flashdata('message', '<div class="alert tutup alert-success" role="alert">Merchandise Berhasil Di Tambah!</div>');
                    redirect('admin/merchandise');
                } else {

                    $this->session->set_flashdata('message', '<div class="alert tutup alert-danger" role="alert">Error!</div>');
                    redirect('admin/merchandise');
                }
            }
        }
    }

    public function edit($id,$group)
    {
        $data['profil'] = $this->db->get('profile_perusahaan')->row();
        $data['merch'] = $this->MerchandiseModel->view_join($id)->row();
        $data['js'] = array("merchandise.js?r=" . rand());
        $data['content'] = "admin/edit_merch";
        $data['multiple_foto'] =  $this->MerchandiseModel->getFotoGroup($group);
        $data['kategori'] = $this->MerchandiseModel->datakategori()->result_array();
        $this->load->view("template/adminlte", $data);
    }

    public function edit_merch()
    {
        $id_merch   = $this->input->post('id_merch');
        $result     = $this->MerchandiseModel->update_merch();
        $group      = $this->input->post('group');
        if ($result) {
            $this->session->set_flashdata('message', '<div class="alert tutup alert-success" role="alert">Merchandise Berhasil Di Update!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert tutup alert-danger" role="alert">Error!</div>');
        }
        redirect(base_url('admin/merchandise/edit/') . $id_merch .'/'.$group);
    }

    public function update_gambar($id)
    {

        $id_merch                   = $this->input->post('id_merch');
        $group                      = $this->input->post('group');
        $config['upload_path']      = './assets/uploads/foto_merchandise/';
        $config['allowed_types']    = 'jpg|jpeg|png|gif|ico|jfif';
        $config['encrypt_name']     = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $field_name = 'foto';
        if (!$this->upload->do_upload($field_name)) {
            echo "Gagal Update Gambar !";
        } else {
            $detail                     = $this->db->get_where('foto_merchandise', array('id' => $id))->row();
            $path                       = './assets/uploads/foto_merchandise/' . $detail->foto;
            unlink($path);
            $fileupload = $this->upload->data();
            $filename   = pathinfo($fileupload['full_path']);
            $foto       = $filename['basename'];
            $result     = $this->MerchandiseModel->update_foto($foto, $id);
        }
        if ($result) {
            $this->session->set_flashdata('message', '<div class="alert tutup alert-success" role="alert">Foto Berhasil Di Update!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert tutup alert-danger" role="alert">Error!</div>');
        }
        redirect(base_url('admin/merchandise/edit/') . $id_merch .'/'.$group);
    }
}
