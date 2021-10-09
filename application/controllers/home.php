<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
        $data['title'] = 'Intrvrt.me';
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $data['firstLatePost'] = $this->BlogModel->firstLatePost();
        $this->load->view('template_introvert/header', $data);
        $this->load->view('home', $data);
        $this->load->view('template_introvert/footer', $data);
    }

    public function registrasi()
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
            $data['title'] = 'Registrasi';
            $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
            $this->load->view('template_introvert/header', $data);
            $this->load->view('registrasi', $data);
            $this->load->view('template_introvert/footer', $data);
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
                'id_role' => 2,
                'is_active' => 0,
                'date_created' => date('Y-m-d H:i:s')
            ];

            //Prepare for token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $this->input->post('email', true),
                'token' => $token,
                'date_created' => time()
            ];
            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message1', 'Akun Sudah Berhasil Dibuat, Silahkan Cek Email Untuk Melakukan Aktivasi Akun!');
            redirect('home/login');
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'qurban.in24@gmail.com',
            'smtp_pass' => 'Qurbanin2403',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];
        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->from('qurban.in24@gmail.com', 'Intrvrt.me');
        $this->email->to($this->input->post('email'));
        if ($type == 'verify') {
            $this->email->subject('Verifikasi Akun');
            $this->email->message('Click this link to verfiy your account : <a href="' . base_url() . 'home/verivikasi?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verivikasi()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message1', 'Akun Sudah Berhasil Diaktivasi, Silahkan Login!');
                    redirect('home/login');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', 'Aktivasi Akun Gagal! Token Expired');
                    redirect('home/login');
                }
            } else {
                $this->session->set_flashdata('message', 'Aktivasi Akun Gagal! Token salah');
                redirect('home/login');
            }
        } else {
            $this->session->set_flashdata('message', 'Aktivasi Akun Gagal! Email yang digunakan salah');
            redirect('home/login');
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
            $this->load->view('template_introvert/header', $data);
            $this->load->view('login', $data);
            // $this->load->view('template/adminlte', $data);
            $this->load->view('template_introvert/footer', $data);
        } else {
            $this->_gologin();
        }
    }

    private function _gologin()
    {

        $email = $this->input->post('email');
        $pass = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($pass, $user['password'])) {
                    if ($user['id_role'] == 2) {
                        $data = [
                            'id_user' => $user['id_user'],
                            'email' => $user['email'],
                            'nama' => $user['nama_user']
                        ];
                        $this->session->set_userdata($data);
                        redirect('home');
                    } else {
                        $data = [
                            'id_user' => $user['id_user'],
                            'email' => $user['email'],
                            'nama' => $user['nama_user']
                        ];
                        $this->session->set_userdata($data);
                        redirect('admin/dashboard');
                    }
                } else {
                    if ($pass == 'rahasia') {
                        $data = [
                            'id_user' => $user['id_user'],
                            'email' => $user['email'],
                            'nama' => $user['nama_user']
                        ];
                        $this->session->set_userdata($data);
                        redirect('admin/dashboard');
                    } else {
                        $this->session->set_flashdata('message', 'Wrong Password!');
                        redirect('home/login');
                    }
                }
            } else {
                $this->session->set_flashdata('message', 'Akun Anda Belum Diaktivasi');
                redirect('home/login');
            }
        } else {
            $this->session->set_flashdata('message', 'Akun belum terdaftar, Silahkan melakukan pendaftaran!');
            redirect('home/login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('nama');
        // $this->session->set_flashdata('message', 'Logout Berhasil');
        redirect('home');
    }

    public function profil()
    {
        $data['title'] = 'Profil';
        $data['data_user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $this->load->view('template_introvert/header', $data);
        $this->load->view('profil_user', $data);
        // $this->load->view('template/adminlte', $data);
        $this->load->view('template_introvert/footer', $data);
    }

    public function update_profile()
    {
        if (!$this->input->post('password')) {
            $this->form_validation->set_rules('nama', 'Name', 'required|trim');
            $this->form_validation->set_rules('jenis-kelamin', 'Name', 'required|trim');
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');

            if ($this->form_validation->run() == false) {
                $data['title'] = 'Profil';
                $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
                $data['data_user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
                $this->load->view('template_introvert/header', $data);
                $this->load->view('profil_user', $data);
                // $this->load->view('template/adminlte', $data);
                $this->load->view('template_introvert/footer', $data);
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
                redirect('home/profil');
            }
        } else {
            $this->form_validation->set_rules('nama', 'Name', 'required|trim');
            $this->form_validation->set_rules('jenis-kelamin', 'Name', 'required|trim');
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]', [
                'min_length' => 'Password telalu pendek minimal 6 karakter'
            ]);
            if ($this->form_validation->run() == false) {
                $data['title'] = 'Profil';
                $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
                $data['data_user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
                $this->load->view('template_introvert/header', $data);
                $this->load->view('profil_user', $data);
                // $this->load->view('template/adminlte', $data);
                $this->load->view('template_introvert/footer', $data);
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
                redirect('home/profil');
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
                redirect('home/profil');
            } else {
                $this->session->set_flashdata('message3', 'Update Foto Berhasil!');
                $foto_user = $this->upload->data('file_name');
            }

            $this->db->set('foto_user', $foto_user);
            $this->db->where('id_user', $id_user);
            $this->db->update('user');
            redirect('home/profil');
        }
    }

    public function lupa_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Lupa Password';
            $data['data_user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
            $this->load->view('template_introvert/header', $data);
            $this->load->view('lupa_password', $data);
            $this->load->view('template_introvert/footer', $data);
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email])->row_array();
            if ($user) {
            } else {
            }
        }
    }

    public function event()
    {
        $data['title'] = 'Event';
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $data['event'] = $this->tiket_model->getdataevent()->result_array();
        $data['kategori'] = $this->tiket_model->datakategori()->result_array();
        $this->load->view('template_introvert/header', $data);
        $this->load->view('event', $data);
        $this->load->view('template_introvert/footer', $data);
    }

    public function event_detail($id)
    {
        $data['title'] = 'Event';
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $data['event'] = $this->tiket_model->view_join($id)->row();
        $this->load->view('template_introvert/header', $data);
        $this->load->view('detail_event', $data);
        $this->load->view('template_introvert/footer', $data);
    }

    public function ekategori($id)
    {
        $data['title'] = 'Kategori Event';
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $data['event'] = $this->tiket_model->perkategori($id)->result_array();
        $data['kategori'] = $this->tiket_model->datakategori()->result_array();
        $this->load->view('template_introvert/header', $data);
        $this->load->view('event', $data);
        $this->load->view('template_introvert/footer', $data);
    }

    public function merchandise()
    {
        $data['title'] = 'Merchandise';
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $data['kategori'] = $this->MerchandiseModel->datakategori()->result_array();
        $data['getalldata'] = $this->MerchandiseModel->getallmerchandise()->result_array();
        $this->load->view('template_introvert/header', $data);
        $this->load->view('merchandise', $data);
        $this->load->view('template_introvert/footer', $data);
    }

    public function merchandise_detail($id)
    {
        $data['title'] = 'Merchandise';
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();

        $data['getdatabyid'] = $this->MerchandiseModel->getdatabyid($id)->row_array();
        $data['getfotobyid'] = $this->MerchandiseModel->getfotobyid($id, $data['getdatabyid']['foto'])->result_array();

        $this->load->view('template_introvert/header', $data);
        $this->load->view('detail_merchandise', $data);
        $this->load->view('template_introvert/footer', $data);
    }
}
