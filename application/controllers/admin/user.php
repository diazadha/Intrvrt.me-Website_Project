<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function index()
    {
        $data['content'] = "admin/register_admin";
        $this->load->view("template/adminlte", $data);
    }

    public function register_superadmin()
    {
        $this->form_validation->set_rules('nama', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email sudah pernah digunakan!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password telalu pendek minimal 6 karakter'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'matches[password1]');

        $this->form_validation->set_rules('jenis-kelamin', 'Name', 'required|trim');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['content'] = "admin/register_admin";
            $this->load->view("template/adminlte", $data);
        } else {
            date_default_timezone_set('Asia/Jakarta');
            $data = [
                'nama_user' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash(
                    $this->input->post('password1'),
                    PASSWORD_DEFAULT
                ),
                'foto_user' => 'default.jpg',
                'jenis_kelamin' => $this->input->post('jenis-kelamin', true),
                'tanggal_lahir' => $this->input->post('tanggal', true),
                'id_role' => 1,
                'is_active' => 1,
                'date_created' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message1', 'Akun Sudah Berhasil Dibuat!');
            redirect('admin/user');
        }
    }
}
