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
}
