<?php
class PartnerModel extends CI_Model
{

    var $table = 'partner'; //nama tabel dari database
    var $column_order = array('nama', 'status'); //field yang ada di table
    var $column_search = array('nama'); //field yang diizin untuk pencarian
    var $order = array('nama' => 'asc'); // default order

    public function partner_data()
    {
        $this->_get_partner_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    private function _get_partner_query()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
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

    function count_partner_filtered()
    {
        $this->_get_partner_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_partner()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function create_partner($foto){
        $data=array(
          'nama'           => htmlspecialchars($this->input->post('nama'),ENT_QUOTES),
          'foto'           => htmlspecialchars($foto,ENT_QUOTES),
          'status'         => htmlspecialchars($this->input->post('status'),ENT_QUOTES),
        );
        $result=$this->db->insert('partner', $data);
        return $result;
    }
  
    function update_partner($foto, $is_unlink=NULL){
        $id = htmlspecialchars($this->input->post('id'),ENT_QUOTES);
  
        if($is_unlink != 'no'){
          $image = $this->db->get_where('partner', ['id_partner' => $id])->row()->foto;
          $file_name = str_replace(base_url(), '', $image);
          unlink($file_name);
        }
  
        $data=array(
            'nama'           => htmlspecialchars($this->input->post('nama'),ENT_QUOTES),
            'foto'           => htmlspecialchars($foto,ENT_QUOTES),
            'status'         => htmlspecialchars($this->input->post('status'),ENT_QUOTES),
        );
        $this->db->where('id_partner', $id);
        $result=$this->db->update('partner', $data);
        return $result;
    }

    function delete_partner($id){
        $image = $this->db->get_where('partner', ['id_partner' => $id])->row()->foto;
        $file_name = str_replace(base_url(), '', $image);
        unlink($file_name);
    
        $this->db->where('id_partner', $id);
        $result=$this->db->delete('partner');
        return $result;
      }
}