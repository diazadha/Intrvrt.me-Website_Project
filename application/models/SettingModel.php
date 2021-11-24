<?php
class SettingModel extends CI_Model {
    public function updateProfilPerusahaan($logo = NULL){
        $data=array(
            'nama' => htmlspecialchars($this->security->xss_clean($this->input->post('nama')),ENT_QUOTES),
            'tentang' => htmlspecialchars($this->security->xss_clean($this->input->post('tentang')),ENT_QUOTES),
            'logo' => htmlspecialchars($logo, ENT_QUOTES),
            'email' => htmlspecialchars($this->security->xss_clean($this->input->post('email')),ENT_QUOTES),
            'alamat' => htmlspecialchars($this->security->xss_clean($this->input->post('alamat')),ENT_QUOTES),
            'nomor_kontak' => htmlspecialchars($this->security->xss_clean($this->input->post('nomor_kontak')),ENT_QUOTES),
            'visi' => htmlspecialchars($this->security->xss_clean($this->input->post('visi')),ENT_QUOTES),
            'misi' => htmlspecialchars($this->security->xss_clean($this->input->post('misi')),ENT_QUOTES),
        );
        $this->db->where('id', htmlspecialchars($this->security->xss_clean($this->input->post('id')),ENT_QUOTES));
        return $this->db->update('profile_perusahaan', $data);
    }

    var $table = 'sosmed'; //nama tabel dari database
    var $column_order = array('sosmed', 'url', 'status'); //field yang ada di table
    var $column_search = array('sosmed'); //field yang diizin untuk pencarian
    var $order = array('sosmed' => 'asc'); // default order

    public function getRowPerusahaan($field=null){
        if($field == null){
            return '-';
        }else{
            return $this->db->get('profile_perusahaan')->row()->$field;
        }
    }

    public function sosmed_data()
    {
        $this->_get_sosmed_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    private function _get_sosmed_query()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) {
            if ( $_POST['search']['value']) {
                if ($i === 0) // looping awal
                {
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function count_sosmed_filtered()
    {
        $this->_get_sosmed_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_sosmed()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function create_sosmed($foto){
        $data=array(
          'sosmed'   => htmlspecialchars($this->input->post('sosmed'),ENT_QUOTES),
          'url'      => htmlspecialchars($this->input->post('url'),ENT_QUOTES),
          'icon'     => htmlspecialchars($foto,ENT_QUOTES),
          'status'   => htmlspecialchars($this->input->post('status'),ENT_QUOTES),
        );
        $result=$this->db->insert('sosmed', $data);
        return $result;
    }
  
    function update_sosmed($foto, $is_unlink=NULL){
        $id = htmlspecialchars($this->input->post('id'),ENT_QUOTES);
  
        if($is_unlink != 'no'){
          $image = $this->db->get_where('sosmed', ['id_sosmed' => $id])->row()->foto;
          $file_name = str_replace(base_url(), '', $image);
          unlink($file_name);
        }
  
        $data=array(
            'sosmed'           => htmlspecialchars($this->input->post('sosmed'),ENT_QUOTES),
            'url'           => htmlspecialchars($this->input->post('url'),ENT_QUOTES),
            'icon'           => htmlspecialchars($foto,ENT_QUOTES),
            'status'         => htmlspecialchars($this->input->post('status'),ENT_QUOTES),
        );
        $this->db->where('id_sosmed', $id);
        $result=$this->db->update('sosmed', $data);
        return $result;
    }

    function delete_sosmed($id){
        $image = $this->db->get_where('sosmed', ['id_sosmed' => $id])->row()->icon;
        $file_name = str_replace(base_url(), '', $image);
        unlink($file_name);
    
        $this->db->where('id_sosmed', $id);
        $result=$this->db->delete('sosmed');
        return $result;
      }
}