<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Partner extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PartnerModel');
    }

    public function index()
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($user) {
            if ($user['id_role'] == 2) {
                redirect('home');
            } else {
                $data['title'] = 'Partner';
                $data['content'] = "admin/partner";
                $data['js'] = array("partner.js?r=" . rand());
                $this->load->view("template/adminlte", $data);
            }
        } else {
            redirect('home');
        }
    }


    public function partner_()
    {
        $list = $this->PartnerModel->partner_data();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->nama;
            $row[] = '<img src="' . $field->foto . '" class="img-thumbnail" width="200">';
            $row[] = ($field->status == 1) ? '<span class="badge badge-success">On</span>' : '<span class="badge badge-danger">Off</span>';
            $row[] = '<button type="button" class="btn btn-info btn-sm edit" data-id="' . $field->id_partner . '" data-foto="' . $field->foto . '" data-nama="' . $field->nama . '" data-status="' . $field->status . '">Edit</button>
                      <button type="button" class="ml-1 btn btn-danger delete btn-sm" data-id="' . $field->id_partner . '" data-nama="' . $field->nama . '">Hapus</button>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->PartnerModel->count_all_partner(),
            "recordsFiltered" => $this->PartnerModel->count_partner_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function create_partner()
    {
        if ($_FILES["foto"]["name"]) {
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '2024';
            $config['upload_path'] = './assets/partner';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('admin/partner/index');
            } else {
                $fileupload = $this->upload->data();
                $filename = pathinfo($fileupload['full_path']);
                $foto = base_url('assets/partner/' . $filename['basename']);
            }
        } else {
            $foto = null;
        }

        if (!$this->PartnerModel->create_partner($foto)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan partner</div>');
            redirect('admin/partner/index');
        }
    }

    public function update_partner()
    {
        if ($_FILES["foto"]["name"]) {
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '2024';
            $config['upload_path'] = './assets/partner';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('admin/partner/index');
            } else {
                $fileupload = $this->upload->data();
                $filename = pathinfo($fileupload['full_path']);
                $foto = base_url('assets/partner/' . $filename['basename']);
            }
        } else {
            $foto = $this->input->post('foto_');
            $is_unlink = 'no';
        }

        if (!$this->PartnerModel->update_partner($foto, $is_unlink)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal update data partner</div>');
            redirect('admin/partner/index');
        }
    }

    function delete_partner($id)
    {
        $id_ = htmlspecialchars($id, ENT_QUOTES);
        if ($this->PartnerModel->delete_partner($id_)) {
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
