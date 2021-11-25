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

}