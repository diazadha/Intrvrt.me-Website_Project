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
        redirect('home');
    }

    public function p($slug){
        $data['title'] = '';
        $data['post'] = $this->BlogModel->post($slug);
        $this->load->view('template_introvert/header', $data);
        $this->load->view('single_blog', $data);
        $this->load->view('template_introvert/footer', $data);
    }
}