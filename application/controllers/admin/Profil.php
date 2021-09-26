<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SettingModel');
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
