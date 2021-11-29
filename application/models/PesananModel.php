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

    public function detailpesanan_m($id_pesanan){
        $query = "SELECT *, pesanan_m.berat AS total_berat FROM pesanan_m, detailpesanan_m, merchandise, user WHERE pesanan_m.id_pesanan = $id_pesanan
        AND pesanan_m.id_pesanan = detailpesanan_m.id_pesanan AND detailpesanan_m.id_merch = merchandise.id_merch
        AND user.id_user = pesanan_m.id_user";
        return $this->db->query($query);
    }
}