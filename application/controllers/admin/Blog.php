<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{
    public function index()
    {
        $data['content'] = "admin/profil_perusahaan";
		$this->load->view("template/adminlte", $data);
    }

    public function kategori()
    {
        $data['content'] = "admin/profil_perusahaan";
		$this->load->view("template/adminlte", $data);
    }
}