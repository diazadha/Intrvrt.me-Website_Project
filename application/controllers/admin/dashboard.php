<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function index()
    {
        $this->load->view('template/header');
        $this->load->view('admin/dashboard');
        $this->load->view('template/footer');
    }

    public function register_admin()
    {
        $this->load->view('template/header');
        $this->load->view('admin/register_admin');
        $this->load->view('template/footer');
    }
}
