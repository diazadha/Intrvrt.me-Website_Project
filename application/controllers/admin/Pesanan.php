<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends CI_Controller
{
    public function merchandise(){
        $data['profil'] = $this->db->get('profile_perusahaan')->row();
        $data['pesanan1'] = $this->PesananModel->admin_belum_bayar()->result_array();
        $data['pesanan2'] = $this->PesananModel->admin_sudah_bayar()->result_array();
        $data['pesanan3'] = $this->PesananModel->admin_sudah_kirim()->result_array();
        $data['jumlah1']   = count($data['pesanan1']);
        $data['jumlah2']   = count($data['pesanan2']);
        $data['jumlah3']   = count($data['pesanan3']);
        $data['content'] = "admin/pesanan.php";
        $this->load->view("template/adminlte", $data);
    }
    
    public function event(){
        $data['profil'] = $this->db->get('profile_perusahaan')->row();
        $data['belumbayar'] = $this->PesananModel->tiket_belum_bayar()->result();
        $data['sudahbayar'] = $this->PesananModel->tiket_sudah_bayar()->result();
        $data['countbelum']   = count($data['belumbayar']);
        $data['countsudah']   = count($data['sudahbayar']);
        $data['content'] = "admin/pesanan_event.php";
        $this->load->view("template/adminlte", $data);
    }

    public function detail_m($id_pesanan){
        $data['profil'] = $this->db->get('profile_perusahaan')->row();
        $data['pesanan'] = $this->PesananModel->detailpesanan_m($id_pesanan)->row_array();
        $data['pesanan1'] = $this->PesananModel->detailpesanan_m($id_pesanan)->result_array();
        $data['content'] = "admin/detailpesanan.php";
        $this->load->view("template/adminlte", $data);
    }
    
    public function detail_event($id_pesanan){
        $data['profil'] = $this->db->get('profile_perusahaan')->row();
        $data['pesanan'] = $this->PesananModel->detailpesanan_e($id_pesanan)->row();
        $data['content'] = "admin/detailpesananevent.php";
        $this->load->view("template/adminlte", $data);
    }

    public function dikirim_m($id_pesanan){
        $data = array(
            'status' => 2,
        );
        $this->db->where('id_pesanan', $id_pesanan);
        $this->db->update('pesanan_m', $data);
        redirect('admin/pesanan/merchandise');
    }
}