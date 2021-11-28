<?php
class PesananModel extends CI_Model
{
    public function admin_belum_bayar(){
        $query = "SELECT * FROM pesanan_m WHERE status = 0";
        return $this->db->query($query);
    }

    public function admin_sudah_bayar(){
        $query = "SELECT * FROM pesanan_m WHERE status = 1";
        return $this->db->query($query);
    }

    public function admin_sudah_kirim(){
        $query = "SELECT * FROM pesanan_m WHERE status = 2";
        return $this->db->query($query);
    }

    public function getidpesanan($id_pesanan){
        $query = "SELECT * FROM pesanan_m WHERE id_pesanan = $id_pesanan";
        return $this->db->query($query)->row_array();
    }
}