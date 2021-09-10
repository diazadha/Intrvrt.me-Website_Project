<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Event extends CI_Controller
{
    public function kategori()
    {
        $data['content'] = "admin/event_kategori";
        $data['tiket_kategori'] = $this->tiket_model->getalldata()->result_array();
        $this->load->view("template/adminlte", $data);
    }

    public function tambah_kategori()
    {
        $nama_kategori = $this->input->post('nama_kategori');
        $status = $this->input->post('status');

        $data = [
            'nama_kategori' => $nama_kategori,
            'status' => $status,
        ];

        $this->db->insert('tiket_kategori', $data);
        redirect('admin/Event/kategori');
    }

    public function getubah()
    {
        $id_kategori = $_POST['id_kategori'];
        $result = $this->tiket_model->getdatabyid($id_kategori)->row_array();

        echo json_encode($result);
    }

    public function update_kategori()
    {
        $nama_kategori = $this->input->post('nama_kategori');
        $status = $this->input->post('status');
        $id = $this->input->post('id_kategori');

        $data = [
            'nama_kategori' => $nama_kategori,
            'status' => $status,
        ];

        $this->db->where('id_kategori', $id);
        $this->db->update('tiket_kategori', $data);
        redirect('admin/Event/kategori');
    }

    public function delete_kategori()
    {
        $id = $_POST['id_kategori'];
        $cekid = $this->db->get_where('tiket_kategori', ['id_kategori' => $id])->num_rows();
        if ($cekid == 0) {
            echo 'Error';
            die;
        } else {
            if ($this->tiket_model->delete($id)) {
                $r['title'] = 'Sukses!';
                $r['icon'] = 'success';
                $r['status'] = 'Berhasil di Hapus!';
            } else {
                $r['title'] = 'Maaf!';
                $r['icon'] = 'error';
                $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
            }
            echo json_encode($r);
        }
    }
}
