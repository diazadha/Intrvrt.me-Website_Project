<?php
class BlogModel extends CI_Model
{

    var $table_konten = 'blog_data'; //nama tabel dari database
    var $join = 'user'; //nama tabel dari database
    var $column_order_konten = array('judul', 'status'); //field yang ada di table
    var $column_search_konten = array('judul'); //field yang diizin untuk pencarian
    var $order_konten = array('judul' => 'asc'); // default order

    public function konten_add($foto)
    {
        if (!isset($_POST['draft'])) {
            $status = 1;
        } else {
            $status = 2;
        }

        date_default_timezone_set('Asia/Jakarta');
        $kategori = implode(',', $_POST['kategori']); 
        $slug = strtolower(url_title($this->input->post('judul')));
        $data = array(
            'judul' => htmlspecialchars($this->input->post('judul'), ENT_QUOTES),
            'isi_konten' => htmlspecialchars($this->input->post('isi'), ENT_QUOTES),
            'slug' => htmlspecialchars($slug, ENT_QUOTES), 
            'foto' => htmlspecialchars($foto, ENT_QUOTES), 
            'kategori' => htmlspecialchars($kategori, ENT_QUOTES), 
            'status' => htmlspecialchars($status, ENT_QUOTES),
            'penulis' => $this->session->userdata('id_user'),
            'tanggal_dibuat' => date('Y-m-d H:i:s')
        );
        return $this->db->insert('blog_data', $data);
    }

    public function konten_update($foto)
    {
        if (!isset($_POST['draft'])) {
            $status = 1;
        } else {
            $status = 2;
        }

        date_default_timezone_set('Asia/Jakarta');
        $kategori = implode(',', $_POST['kategori']); 
        $slug = strtolower(url_title($this->input->post('judul')));
        $id = htmlspecialchars($this->input->post('id'), ENT_QUOTES);
        $data = array(
            'judul' => htmlspecialchars($this->input->post('judul'), ENT_QUOTES),
            'isi_konten' => htmlspecialchars($this->input->post('isi'), ENT_QUOTES),
            'slug' => htmlspecialchars($slug, ENT_QUOTES), 
            'foto' => htmlspecialchars($foto, ENT_QUOTES), 
            'kategori' => htmlspecialchars($kategori, ENT_QUOTES), 
            'status' => htmlspecialchars($status, ENT_QUOTES),
            'penulis' => $this->session->userdata('id_user'),
            'tanggal_dibuat' => date('Y-m-d H:i:s')
        );
        $this->db->where('id_blog', $id);
        return $this->db->update('blog_data', $data);
    }

    public function get_konten($id)
    {
        $this->db->from($this->table_konten);
        $this->db->where('id_blog', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function konten_data()
    {
        $this->_get_konten_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    private function _get_konten_query()
    {
        $this->db->select('blog_data.*, user.nama_user as nama_penulis');
        $this->db->from($this->table_konten);
        $this->db->join('user', 'user.id_user = blog_data.penulis');
        $i = 0;
        foreach ($this->column_search_konten as $item) {
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
            $this->db->order_by($this->column_order_konten[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order_konten;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function count_konten_filtered()
    {
        $this->_get_kategori_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_konten()
    {
        $this->db->from($this->table_konten);
        return $this->db->count_all_results();
    }

    public function konten_delete($id)
    {
        // unlink();
        $this->db->where('id_blog', $id);
        $result = $this->db->delete($this->table_konten);
        return $result;
    }

    //KATEGORI BLOG
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

    public function get_kategori_IN($id, $return)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where_in('id_kategori', explode(',', $id));
        $query = $this->db->get();
        if($return == 'data'){
            return $query->result();
        }else{
            $kategori='';
            foreach($query->result() as $kt){
                $kategori.='#'.$kt->nama_kategori.', ';
            }
            return rtrim($kategori, ', ');
        }
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
        $query="SELECT kategori FROM blog_data WHERE kategori LIKE '%$id%'";
        $result = $this->db->query($query)->result();
        $arr = '';
        foreach($result as $r){
            $arr.= $r->kategori.',';
        }
        
        $str = rtrim($arr,',');
        $array = explode(',', $str);

        if(array_search($id, $array) != ''){
            return 'gagal';
        }else{
            $this->db->where('id_kategori', $id);
            $this->db->delete($this->table);
            return 'sukses';
        }
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

    public function get_kategori(){
        return $this->db->get_where('blog_kategori', ['status' => 1])->result();
    }
}
