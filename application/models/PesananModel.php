<?php
class PesananModel extends CI_Model
{
    public function admin_belum_bayar(){
        $query = "SELECT * FROM pesanan_m, detailpesanan_m, merchandise WHERE status = 0 AND pesanan_m .id_pesanan = detailpesanan_m.id_pesanan
        AND detailpesanan_m.id_merch = merchandise.id_merch";
        return $this->db->query($query);
    }

    public function admin_sudah_bayar(){
        $query = "SELECT * FROM pesanan_m, detailpesanan_m, merchandise WHERE status = 1 AND pesanan_m .id_pesanan = detailpesanan_m.id_pesanan
        AND detailpesanan_m.id_merch = merchandise.id_merch";
        return $this->db->query($query);
    }

    public function admin_sudah_kirim(){
        $query = "SELECT * FROM pesanan_m, detailpesanan_m, merchandise WHERE status = 2 AND pesanan_m .id_pesanan = detailpesanan_m.id_pesanan
        AND detailpesanan_m.id_merch = merchandise.id_merch";
        return $this->db->query($query);
    }

    public function getidpesanan($id_pesanan){
        $query = "SELECT * FROM pesanan_m WHERE id_pesanan = $id_pesanan";
        return $this->db->query($query)->row_array();
    }
}