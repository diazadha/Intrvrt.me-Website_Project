<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Event extends CI_Controller
{
	public function index()
    {
        $data['content'] = "admin/event";
        $data['tiket'] = $this->tiket_model->getdataevent()->result_array();
        $this->load->view("template/adminlte", $data);
    }

    public function tambah()
    {
        $data['event'] = $this->db->get('event')->row();
        $data['js'] = array("event.js?r=".rand());
        $data['content'] = "admin/tambah_event";
        $data['kategori'] = $this->db->get('tiket_kategori')->result_array();
	    $this->load->view("template/adminlte", $data);
    }

    public function tambah_event(){
        $upload = $_FILES['foto']['name'];
        if ($upload) {
            $config['allowed_types']    = 'jpg|png|jpeg';
            $config['max_size']         = '2024';
            $config['upload_path']      = './assets/uploads/foto_event';
            $config['encrypt_name']     = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (! $this->upload->do_upload('foto')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('message', '<div class="alert tutup alert-danger" role="alert">' . $error['error'] . '</div>');
                redirect('admin/Event/tambah');
            } else {
                $fileupload = $this->upload->data();
                $filename = pathinfo($fileupload['full_path']);
                $foto = $filename['basename'];
                $result = $this->tiket_model->tambah_event($foto);
            }
        }else{
            $foto = $this->input->post('foto_');
            $result = $this->tiket_model->tambah_event($foto);
        }

        if($result){
            $this->session->set_flashdata('message', '<div class="alert tutup alert-success" role="alert">Event Berhasil Di Tambah!</div>');
        }else{
            $this->session->set_flashdata('message', '<div class="alert tutup alert-danger" role="alert">Error!</div>');
        }
        redirect('admin/Event/tambah');
    }

    public function delete_event()
    {
        $id = $_POST['id_event'];
        $cekid = $this->db->get_where('event', ['id_event' => $id])->num_rows();
        $detail  = $this->db->get_where('event',array('id_event'=>$id))->row();
        if ($cekid == 0) {
            echo 'Error';
            die;
        } else {
            if ($this->tiket_model->delete_event($id)) {
                $path         = './assets/uploads/foto_event/'.$detail->foto;
                unlink($path);
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

    public function edit($id){
        $data['event'] = $this->db->get_where('event', array('id_event'=>$id))->row();
        $data['js'] = array("event.js?r=".rand());
        $data['content'] = "admin/edit_event";
        $data['kategori'] = $this->db->get('tiket_kategori')->result_array();
	    $this->load->view("template/adminlte", $data);
    }

    public function update_gambar(){
        
        $id_event                   = $this->input->post('id_event');
        $config['upload_path']   	= './assets/uploads/foto_event/';
        $config['allowed_types'] 	= 'jpg|jpeg|png|gif|ico|jfif';
        $config['max_size']         = '2024';
        $config['encrypt_name']     = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $field_name = 'foto';
        if(!$this->upload->do_upload($field_name)){
            echo "Gagal Update Gambar !";
        }else{
            $detail                     = $this->db->get_where('event',array('id_event'=>$id_event))->row();
            $path                       = './assets/uploads/foto_event/'.$detail->foto;
            unlink($path);
            $fileupload = $this->upload->data();
            $filename   = pathinfo($fileupload['full_path']);
            $foto       = $filename['basename'];
            $result     = $this->tiket_model->update_foto($foto);   
        }
        if($result){
            $this->session->set_flashdata('message', '<div class="alert tutup alert-success" role="alert">Foto Berhasil Di Update!</div>');
        }else{
            $this->session->set_flashdata('message', '<div class="alert tutup alert-danger" role="alert">Error!</div>');
        }
        redirect(base_url('admin/Event/edit/').$id_event );
    }

    public function edit_event(){
        $id_event = $this->input->post('id_event');
        $result     = $this->tiket_model->update_event();
        if($result){
            $this->session->set_flashdata('message', '<div class="alert tutup alert-success" role="alert">Merchandise Berhasil Di Update!</div>');
        }else{
            $this->session->set_flashdata('message', '<div class="alert tutup alert-danger" role="alert">Error!</div>');
        }
        redirect(base_url('admin/Event/edit/').$id_event );
    }
	
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
