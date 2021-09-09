<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Merchandise extends CI_Controller
{
    public function __construct()
    {
      parent::__construct();
      $this->load->model('MerchandiseModel');
    }

    public function index()
    {
        $data['content'] = "admin/merchandise";
	$data['js'] = array("merchandise.js?r=".rand());
	$this->load->view("template/adminlte", $data);
    }

    public function kategori()
    {
        $data['content'] = "admin/merchandise_kategori";
        $data['js'] = array("merchandise_kategori.js?r=".rand());
	$this->load->view("template/adminlte", $data);
    }

    public function kategori_(){
        $list = $this->MerchandiseModel->kategori_data();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->nama_kategori_merch;
            $row[] = ($field->status == 1) ? '<span class="badge badge-success">On</span>' : '<span class="badge badge-danger">Off</span>';
            $row[] = '<button type="button" class="btn btn-info btn-sm edit" data-id="'.$field->id_kategori_merch.'" data-kategori="'.$field->nama_kategori_merch.'" data-status="'.$field->status.'">Edit</button>
                      <button type="button" class="ml-1 btn btn-danger delete btn-sm" data-id="'.$field->id_kategori_merch.'" data-kategori="'.$field->nama_kategori_merch.'">Hapus</button>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->MerchandiseModel->count_all_kategori(),
            "recordsFiltered" => $this->MerchandiseModel->count_kategori_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function kategori_add(){
        if($this->MerchandiseModel->kategori_add()){
            $d['status'] = true;
        }else{
            $d['status'] = false;
        }
        echo json_encode($d);
    }

    public function kategori_update(){
        if($this->MerchandiseModel->kategori_update()){
            $d['status'] = true;
        }else{
            $d['status'] = false;
        }
        echo json_encode($d);
    }

    public function kategori_delete($id){
        $cekid = $this->db->get_where('merchandise_kategori', ['id_kategori_merch' => $id])->num_rows();
        if($cekid == 0){
            echo 'Error';
            die;
        }else{
            if($this->MerchandiseModel->kategori_delete($id)){
                $r['title'] = 'Sukses!';
                $r['icon'] = 'success';
                $r['status'] = 'Berhasil di Hapus!';
            }else{
                $r['title'] = 'Maaf!';
                $r['icon'] = 'error';
                $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
            }
            echo json_encode($r);
        }
    }

    public function merchandise_(){
        $list = $this->MerchandiseModel->merchandise_data();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->nama_merch;
            $row[] = $field->kategori;
            $row[] = $field->harga;
            $row[] = $field->diskon;
            $row[] = '<button type="button" class="btn btn-info btn-sm edit" data-id="'.$field->id_merch.'" data-merchandise="'.$field->nama_merch.'" data-kategori="'.$field->kategori.'" data-harga="'.$field->harga.'" data-diskon="'.$field->diskon.'" data-deskripsi="'.$field->deskripsi.'">Edit</button>
                      <button type="button" class="ml-1 btn btn-danger delete btn-sm" data-id="'.$field->id_merch.'" data-merchandise="'.$field->nama_merch.'">Hapus</button>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->MerchandiseModel->count_all_merchandise(),
            "recordsFiltered" => $this->MerchandiseModel->count_merchandise_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function merchandise_add(){
        if($this->MerchandiseModel->merchandise_add()){
            $d['status'] = true;
        }else{
            $d['status'] = false;
        }
        echo json_encode($d);
    }

    public function merchandise_update(){
        if($this->MerchandiseModel->merchandise_update()){
            $d['status'] = true;
        }else{
            $d['status'] = false;
        }
        echo json_encode($d);
    }

    public function merchandise_delete($id){
        $cekid = $this->db->get_where('merchandise', ['id_merch' => $id])->num_rows();
        if($cekid == 0){
            echo 'Error';
            die;
        }else{
            if($this->MerchandiseModel->merchandise_delete($id)){
                $r['title'] = 'Sukses!';
                $r['icon'] = 'success';
                $r['status'] = 'Berhasil di Hapus!';
            }else{
                $r['title'] = 'Maaf!';
                $r['icon'] = 'error';
                $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
            }
            echo json_encode($r);
        }
    }
	
    public function tambah(){
        $data['merch'] = $this->db->get('merchandise')->row();
        $data['content'] = "admin/tambah_merch";
        $data['kategori'] = $this->db->get('merchandise_kategori')->result_array();
	    $this->load->view("template/adminlte", $data);
    }

    public function tambah_merch(){
        $upload = $_FILES['foto']['name'];
        if ($upload) {
            $config['allowed_types']    = 'jpg|png|jpeg';
            $config['max_size']         = '2024';
            $config['upload_path']      = './assets/uploads/foto_merchandise';
            $config['encrypt_name']     = TRUE;
            $this->upload->initialize($config);
            if (! $this->upload->do_upload('foto')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $error['error'] . '</div>');
                redirect('admin/merchandise/tambah');
            } else {
                $fileupload = $this->upload->data();
                $filename = pathinfo($fileupload['full_path']);
                $foto = base_url('/assets/uploads/foto_merchandise'.$filename['basename']);
                $result = $this->MerchandiseModel->tambah_merchandise($foto);
            }
        }else{
            $foto = $this->input->post('foto_');
            $result = $this->MerchandiseModel->tambah_merchandise($foto);
        }

        if($result){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Merchandise Berhasil Di Tambah!</div>');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error!</div>');
        }
        redirect('admin/merchandise/tambah');
    }
}
