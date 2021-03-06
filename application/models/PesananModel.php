<?php
class PesananModel extends CI_Model
{
    public function admin_belum_bayar(){
        $query = "SELECT * FROM pesanan_m WHERE status = 0";
        return $this->db->query($query);
    }

    public function admin_sudah_bayar(){
        $query = "SELECT * FROM pesanan_m WHERE status = 1 OR status = 3";
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
        AND user.id_user = pesanan_m.id_user";
        return $this->db->query($query);
    }

    public function deletekeranjangbypesanan($id_user){
        $query = "SELECT keranjang_merchandise.* FROM keranjang_merchandise, pesanan_m, detailpesanan_m, user
        WHERE keranjang_merchandise.id_user = $id_user AND keranjang_merchandise.status = 1 AND keranjang_merchandise.id_merchandise = detailpesanan_m.id_merch
        AND pesanan_m.id_pesanan = detailpesanan_m.id_pesanan AND pesanan_m.id_user = user.id_user
        GROUP BY id_keranjang";
        return $this->db->query($query);
    }
    
    public function detailpesanan_e($id_pesanan){
        $query = "SELECT keranjang_event.*, user.nama_user
        FROM keranjang_event
        JOIN user ON user.id_user = keranjang_event.id_user
        WHERE id=$id_pesanan";
        return $this->db->query($query);
    }
    
    public function detailpesanan_m($id_pesanan){
        $query = "SELECT *, pesanan_m.berat AS total_berat FROM pesanan_m, detailpesanan_m, merchandise, user WHERE pesanan_m.id_pesanan = $id_pesanan
        AND pesanan_m.id_pesanan = detailpesanan_m.id_pesanan AND detailpesanan_m.id_merch = merchandise.id_merch
        AND user.id_user = pesanan_m.id_user";
        return $this->db->query($query);
    }

    // public function detailpesanan_m($id_pesanan){
    //     $query = "SELECT *, pesanan_m.berat AS total_berat FROM pesanan_m, detailpesanan_m, merchandise, user WHERE pesanan_m.id_pesanan = $id_pesanan
    //     AND pesanan_m.id_pesanan = detailpesanan_m.id_pesanan AND detailpesanan_m.id_merch = merchandise.id_merch
    //     AND user.id_user = pesanan_m.id_user";
    //     return $this->db->query($query);
    // }

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
    
    public function get_riwayat_event($id_user){
        $query="SELECT keranjang_event.*
        FROM keranjang_event
        JOIN user ON user.id_user = keranjang_event.id_user
        WHERE keranjang_event.status != 1
        AND keranjang_event.id_user = $id_user";
        $query = $this->db->query($query);
        return $query;
    }
}