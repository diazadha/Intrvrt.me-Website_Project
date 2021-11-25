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
            $check = $this->db->get_where('keranjang_event', ['id_user' => $id_user, 'status' => 2])->num_rows();
            if ($check > 0) {
                $keranjang = $this->tiket_model->get_checkout_event($id_user, 2);
                $data['checkout'] = $keranjang->result();
                $data['count'] = $keranjang->num_rows();
                $data['title'] = 'Checkout: ' . $data['count'] . ' Event';
                $this->load->view('template_introvert/header', $data);
                $this->load->view('checkout_event', $data);
                $this->load->view('template_introvert/footer', $data);
            } else {
                $data = array(
                    'status' => 2
                );
                $this->db->where('status', 1);
                $this->db->where('id_user', $id_user);
                $this->db->update('keranjang_event', $data);

                $keranjang = $this->tiket_model->get_checkout_event($id_user, 2);
                $data['checkout'] = $keranjang->result();
                $data['count'] = $keranjang->num_rows();
                $data['title'] = 'Checkout: ' . $data['count'] . ' Event';
                $this->load->view('template_introvert/header', $data);
                $this->load->view('checkout_event', $data);
                $this->load->view('template_introvert/footer', $data);
            }
        }
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
            if (!$data['checkout']){
                $this->session->set_flashdata('message2', '<div class="alert tutup alert-warning" role="alert">Tidak ada Merchandise yang dipilih!</div>');
                redirect(base_url('home/cart_merchandise'));
            }
            $data['d'] = array();
            foreach ($data['checkout'] as $c){
                array_push($data['d'],$c['is_deliver']);
            }
            $c = in_array(0,$data['d']);
            $e = in_array(1,$data['d']);
           
            if($c == TRUE && $e == FALSE){
                $this->load->view('template_introvert/header', $data);
                $this->load->view('checkout_m2', $data);
                $this->load->view('template_introvert/footer', $data);
            }else{
                $this->load->view('template_introvert/header', $data);
                $this->load->view('checkout_m', $data);
            }
        } else {
            $this->session->set_flashdata('message2', 'Anda Belum Login');
            redirect('home/login');
        }
    }

    public function proses_m(){
        
        $this->MerchandiseModel->checkout();
        $this->MerchandiseModel->detailpesanan();
        redirect(base_url('home'));
    }
}
