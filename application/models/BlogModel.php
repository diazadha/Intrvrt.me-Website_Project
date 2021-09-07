<?php
class BlogModel extends CI_Model
{

    var $table = 'blog_kategori'; //nama tabel dari database
    var $column_order = array('nama_kategori', 'status'); //field yang ada di table
    var $column_search = array('nama_kategori'); //field yang diizin untuk pencarian
    var $order = array('nama_kategori' => 'asc'); // default order

    public function kategori_data()
    {
        $this->_get_kategori_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function kategori_add()
    {
        $data = array(
            'nama_kategori' => htmlspecialchars($this->security->xss_clean($this->input->post('kategori')), ENT_QUOTES),
            'status' => htmlspecialchars($this->security->xss_clean($this->input->post('status')), ENT_QUOTES),
        );
        return $this->db->insert($this->table, $data);
    }

    public function kategori_update()
    {
        $id = htmlspecialchars($this->security->xss_clean($this->input->post('id')), ENT_QUOTES);
        $data = array(
            'nama_kategori' => htmlspecialchars($this->security->xss_clean($this->input->post('kategori')), ENT_QUOTES),
            'status' => htmlspecialchars($this->security->xss_clean($this->input->post('status')), ENT_QUOTES),
        );
        $this->db->where('id_kategori', $id);
        return $this->db->update($this->table, $data);
    }

    public function kategori_delete($id)
    {
        $this->db->where('id_kategori', $id);
        $result = $this->db->delete($this->table);
        return $result;
    }

    private function _get_kategori_query()
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

    function count_kategori_filtered()
    {
        $this->_get_kategori_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_kategori()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}
