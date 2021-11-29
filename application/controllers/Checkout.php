<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use Xendit\Xendit;

class Checkout extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    private function token()
    {
        return 'xnd_development_E7UdRyMnxY1B18FytIEHESZeclPJ4OcrZvZ0m1Cs3AloopFHBRRRnRotWcBEL';
    }

    // public function get_VA()
    // {
    //     Xendit::setApiKey($this->token());

    //     $id = '61a2486fe56dcb672012de87';
    //     $getVA = \Xendit\VirtualAccounts::retrieve($id);
    //     var_dump($getVA);
    //     die;
    // }

    public function getVA()
    {
        Xendit::setApiKey($this->token());
        return \Xendit\VirtualAccounts::getVABanks(); //ARRAY
    }

    public function event()
    {
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $data['VABank'] = $this->getVA();

        if (!$this->session->userdata('email')) {
            $this->session->set_flashdata('message2', 'Anda belum login');
            redirect('home/login');
        } else {
            $id_user = $this->session->userdata('id_user');
            $keranjang = $this->Tiket_model->get_checkout_event($id_user);
            $data['checkout'] = $keranjang->result();
            $data['count'] = $keranjang->num_rows();
            $data['title'] = 'Checkout: ' . $data['count'] . ' Event';
            $this->load->view('template_introvert/header', $data);
            $this->load->view('checkout_event', $data);
            $this->load->view('template_introvert/footer', $data);
        }  
    }

    public function proses_event(){
        $keranjang = $this->db->get_where('keranjang_event',['id_user' => $this->session->userdata('id_user')])->row();
        $id_transaksi = $keranjang->id;
        $vaBank = $this->input->post('vaBank');

        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row();
        Xendit::setApiKey($this->token());
        $params = [
            "external_id" => 'intrvrt.me-'.$id_transaksi,
            "bank_code" => $vaBank,
            "name" => $user->nama_user,
            "expected_amount" => $this->input->post('tagihan'),
            "expiration_date" => date('c', mktime(date('H'), date('i'),date('s'),date('m'),date('d') + 1,date('y'))),
        ];
        $createVA = \Xendit\VirtualAccounts::create($params);
        $idVA = $createVA['id'];

        $toTable = $params;
        $toTable['status'] = 2; //menunggu pembayaran

        $this->db->where('id', $id_transaksi);
        $this->db->update('keranjang_event', $toTable);

        //update status
        $list       = $this->db->get_where('keranjang_event_detail', ['id_keranjang' => $id_transaksi, 'status' => 1])->result();
        foreach($list as $l){
            //update
            $data__=array(
                'status' => 2,
            );
            $this->db->where('id', $l->id);
            $this->db->update('keranjang_event_detail', $data__);
        }

        //create keranjang baru untuk event yang tidak di centang
        $movecreate = $this->db->get_where('keranjang_event_detail', ['id_keranjang' => $id_transaksi, 'status' => 0])->result();
        //insert keranjang
        $data=array(
            'id_user' => $user->id_user,
            'status' => 1
        );
        $this->db->insert('keranjang_event', $data);
        $new_id_keranjang = $this->db->insert_id();

        foreach($movecreate as $m){
            //update
            $data_=array(
                'id_keranjang' => $new_id_keranjang,
            );
            $this->db->where('id', $m->id);
            $this->db->update('keranjang_event_detail', $data_);
        }

        //data peserta
        foreach ($_POST['nama'] as $key => $val) {
            $value[] = array(             
                'id_event_detail' => $_POST['id_event_detail'][$key],
                'nama' => $_POST['nama'][$key],
                'email' => $_POST['email'][$key],
            );   
        }   
        $this->db->insert_batch('keranjang_event_peserta', $value);

        //send email notif;
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'intrvrt.me1@gmail.com',
            'smtp_pass' => 'Ayamgoreng123',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'validation' => TRUE // bool whether to validate email or not  
        ];
        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->from('intrvrt.me1@gmail.com', 'Intrvrt.me');
        $this->email->to($user->email);
        $this->email->subject('Verifikasi Akun');

        $message = "Hi $user->nama_user, <br>
        Terimakasih telah melakukan pembelian tike event di intrvrt.me
        <p>Berikut Detail Pesanan Anda:</p>
        ";
        $this->email->message($message);

        if (!$this->email->send()) {
            echo $this->email->print_debugger();
        }
        //end email

        $data['getVA'] = \Xendit\VirtualAccounts::retrieve($idVA);
        $this->load->view('template_introvert/header', $data);
        $this->load->view('virtual_account', $data);
        $this->load->view('template_introvert/footer', $data);
    }

    public function event_batal()
    {
        if (!$this->session->userdata('email')) {
            $this->session->set_flashdata('message2', 'Anda belum login');
            redirect('home/login');
        } else {
            $this->db->delete('keranjang_event', array('id_user' => $this->session->userdata('id_user'), 'status' => 2));
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Checkot berhasil dibatalkan</div>');
            redirect('home/cart_event');
        }
    }

    public function merchandise()
    {
        $data['title'] = 'Checkout Merchandise';
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        $data['VABank'] = $this->getVA();
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($user) {
            $data['checkout'] = $this->MerchandiseModel->getkeranjangdipilih($user['id_user'])->result_array();
            $data['is_deliver'] = $this->MerchandiseModel->is_deliv($user['id_user'])->result_array();
            if (!$data['checkout']) {
                $this->session->set_flashdata('message2', '<div class="alert tutup alert-warning" role="alert">Tidak ada Merchandise yang dipilih!</div>');
                redirect(base_url('home/cart_merchandise'));
            }
            $data['d'] = array();
            foreach ($data['checkout'] as $c) {
                array_push($data['d'], $c['is_deliver']);
            }
            $c = in_array(0, $data['d']);
            $e = in_array(1, $data['d']);

            if ($c == TRUE && $e == FALSE) {
                $this->load->view('template_introvert/header', $data);
                $this->load->view('checkout_m2', $data);
                $this->load->view('template_introvert/footer', $data);
            } else {
                $this->load->view('template_introvert/header', $data);
                $this->load->view('checkout_m', $data);
            }
        } else {
            $this->session->set_flashdata('message2', 'Anda Belum Login');
            redirect('home/login');
        }
    }

    public function proses_m()
    {
        $data['title'] = 'Checkout Merchandise';
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();

        $this->MerchandiseModel->checkout();
        $data['pesanan'] = $this->PesananModel->getidpesanan($this->db->insert_id());
        $this->MerchandiseModel->detailpesanan();
        Xendit::setApiKey($this->token());
        $params = ["external_id" => 'intrvrt.me-merch-'.$data['pesanan']['id_pesanan'],
        "bank_code" => $this->input->post('metode_bayar'),
        "name" => $this->input->post('nama_penerima'),
        "expected_amount" => $this->input->post('total_bayar'),
        "expiration_date" => date('c', mktime(date('H'), date('i'),date('s'),date('m'),date('d') + 1,date('y'))),
        "is_single_use" => TRUE,
        ];
        
        // var_dump($params);
        // die;
        $createVA = \Xendit\VirtualAccounts::create($params);
        $id = $createVA['id'];
        $dataXendit = array(
            "external_id" => 'intrvrt.me-merch-'.$data['pesanan']['id_pesanan'],
            "id_xendit" => $id,
            "account_number" => $createVA['account_number'],
            "bank_code" => $createVA['bank_code'],
        );
        // var_dump($createVA);
        // die;
        $this->db->where('id_pesanan', $data['pesanan']['id_pesanan']);
        $this->db->update('pesanan_m', $dataXendit);

        redirect('checkout/bayar_m/'.$data['pesanan']['id_pesanan']);
    }

    public function bayar_m($id_pesanan){
        $data['pesanan'] = $this->PesananModel->getidpesanan($id_pesanan);
        if (!$this->session->userdata('email')) {
            $this->session->set_flashdata('message2', 'Anda belum login');
            redirect('home/login');
        } else {
            $data['title'] = 'Bayar Merchandise';
            $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
            Xendit::setApiKey($this->token());
            $data['getVA'] = \Xendit\VirtualAccounts::retrieve($data['pesanan']['id_xendit']);
            $this->load->view('template_introvert/header', $data);
            $this->load->view('virtual_account', $data);
            $this->load->view('template_introvert/footer', $data);
        }
    }
}
