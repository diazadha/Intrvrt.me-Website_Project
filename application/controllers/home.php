<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $this->load->view('template_introvert/header');
        $this->load->view('home');
        $this->load->view('template_introvert/footer');
    }

    public function registrasi()
    {
        $this->load->view('template_introvert/header');
        $this->load->view('registrasi');
        $this->load->view('template_introvert/footer');
    }

    public function login()
    {
        $this->load->view('template_introvert/header');
        $this->load->view('login');
        $this->load->view('template_introvert/footer');
    }

}
