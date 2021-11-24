<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function event()
    {
        $data['profil_perusahaan'] = $this->db->get('profile_perusahaan')->row_array();
        if (!$this->session->userdata('email')) {
            $this->session->set_flashdata('message2', 'Anda belum login');
            redirect('home/login');
        } else {
            $id_user = $this->session->userdata('id_user');
            $check = $this->db->get_where('keranjang_event', ['id_user' => $id_user, 'status' => 2])->num_rows();
            if ($check > 0){
                $keranjang = $this->tiket_model->get_checkout_event($id_user, 2);
                $data['checkout'] = $keranjang->result();
                $data['count'] = $keranjang->num_rows();
                $data['title'] = 'Checkout: '.$data['count'].' Event';
                $this->load->view('template_introvert/header', $data);
                $this->load->view('checkout_event', $data);
                $this->load->view('template_introvert/footer', $data);
            }else{
                $data = array(
                    'status' => 2
                );
                $this->db->where('status', 1);
                $this->db->where('id_user', $id_user);
                $this->db->update('keranjang_event', $data);

                $keranjang = $this->tiket_model->get_checkout_event($id_user, 2);
                $data['checkout'] = $keranjang->result();
                $data['count'] = $keranjang->num_rows();
                $data['title'] = 'Checkout: '.$data['count'].' Event';
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
}
