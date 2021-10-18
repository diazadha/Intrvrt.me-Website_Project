<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SettingModel');
    }

    public function sosial_media(){
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($user) {
            if ($user['id_role'] == 2) {
                redirect('home');
            } else {
                $data['profil'] = $this->db->get('profile_perusahaan')->row();
                $data['content'] = "admin/sosial_media";
                $data['js'] = array("sosial_media.js?r=" . rand());
                $this->load->view("template/adminlte", $data);
            }
        } else {
            redirect('home');
        }
    }

    public function sosial_media_()
    {
        $list = $this->SettingModel->sosmed_data();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = '<img src="' . $field->icon . '" class="img-thumbnail" width="200">';
            $row[] = $field->sosmed;
            $row[] = $field->url;
            $row[] = ($field->status == 1) ? '<span class="badge badge-success">On</span>' : '<span class="badge badge-danger">Off</span>';
            $row[] = '<button type="button" class="btn btn-info btn-sm edit" data-id="' . $field->id_sosmed . '" data-foto="' . $field->icon . '" data-sosmed="' . $field->sosmed . '" data-status="' . $field->status . '" data-url="'. $field->url . '">Edit</button>
                      <button type="button" class="ml-1 btn btn-danger delete btn-sm" data-id="' . $field->id_sosmed . '" data-sosmed="' . $field->sosmed . '">Hapus</button>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->SettingModel->count_all_sosmed(),
            "recordsFiltered" => $this->SettingModel->count_sosmed_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function create_sosmed()
    {
        if ($_FILES["foto"]["name"]) {
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '2024';
            $config['upload_path'] = './assets/sosmed';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('admin/sosmed/index');
            } else {
                $fileupload = $this->upload->data();
                $filename = pathinfo($fileupload['full_path']);
                $foto = base_url('assets/sosmed/' . $filename['basename']);
            }
        } else {
            $foto = null;
        }

        if (!$this->SettingModel->create_sosmed($foto)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan sosmed</div>');
            redirect('admin/sosmed/index');
        }
    }

    public function update_sosmed()
    {
        if ($_FILES["foto"]["name"]) {
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '2024';
            $config['upload_path'] = './assets/sosmed';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('admin/sosmed/index');
            } else {
                $fileupload = $this->upload->data();
                $filename = pathinfo($fileupload['full_path']);
                $foto = base_url('assets/sosmed/' . $filename['basename']);
            }
        } else {
            $foto = $this->input->post('foto_');
            $is_unlink = 'no';
        }

        if (!$this->SettingModel->update_sosmed($foto, $is_unlink)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal update data sosmed</div>');
            redirect('admin/sosmed/index');
        }
    }

    function delete_sosmed($id)
    {
        $id_ = htmlspecialchars($id, ENT_QUOTES);
        if ($this->SettingModel->delete_sosmed($id_)) {
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

    public function perusahaan()
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($user) {
            if ($user['id_role'] == 2) {
                redirect('home');
            } else {
                $data['profil'] = $this->db->get('profile_perusahaan')->row();
                $data['content'] = "admin/profil_perusahaan";
                $data['js'] = array("profil.js?r=" . rand());
                $this->load->view("template/adminlte", $data);
            }
        } else {
            redirect('home');
        }
    }

    function update_perusahaan()
    {
        $upload = $_FILES['logo']['name'];
        if ($upload) {
            $src = $this->input->post('logo_');
            $file_name = str_replace(base_url(), '', $src);
            unlink($file_name);

            $config['allowed_types']    = 'jpg|png|jpeg';
            $config['max_size']         = '2024';
            $config['upload_path']      = './assets/perusahaan';
            $config['encrypt_name']     = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('logo')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('message', '<div class="alert tutup alert-danger" role="alert">' . $error['error'] . '</div>');
                redirect('admin/profil/perusahaan');
            } else {
                $fileupload = $this->upload->data();
                $filename = pathinfo($fileupload['full_path']);
                $logo = base_url('assets/perusahaan/' . $filename['basename']);
                $result = $this->SettingModel->updateProfilPerusahaan($logo);
            }
        } else {
            $logo = $this->input->post('logo_');
            $result = $this->SettingModel->updateProfilPerusahaan($logo);
        }

        if ($result) {
            $this->session->set_flashdata('message', '<div class="alert tutup alert-success" role="alert">Profil perusahaan berhasil di update!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert tutup alert-danger" role="alert">Error!</div>');
        }
        redirect('admin/profil/perusahaan');
    }
}
