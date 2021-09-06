<?php
class SettingModel extends CI_Model {
    public function updateProfilPerusahaan($logo = NULL){
        $data=array(
            'nama' => htmlspecialchars($this->input->post('nama'),ENT_QUOTES),
            'tentang' => htmlspecialchars($this->input->post('tentang'),ENT_QUOTES),
            'logo' => htmlspecialchars($logo, ENT_QUOTES),
            'email' => htmlspecialchars($this->input->post('email'),ENT_QUOTES),
            'alamat' => htmlspecialchars($this->input->post('alamat'),ENT_QUOTES),
            'nomor_kontak' => htmlspecialchars($this->input->post('nomor_kontak'),ENT_QUOTES),
            'instagram' => htmlspecialchars($this->input->post('instagram'),ENT_QUOTES),
            'facebook' => htmlspecialchars($this->input->post('facebook'),ENT_QUOTES),
            'twitter' => htmlspecialchars($this->input->post('twitter'),ENT_QUOTES),
            'visi' => htmlspecialchars($this->input->post('visi'),ENT_QUOTES),
            'misi' => htmlspecialchars($this->input->post('misi'),ENT_QUOTES),
        );
        $this->db->where('id', htmlspecialchars($this->input->post('id'),ENT_QUOTES));
        return $this->db->update('profile_perusahaan', $data);
    }
}