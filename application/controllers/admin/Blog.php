<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{
    public function __construct()
    {
      parent::__construct();
      $this->load->model('BlogModel');
    }

    public function index()
    {
        $data['content'] = "admin/blog_konten";
        $data['js'] = array("blog_konten.js?r=".rand());
		$this->load->view("template/adminlte", $data);
    }

    public function create()
    {
        $data['content'] = "admin/blog_create";
        $data['kategori'] = $this->BlogModel->get_kategori();
		$this->load->view("template/adminlte", $data);
    }

    public function create_()
	{
	    $upload = $_FILES['foto']['name'];
        if ($upload) {
            $nmfile = date('YmdHis');
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '2024';
            $config['upload_path'] = './assets/blog';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $error['error'] . '</div>');
                redirect('admin/blog/create');
            } else {
                $fileupload = $this->upload->data();
                $filename = pathinfo($fileupload['full_path']);
                $foto = base_url('assets/perusahaan/'.$filename['basename']);
            }
        }else{
            $foto = null;
        }

        $result = $this->BlogModel->konten_add($foto);
        if($result){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Konten Blog berhasil ditambahkan!</div>');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error!</div>');
        }
	    redirect('admin/berita');
	}

    public function update()
    {
        $data['content'] = "admin/blog_update";
        $data['kategori'] = $this->BlogModel->get_kategori();
		$this->load->view("template/adminlte", $data);
    }

    public function konten_(){
        $list = $this->BlogModel->konten_data();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->judul;
            $row[] = ($field->status == 1) ? '<span class="badge badge-success">Publish</span>' : '<span class="badge badge-danger">Draft</span>';
            $row[] = '<a href="'.base_url('blog/edit/'.$field->id_blog).'" class="btn btn-info btn-sm edit" data-id="'.$field->id_blog.'">Edit</button>
                      <button type="button" class="ml-1 btn btn-danger delete btn-sm" data-id="'.$field->id_blog.'" data-judul="'.$field->judul.'">Hapus</button>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->BlogModel->count_all_konten(),
            "recordsFiltered" => $this->BlogModel->count_konten_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function kategori()
    {
        $data['content'] = "admin/blog_kategori";
        $data['js'] = array("blog_kategori.js?r=".rand());
		$this->load->view("template/adminlte", $data);
    }

    public function kategori_(){
        $list = $this->BlogModel->kategori_data();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->nama_kategori;
            $row[] = ($field->status == 1) ? '<span class="badge badge-success">On</span>' : '<span class="badge badge-danger">Off</span>';
            $row[] = '<button type="button" class="btn btn-info btn-sm edit" data-id="'.$field->id_kategori.'" data-kategori="'.$field->nama_kategori.'" data-status="'.$field->status.'">Edit</button>
                      <button type="button" class="ml-1 btn btn-danger delete btn-sm" data-id="'.$field->id_kategori.'" data-kategori="'.$field->nama_kategori.'">Hapus</button>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->BlogModel->count_all_kategori(),
            "recordsFiltered" => $this->BlogModel->count_kategori_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function kategori_add(){
        if($this->BlogModel->kategori_add()){
            $d['status'] = true;
        }else{
            $d['status'] = false;
        }
        echo json_encode($d);
    }

    public function kategori_update(){
        if($this->BlogModel->kategori_update()){
            $d['status'] = true;
        }else{
            $d['status'] = false;
        }
        echo json_encode($d);
    }

    public function kategori_delete($id){
        $cekid = $this->db->get_where('blog_kategori', ['id_kategori' => $id])->num_rows();
        if($cekid == 0){
            echo 'Error';
            die;
        }else{
            if($this->BlogModel->kategori_delete($id)){
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
}