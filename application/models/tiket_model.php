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
        $query = "DELETE FROM event
        WHERE id_event = $id";

        return $this->db->query($query);
    }

    public function getdataevent(){
        $query = "SELECT *
        FROM event, tiket_kategori WHERE kategori = id_kategori
        ";

        return $this->db->query($query);
    }

    public function tambah_event($foto = NULL){
        $data=array(
            'nama_event' => htmlspecialchars($this->security->xss_clean($this->input->post('nama_event')),ENT_QUOTES),
            'kategori' => htmlspecialchars($this->security->xss_clean($this->input->post('kategori')),ENT_QUOTES),
            'foto' => htmlspecialchars($foto, ENT_QUOTES),
            'harga_tiket' => htmlspecialchars($this->security->xss_clean($this->input->post('harga')),ENT_QUOTES),
            'tgl_aktif' => htmlspecialchars($this->security->xss_clean($this->input->post('tgl_aktif')),ENT_QUOTES),
            'tgl_berakhir' => htmlspecialchars($this->security->xss_clean($this->input->post('tgl_berakhir')),ENT_QUOTES),
            'deskripsi_event' => htmlspecialchars($this->security->xss_clean($this->input->post('deskripsi')),ENT_QUOTES),
        );
        return $this->db->insert('event',$data);
    }

    public function update_foto($foto = NULL){
        $data=array(
        'foto' => htmlspecialchars($foto, ENT_QUOTES),
        );
        $this->db->where('id_event', htmlspecialchars($this->security->xss_clean($this->input->post('id_event')),ENT_QUOTES));
        return $this->db->update('event', $data);
    }

    public function update_event(){
        $data=array(
            'nama_event' => htmlspecialchars($this->security->xss_clean($this->input->post('nama_event')),ENT_QUOTES),
            'kategori' => htmlspecialchars($this->security->xss_clean($this->input->post('kategori')),ENT_QUOTES),
            'harga_tiket' => htmlspecialchars($this->security->xss_clean($this->input->post('harga_tiket')),ENT_QUOTES),
            'tgl_aktif' => htmlspecialchars($this->security->xss_clean($this->input->post('tgl_aktif')),ENT_QUOTES),
            'tgl_berakhir' => htmlspecialchars($this->security->xss_clean($this->input->post('tgl_berakhir')),ENT_QUOTES),
            'deskripsi_event' => htmlspecialchars($this->security->xss_clean($this->input->post('deskripsi')),ENT_QUOTES),
        );
        $this->db->where('id_event', htmlspecialchars($this->security->xss_clean($this->input->post('id_event')),ENT_QUOTES));
        return $this->db->update('event', $data);
    }

    public function view_join($id){
        $query = "SELECT * FROM event, tiket_kategori WHERE kategori = id_kategori AND id_event = $id";
        return $this->db->query($query);
    }

    public function perkategori($id){
        $query = "SELECT * FROM event, tiket_kategori WHERE kategori = id_kategori AND id_kategori = $id";
        return $this->db->query($query);
    }

    public function datakategori(){
        $query = "SELECT * FROM tiket_kategori WHERE status = 1";
        return $this->db->query($query);
    }
}
