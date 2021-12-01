<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cronjob extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CronjobModel');
    }

    public function kirim_link(){
        date_default_timezone_set('Asia/Jakarta');
        $getAcara = $this->CronjobModel->get_acara();
        foreach($getAcara->result() as $r ){
            //ambil tgl acara - 1 hari sebelumnya
            $tglkirim = date('Y-m-d', strtotime($r->tgl_acara. ' - 1 days'));
            if($tglkirim == date('Y-m-d')){
                //kirim email link acara
                //send email notif;
                $config = [
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_user' => 'intrvrt.me1@gmail.com',
                    'smtp_pass' => 'Ayamgoreng123',
                    'smtp_port' => 465,
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'newline' => "\r\n",
                    'validation' => TRUE // bool whether to validate email or not  
                ];
                $this->load->library('email', $config);
                $this->email->initialize($config);
                $this->email->from('intrvrt.me1@gmail.com', 'Intrvrt.me');
                $this->email->to($r->email);
                $this->email->subject('Verifikasi Akun');

                $message = "Hi <b>$r->nama_user</b>, <br>
                Besok adalah acaranya !!!<br><br>

                Berikut kami kirimkan link acara yang akan diadakan besok hari.<br><br>
                Nama Acara: $r->nama_event<br>
                Kategori:$r->nama_kategori<br>
                Link Acara: $r->linkevent<br><br>

                <div style='float:right'>
                <h2 style='margin-bottom: -2px;'>Regards,</h2>
                Intrvrt.me
                </div>
                ";
                $this->email->message($message);
                $this->email->send();

                //update link terkirim
                $data=array(
                    'kirim_link' => 'Y'
                );
                $this->db->where('id', $r->id);
                $this->db->update('keranjang_event', $data);
            }
        }
    }
}
