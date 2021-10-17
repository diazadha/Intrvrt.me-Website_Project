<?php

defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
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
        $data['title'] = 'About Us';
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $data['sosmed'] = $this->db->get_where('sosmed', ['status' => 1])->result();
        $this->load->view('template_introvert/header', $data);
        $this->load->view('about', $data);
        $this->load->view('template_introvert/footer', $data);
    }
}
