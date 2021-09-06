<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{
    public function index()
    {
        $data['content'] = "admin/profile_account";
		$this->load->view("template/adminlte", $data);
    }
}
