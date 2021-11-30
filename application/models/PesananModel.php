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

    public function emailpesanan_m($external_id){
        $query = "SELECT * FROM pesanan_m, detailpesanan_m, merchandise, user
        WHERE pesanan_m.external_id = '$external_id'
        AND pesanan_m.id_pesanan = detailpesanan_m.id_pesanan AND detailpesanan_m.id_merch = merchandise.id_merch
        AND user.id_user = pesanan_m.id_user";
        return $this->db->query($query);
    }

    public function emailpesanan_m2($external_id){
        $query = "SELECT * FROM pesanan_m, detailpesanan_m, merchandise, user
        WHERE pesanan_m.external_id = '$external_id'
        AND pesanan_m.id_pesanan = detailpesanan_m.id_pesanan AND detailpesanan_m.id_merch = merchandise.id_merch
        AND user.id_user = pesanan_m.id_user AND is_deliver = 0";
        return $this->db->query($query);
    }
    
    public function detailpesanan_e($id_pesanan){
        $query = "SELECT keranjang_event.*, user.nama_user
        FROM keranjang_event
        JOIN user ON user.id_user = keranjang_event.id_user
        WHERE id=$id_pesanan";
        return $this->db->query($query);
    }

    public function get_event($id_keranjang){
        $query="SELECT keranjang_event_detail.*, `event`.nama_event
        FROM keranjang_event_detail
        JOIN `event` ON `event`.id_event = keranjang_event_detail.id_event
        WHERE keranjang_event_detail.id_keranjang = $id_keranjang";
        $query = $this->db->query($query);
        return $query;
    }

    public function get_peserta($id_detail){
        $query = "SELECT * FROM keranjang_event_peserta WHERE id_event_detail = $id_detail";
        return $this->db->query($query);
    }

    public function tiket_belum_bayar(){
        $query="SELECT keranjang_event.*, user.nama_user as pemesan
        FROM keranjang_event
        JOIN user ON user.id_user = keranjang_event.id_user
        WHERE keranjang_event.status = 2";
        $query = $this->db->query($query);
        return $query;
    }
    
    public function tiket_sudah_bayar(){
        $query="SELECT keranjang_event.*, user.nama_user as pemesan
        FROM keranjang_event
        JOIN user ON user.id_user = keranjang_event.id_user
        WHERE keranjang_event.status = 3";
        $query = $this->db->query($query);
        return $query;
    }
}