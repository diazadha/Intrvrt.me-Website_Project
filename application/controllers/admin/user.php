<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function register_admin()
    {
        $data['content'] = "admin/register_admin";
		$this->load->view("template/adminlte", $data);
    }
}
