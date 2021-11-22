<?php
defined('BASEPATH') or exit('No direct script access allowed');
class tiket_model extends CI_Model
{
    public function getalldata()
    {
        $query = "SELECT *
        FROM tiket_kategori
        ";

        return $this->db->query($query);
    }

    public function get_checkout_event($id_user, $status){
        $query = $this->db->query("SELECT keranjang_event.id_keranjang, keranjang_event.qty, event.harga_tiket as harga, 
        event.nama_event, 
        event.foto_utama, 
        tiket_kategori.nama_kategori
        FROM `keranjang_event`
        JOIN `event` ON `event`.`id_event` = keranjang_event.id_event
        JOIN tiket_kategori ON event.kategori = `event`.`kategori`
        WHERE keranjang_event.status= $status
        AND keranjang_event.id_user = $id_user
        GROUP BY id_keranjang;");
        return $query;
    }

    public function getdatabyid($id)
    {
        $query = "SELECT *
        FROM tiket_kategori
        WHERE id_kategori = $id";

        return $this->db->query($query);
    }

    public function delete($id)
    {
        $query = "DELETE FROM tiket_kategori
        WHERE id_kategori = $id";

        return $this->db->query($query);
    }

    public function delete_event($id)
    {
        $this->db->where('id_event', $id);
        $result = $this->db->delete('event');
        return $result;
    }

    public function getdataevent()
    {
        $query = "SELECT *
        FROM event, tiket_kategori WHERE kategori = id_kategori
        ";

        return $this->db->query($query);
    }

    public function getdataeventlimit()
    {
        $query = "SELECT *
        FROM event, tiket_kategori, foto_event
        WHERE kategori = id_kategori
        AND foto_event.id = event.foto_utama
        order by event.id_event DESC
        LIMIT 5
        ";

        return $this->db->query($query);
    }

    public function tambah_event($group_foto, $lastid)
    {
        $data = array(
            'nama_event' => htmlspecialchars($this->security->xss_clean($this->input->post('nama_event')), ENT_QUOTES),
            'stock' => htmlspecialchars($this->security->xss_clean($this->input->post('stock')), ENT_QUOTES),
            'kategori' => htmlspecialchars($this->security->xss_clean($this->input->post('kategori')), ENT_QUOTES),
            'foto' => htmlspecialchars($group_foto, ENT_QUOTES),
            'foto_utama' => $lastid,
            'harga_tiket' => htmlspecialchars($this->security->xss_clean($this->input->post('harga')), ENT_QUOTES),
            'diskon' => htmlspecialchars($this->security->xss_clean($this->input->post('diskon')), ENT_QUOTES),
            'tgl_aktif' => htmlspecialchars($this->security->xss_clean($this->input->post('tgl_aktif')), ENT_QUOTES),
            'tgl_berakhir' => htmlspecialchars($this->security->xss_clean($this->input->post('tgl_berakhir')), ENT_QUOTES),
            'tgl_acara' => htmlspecialchars($this->security->xss_clean($this->input->post('tgl_acara')), ENT_QUOTES),
            'deskripsi_event' => htmlspecialchars($this->security->xss_clean($this->input->post('deskripsi')), ENT_QUOTES),
            'linkevent' => htmlspecialchars($this->security->xss_clean($this->input->post('linkevent')), ENT_QUOTES),
        );  
        return $this->db->insert('event', $data);
    }

    public function cekData()
    {
        $this->db->limit(1);
        $this->db->order_by('group_foto', 'DESC');
        return $this->db->get('foto_event')->row_array();
    }

    public function upload($insert)
    {
        $this->db->insert_batch('foto_event', $insert);
        // $this->db->set('main_foto', 1);
        // $this->db->where('foto', $data);
        // $this->db->update('foto_event');
        return $this->db->affected_rows();
    }

    public function detailfoto($group)
    {
        return $this->db->get_where('foto_event', ['group_foto' => $group])->result_array();
    }

    public function foto_delete($group)
    {
        // $detail         = $this->MerchandiseModel->getFotoGroup($group);
        $this->db->where('group_foto', $group);
        $result = $this->db->delete('foto_event');
        return $result;
    }

    public function getFotoGroup($group)
    {
        $this->db->where('group_foto =', $group);
        return $this->db->get('foto_event')->result_array();
    }

    public function update_foto($foto = NULL, $id = NULL)
    {
        $data = array(
            'foto' => htmlspecialchars($foto, ENT_QUOTES),
        );
        $this->db->where('id', $id);
        return $this->db->update('foto_event', $data);
    }

    public function update_event()
    {
        $data = array(
            'nama_event' => htmlspecialchars($this->security->xss_clean($this->input->post('nama_event')), ENT_QUOTES),
            'stock' => htmlspecialchars($this->security->xss_clean($this->input->post('stock')), ENT_QUOTES),
            'kategori' => htmlspecialchars($this->security->xss_clean($this->input->post('kategori')), ENT_QUOTES),
            'harga_tiket' => htmlspecialchars($this->security->xss_clean($this->input->post('harga_tiket')), ENT_QUOTES),
            'foto_utama' => htmlspecialchars($this->security->xss_clean($this->input->post('foto_utama')), ENT_QUOTES),
            'diskon' => htmlspecialchars($this->security->xss_clean($this->input->post('diskon')), ENT_QUOTES),
            'tgl_aktif' => htmlspecialchars($this->security->xss_clean($this->input->post('tgl_aktif')), ENT_QUOTES),
            'tgl_berakhir' => htmlspecialchars($this->security->xss_clean($this->input->post('tgl_berakhir')), ENT_QUOTES),
            'tgl_acara' => htmlspecialchars($this->security->xss_clean($this->input->post('tgl_acara')), ENT_QUOTES),
            'deskripsi_event' => htmlspecialchars($this->security->xss_clean($this->input->post('deskripsi_event')), ENT_QUOTES),
            'linkevent' => htmlspecialchars($this->security->xss_clean($this->input->post('linkevent')), ENT_QUOTES),
        );
        $this->db->where('id_event', htmlspecialchars($this->security->xss_clean($this->input->post('id_event')), ENT_QUOTES));
        return $this->db->update('event', $data);
    }

    public function getallevent()
    {
        $query = "SELECT foto_event.foto, stock, foto_utama, nama_kategori, nama_event, harga_tiket, tgl_aktif, tgl_berakhir, tgl_acara, diskon, id_event, event.kategori
        FROM foto_event, event, tiket_kategori
        where event.foto_utama = foto_event.id and event.kategori = tiket_kategori.id_kategori
        ";
        return $this->db->query($query);
    }

    public function getfotobyid($id, $foto)
    {
        $this->db->select('foto_event.foto');
        $this->db->from('foto_event');
        $this->db->join('event', 'event.foto = foto_event.group_foto');
        $this->db->join('tiket_kategori', 'event.kategori = tiket_kategori.id_kategori');
        $this->db->where('event.id_event', $id);
        $this->db->where('foto_event.foto !=', $foto);

        return $this->db->get();
    }

    public function getdatabyid2($id)
    {
        $query = "SELECT tiket_kategori.nama_kategori, nama_event, harga_tiket, diskon, deskripsi_event, id_event, stock, foto_event.foto, tgl_acara, tgl_berakhir
        FROM event, tiket_kategori, foto_event
        where event.kategori = tiket_kategori.id_kategori AND event.foto_utama = foto_event.id AND event.id_event = $id";
        return $this->db->query($query);
    }

    public function view_join($id)
    {
        $query = "SELECT * FROM event, tiket_kategori WHERE kategori = id_kategori AND id_event = $id";
        return $this->db->query($query);
    }

    public function perkategori($id)
    {
        $query = "SELECT tiket_kategori.nama_kategori, nama_event, harga_tiket, diskon, deskripsi_event, id_event, stock, foto_event.foto, tgl_acara, tgl_berakhir
        FROM event, tiket_kategori, foto_event
        WHERE kategori = id_kategori AND event.foto_utama = foto_event.id AND id_kategori = $id";
        return $this->db->query($query);
    }

    public function datakategori()
    {
        $query = "SELECT * FROM tiket_kategori WHERE status = 1";
        return $this->db->query($query);
    }

    public function cek_keranjang($id_event, $id_user)
    {
        $query = "SELECT *
        FROM keranjang_event
        WHERE id_event = $id_event AND id_user = $id_user AND status IN('0,1')";
        return $this->db->query($query);
    }

    public function get_keranjang($id_user)
    {
        $query = "SELECT keranjang_event.*, foto_event.*, event.id_event, event.nama_event, event.stock, event.harga_tiket, event.diskon
        FROM keranjang_event, user, event, foto_event
        WHERE user.id_user = keranjang_event.id_user 
        AND keranjang_event.id_user = $id_user 
        AND event.id_event = keranjang_event.id_event 
        AND event.foto_utama = foto_event.id
        AND keranjang_event.status IN (1,0)
        ";
        return $this->db->query($query);
    }

    public function uncheck_status_event($id_keranjang)
    {
        $query = "UPDATE keranjang_event SET keranjang_event.status = 0 WHERE id_keranjang = $id_keranjang";
        return $this->db->query($query);
    }

    public function check_status_event($id_keranjang)
    {
        $query = "UPDATE keranjang_event SET keranjang_event.status = 1 WHERE id_keranjang = $id_keranjang";
        return $this->db->query($query);
    }

    public function get_keranjang_byid($id_keranjang)
    {
        $query = "SELECT *
        FROM keranjang_event
        WHERE id_keranjang = $id_keranjang";
        return $this->db->query($query);
    }

    public function get_keranjang_status_event($id_keranjang)
    {
        $query = "SELECT keranjang_event.*, event.id_event, event.nama_event, event.stock, event.harga_tiket, event.diskon
        FROM keranjang_event, event
        WHERE event.id_event = keranjang_event.id_event AND keranjang_event.id_keranjang = $id_keranjang";
        return $this->db->query($query);
    }
}
