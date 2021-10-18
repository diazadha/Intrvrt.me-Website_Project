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
        FROM event, tiket_kategori 
        WHERE kategori = id_kategori
        order by event.id_event DESC
        LIMIT 5
        ";

        return $this->db->query($query);
    }

    // public function tambah_event($foto = NULL)
    // {
    //     $data = array(
    //         'nama_event' => htmlspecialchars($this->security->xss_clean($this->input->post('nama_event')), ENT_QUOTES),
    //         'stock' => htmlspecialchars($this->security->xss_clean($this->input->post('stock')), ENT_QUOTES),
    //         'kategori' => htmlspecialchars($this->security->xss_clean($this->input->post('kategori')), ENT_QUOTES),
    //         'foto' => htmlspecialchars($foto, ENT_QUOTES),
    //         'harga_tiket' => htmlspecialchars($this->security->xss_clean($this->input->post('harga')), ENT_QUOTES),
    //         'diskon' => htmlspecialchars($this->security->xss_clean($this->input->post('diskon')), ENT_QUOTES),
    //         'tgl_aktif' => htmlspecialchars($this->security->xss_clean($this->input->post('tgl_aktif')), ENT_QUOTES),
    //         'tgl_berakhir' => htmlspecialchars($this->security->xss_clean($this->input->post('tgl_berakhir')), ENT_QUOTES),
    //         'tgl_acara' => htmlspecialchars($this->security->xss_clean($this->input->post('tgl_acara')), ENT_QUOTES),
    //         'deskripsi_event' => htmlspecialchars($this->security->xss_clean($this->input->post('deskripsi')), ENT_QUOTES),
    //     );
    //     return $this->db->insert('event', $data);
    // }

    public function tambah_event($group_foto, $lastid){
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
        );
        $this->db->where('id_event', htmlspecialchars($this->security->xss_clean($this->input->post('id_event')), ENT_QUOTES));
        return $this->db->update('event', $data);
    }

    public function view_join($id)
    {
        $query = "SELECT * FROM event, tiket_kategori WHERE kategori = id_kategori AND id_event = $id";
        return $this->db->query($query);
    }

    public function perkategori($id)
    {
        $query = "SELECT * FROM event, tiket_kategori WHERE kategori = id_kategori AND id_kategori = $id";
        return $this->db->query($query);
    }

    public function datakategori()
    {
        $query = "SELECT * FROM tiket_kategori WHERE status = 1";
        return $this->db->query($query);
    }
}
