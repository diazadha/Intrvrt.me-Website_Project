<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{
    public function index()
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($user) {
            if ($user['id_role'] == 2) {
                redirect('home');
            } else {
                $data['content'] = "admin/profile_account";
                $data['data_user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
                $this->load->view("template/adminlte", $data);
            }
        } else {
            redirect('home');
        }
    }

    public function update_profile()
    {
        if (!$this->input->post('password')) {
            $this->form_validation->set_rules('nama', 'Name', 'required|trim');
            $this->form_validation->set_rules('jenis-kelamin', 'Name', 'required|trim');
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');

            if ($this->form_validation->run() == false) {
                $data['content'] = "admin/profile_account";
                $data['data_user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
                $this->load->view("template/adminlte", $data);
            } else {
                date_default_timezone_set('Asia/Jakarta');
                $data = [
                    'nama_user' => htmlspecialchars($this->input->post('nama', true)),
                    'email' => htmlspecialchars($this->input->post('email', true)),
                    'jenis_kelamin' => $this->input->post('jenis-kelamin', true),
                    'tanggal_lahir' => $this->input->post('tanggal', true),
                ];
                $this->db->where('id_user', $this->input->post('id_user'));
                $this->db->update('user', $data);
                $this->session->set_flashdata('message1', 'Update Berhasil!');
                redirect('admin/account');
            }
        } else {
            $this->form_validation->set_rules('nama', 'Name', 'required|trim');
            $this->form_validation->set_rules('jenis-kelamin', 'Name', 'required|trim');
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]', [
                'min_length' => 'Password telalu pendek minimal 6 karakter'
            ]);
            if ($this->form_validation->run() == false) {
                $data['content'] = "admin/profile_account";
                $data['data_user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
                $this->load->view("template/adminlte", $data);
            } else {
                date_default_timezone_set('Asia/Jakarta');
                $data = [
                    'nama_user' => htmlspecialchars($this->input->post('nama', true)),
                    'email' => htmlspecialchars($this->input->post('email', true)),
                    'password' => password_hash(
                        $this->input->post('password'),
                        PASSWORD_DEFAULT
                    ),
                    'jenis_kelamin' => $this->input->post('jenis-kelamin', true),
                    'tanggal_lahir' => $this->input->post('tanggal', true),
                ];
                $this->db->where('id_user', $this->input->post('id_user'));
                $this->db->update('user', $data);
                $this->session->set_flashdata('message1', 'Update Berhasil!');
                redirect('admin/account');
            }
        }
    }

    public function update_foto_profile()
    {
        $foto_user        = $_FILES['foto']['name'];
        $id_user           = $this->input->post('id_user');
        if ($foto_user) {
            $config['upload_path']       = './assets/uploads/user';
            $config['allowed_types']     = 'jpg|jpeg|png|gif';
            $config['maintain_ratio']    = TRUE;

            $this->load->library('image_lib', $config);
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('message4', 'Update Foto Gagal!');
                redirect('admin/account');
            } else {
                $this->session->set_flashdata('message3', 'Update Foto Berhasil!');
                $foto_user = $this->upload->data('file_name');
            }

            $this->db->set('foto_user', $foto_user);
            $this->db->where('id_user', $id_user);
            $this->db->update('user');
            redirect('admin/account');
        }
    }
}
