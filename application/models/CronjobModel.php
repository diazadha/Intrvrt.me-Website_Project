<?php
class CronjobModel extends CI_Model
{
    public function get_acara(){
        $query="SELECT keranjang_event.id, keranjang_event.id_user, user.email, user.nama_user, `event`.`linkevent`, `event`.`tgl_acara`, `event`.nama_event, tiket_kategori.nama_kategori
        FROM `keranjang_event`
        JOIN keranjang_event_detail ON keranjang_event_detail.id_keranjang = keranjang_event.id
        JOIN `event` ON `event`.`id_event` = keranjang_event_detail.id_event
        JOIN `user` ON `user`.`id_user` = keranjang_event.id_user
        JOIN tiket_kategori ON tiket_kategori.id_kategori = `event`.`kategori`
        WHERE keranjang_event.status = 3 
        AND keranjang_event.kirim_link = 'T';
        ";
        return $this->db->query($query);
    }
}