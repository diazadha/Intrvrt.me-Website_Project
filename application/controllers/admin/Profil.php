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
        $data['profil'] = $this->db->get('profile_perusahaan')->row();
        $data['content'] = "admin/profil_perusahaan";
		$this->load->view("template/adminlte", $data);
    }

    function update_perusahaan()
    {
        $upload = $_FILES['logo']['name'];
        if ($upload) {
            $config['allowed_types']    = 'jpg|png|jpeg';
            $config['max_size']         = '2024';
            $config['upload_path']      = './assets/perusahaan';
            $config['encrypt_name']     = TRUE;
            $this->load->library('upload', $config);
            if (! $this->upload->do_upload('logo')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $error['error'] . '</div>');
                redirect('admin/profil/perusahaan');
            } else {
                $fileupload = $this->upload->data();
                $filename = pathinfo($fileupload['full_path']);
                $logo = base_url('assets/perusahaan/'.$filename['basename']);
                $result = $this->SettingModel->updateProfilPerusahaan($logo);
            }
        }else{
            $logo = $this->input->post('logo_');
            $result = $this->SettingModel->updateProfilPerusahaan($logo);
        }

        if($result){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil perusahaan berhasil di update!</div>');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error!</div>');
        }
        redirect('admin/profil/perusahaan');
    }
}
