<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Event extends CI_Controller
{
    public function index()
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($user) {
            if ($user['id_role'] == 2) {
                redirect('home');
            } else {
                $data['profil'] = $this->db->get('profile_perusahaan')->row();
                $data['content'] = "admin/event";
                $data['tiket'] = $this->tiket_model->getdataevent()->result_array();
                $this->load->view("template/adminlte", $data);
            }
        } else {
            redirect('home');
        }
    }

    public function tambah()
    {
        $data['profil'] = $this->db->get('profile_perusahaan')->row();
        $data['event'] = $this->db->get('event')->row();
        $data['js'] = array("event.js?r=" . rand());
        $data['content'] = "admin/tambah_event";
        $data['kategori'] = $this->tiket_model->datakategori()->result_array();
        $this->load->view("template/adminlte", $data);
    }

    // public function tambah_event()
    // {
    //     $upload = $_FILES['foto']['name'];
    //     if ($upload) {
    //         $config['allowed_types']    = 'jpg|png|jpeg';
    //         $config['upload_path']      = './assets/uploads/foto_event';
    //         $config['encrypt_name']     = TRUE;
    //         $this->load->library('upload', $config);
    //         $this->upload->initialize($config);
    //         if (!$this->upload->do_upload('foto')) {
    //             $error = array('error' => $this->upload->display_errors());
    //             $this->session->set_flashdata('message', '<div class="alert tutup alert-danger" role="alert">' . $error['error'] . '</div>');
    //             redirect('admin/Event/tambah');
    //         } else {
    //             $fileupload = $this->upload->data();
    //             $filename = pathinfo($fileupload['full_path']);
    //             $foto = $filename['basename'];
    //             $result = $this->tiket_model->tambah_event($foto);
    //         }
    //     } else {
    //         $foto = $this->input->post('foto_');
    //         $result = $this->tiket_model->tambah_event($foto);
    //     }

    //     if ($result) {
    //         $this->session->set_flashdata('message', '<div class="alert tutup alert-success" role="alert">Event Berhasil Di Tambah!</div>');
    //     } else {
    //         $this->session->set_flashdata('message', '<div class="alert tutup alert-danger" role="alert">Error!</div>');
    //     }
    //     redirect('admin/Event');
    // }

    public function tambah_event(){
        $upload = $_FILES['foto']['name'];
        if ($upload) {
            $numberOfFile = sizeof($upload);
            $files = $_FILES['foto'];
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['upload_path']      = './assets/uploads/foto_event';
            $config['encrypt_name']     = TRUE;
            $this->load->library('upload', $config);
            if ($numberOfFile <= 3){
                for ($i = 0; $i < $numberOfFile; $i++) {
                    $_FILES['foto']['name'] = $files['name'][$i];
                    $_FILES['foto']['type'] = $files['type'][$i];
                    $_FILES['foto']['tmp_name'] = $files['tmp_name'][$i];
                    $_FILES['foto']['error'] = $files['error'][$i];
                    $_FILES['foto']['size'] = $files['size'][$i];
    
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('foto')) {
                        $data = $this->upload->data();
                        $fotoName = $data['file_name'];
                        $cek = $this->tiket_model->cekData();
                        
                        if (!$cek) {
                            $group_foto = 1;
                        } else {
                            $group_foto = $cek['group_foto'] + 1;
                        }
                        $insert[$i]['foto'] = $fotoName;
                        $insert[$i]['group_foto'] = $group_foto;
                        $insert[$i]['date_created'] = date('d-m-Y H:i:s');
                    }
                }
            } else{
                $this->session->set_flashdata('message', '<div class="alert tutup alert-warning" role="alert">Upload Maksimal 3 foto</div>');
                redirect('admin/event');
            }
            
            if (!$insert && !$data) {
                $this->session->set_flashdata('message', '<div class="alert tutup alert-warning" role="alert">Tidak ada data yang disimpan</div>');
                redirect('admin/event');
            } else {
                if ($this->tiket_model->upload($insert) > 0) {
                    $lastid = $this->tiket_model->cekData();
                    $this->tiket_model->tambah_event($group_foto,$lastid['id']);
                    $this->session->set_flashdata('message', '<div class="alert tutup alert-success" role="alert">Event Berhasil Di Tambah!</div>');
                    redirect('admin/event');
                } else {

                    $this->session->set_flashdata('message', '<div class="alert tutup alert-danger" role="alert">Error!</div>');
                    redirect('admin/event');
                }
            }
        }
    }

    public function delete_event($id,$group)
    {
        $cekid          = $this->db->get_where('event', ['id_event' => $id])->num_rows();
        $detail         = $this->db->get_where('foto_event', ['group_foto' => $group]);
        if ($cekid == 0) {
            echo 'Error';
            die;
        } else {
            if ($this->tiket_model->delete_event($id)) {
                $detail = $this->tiket_model->detailfoto($group);
                foreach ($detail as $dt) {
                    $file_name = './assets/uploads/foto_event/' . $dt['foto'];
                    unlink($file_name);
                }
                $this->tiket_model->foto_delete($group);
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

    public function edit($id,$group)
    {
        $data['profil'] = $this->db->get('profile_perusahaan')->row();
        $data['event'] = $this->tiket_model->view_join($id)->row();
        $data['js'] = array("event.js?r=" . rand());
        $data['content'] = "admin/edit_event";
        $data['multiple_foto'] =  $this->tiket_model->getFotoGroup($group);
        $data['kategori'] = $this->tiket_model->datakategori()->result_array();
        $this->load->view("template/adminlte", $data);
    }

    public function update_gambar($id)
    {
        $id_event                   = $this->input->post('id_event');
        $group                      = $this->input->post('group');
        $config['upload_path']      = './assets/uploads/foto_event/';
        $config['allowed_types']    = 'jpg|jpeg|png|gif|ico|jfif';
        $config['encrypt_name']     = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $field_name = 'foto';
        if (!$this->upload->do_upload($field_name)) {
            echo "Gagal Update Gambar !";
        } else {
            $detail                     = $this->db->get_where('foto_event', array('id' => $id))->row();
            $path                       = './assets/uploads/foto_event/' . $detail->foto;
            unlink($path);
            $fileupload = $this->upload->data();
            $filename   = pathinfo($fileupload['full_path']);
            $foto       = $filename['basename'];
            $result     = $this->tiket_model->update_foto($foto, $id);
        }
        if ($result) {
            $this->session->set_flashdata('message', '<div class="alert tutup alert-success" role="alert">Foto Berhasil Di Update!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert tutup alert-danger" role="alert">Error!</div>');
        }
        redirect(base_url('admin/event/edit/') . $id_event .'/'.$group);
    }

    public function edit_event()
    {
        $id_event   = $this->input->post('id_event');
        $result     = $this->tiket_model->update_event();
        $group      = $this->input->post('group');
        if ($result) {
            $this->session->set_flashdata('message', '<div class="alert tutup alert-success" role="alert">Event Berhasil Di Update!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert tutup alert-danger" role="alert">Error!</div>');
        }
        redirect(base_url('admin/event/edit/') . $id_event .'/'.$group);
    }

    public function kategori()
    {
        $data['profil'] = $this->db->get('profile_perusahaan')->row();
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
