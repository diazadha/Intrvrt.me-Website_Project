<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('BlogModel');
        $this->session->keep_flashdata('message');
    }

    public function index()
    {
        $data['title'] = 'BLOG';
        $data['post'] = $this->BlogModel->allpost();
        $data['kategori'] = $this->BlogModel->kategori();
        $this->load->view('template_introvert/header', $data);
        $this->load->view('blog', $data);
        $this->load->view('template_introvert/footer', $data);
    }

    public function p($slug)
    {
        $data['title'] = 'BLOG | '.$slug;
        $data['post'] = $this->BlogModel->post($slug);
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $this->load->view('template_introvert/header', $data);
        $this->load->view('single_blog', $data);
        $this->load->view('template_introvert/footer', $data);
    }
    
    public function kategori($idkategori)
    {
        $data['title'] = 'BLOG';
        $data['post'] = $this->BlogModel->allpostby($idkategori);
        $data['kategori'] = $this->BlogModel->kategori();
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $this->load->view('template_introvert/header', $data);
        $this->load->view('blog', $data);
        $this->load->view('template_introvert/footer', $data);
    }
}
