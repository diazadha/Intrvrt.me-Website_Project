<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function index()
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($user) {
            if ($user['id_role'] == 2) {
                redirect('home');
            } else {
                $data['content'] = "admin/dashboard";
                $this->load->view("template/adminlte", $data);
            }
        } else {
            redirect('home');
        }
    }
}
