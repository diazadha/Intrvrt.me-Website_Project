<?php
class MerchandiseModel extends CI_Model
{

    var $table = 'merchandise_kategori'; //nama tabel dari database
    var $column_order = array('nama_kategori_merch', 'status'); //field yang ada di table
    var $column_search = array('nama_kategori_merch'); //field yang diizin untuk pencarian
    var $order = array('nama_kategori_merch' => 'asc'); // default order

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
            'nama_kategori_merch' => htmlspecialchars($this->security->xss_clean($this->input->post('kategori')), ENT_QUOTES),
            'status' => htmlspecialchars($this->security->xss_clean($this->input->post('status')), ENT_QUOTES),
        );
        return $this->db->insert($this->table, $data);
    }

    public function kategori_update()
    {
        $id = htmlspecialchars($this->security->xss_clean($this->input->post('id')), ENT_QUOTES);
        $data = array(
            'nama_kategori_merch' => htmlspecialchars($this->security->xss_clean($this->input->post('kategori')), ENT_QUOTES),
            'status' => htmlspecialchars($this->security->xss_clean($this->input->post('status')), ENT_QUOTES),
        );
        $this->db->where('id_kategori_merch', $id);
        return $this->db->update($this->table, $data);
    }

    public function kategori_delete($id)
    {
        $cekrelasi = $this->db->get_where('merchandise', ['kategori' => $id])->result();
        if (!empty($cekrelasi)) {
            return 'gagal';
        } else {
            $this->db->where('id_kategori_merch', $id);
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

    var $table2 = 'merchandise'; //nama tabel dari database
    var $column_order2 = array('nama_merch', 'kategori', 'harga', 'diskon', 'deskripsi'); //field yang ada di table
    var $column_search2 = array('nama_merch'); //field yang diizin untuk pencarian
    var $order2 = array('nama_merch' => 'asc'); // default order

    public function merchandise_data()
    {
        $this->_get_merchandise_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function merchandise_update()
    {
        $id = htmlspecialchars($this->security->xss_clean($this->input->post('id')), ENT_QUOTES);
        $data = array(
            'nama_merch' => htmlspecialchars($this->security->xss_clean($this->input->post('merchandise')), ENT_QUOTES),
            'kategori' => htmlspecialchars($this->security->xss_clean($this->input->post('kategori')), ENT_QUOTES),
            'harga' => htmlspecialchars($this->security->xss_clean($this->input->post('harga')), ENT_QUOTES),
            'diskon' => htmlspecialchars($this->security->xss_clean($this->input->post('diskon')), ENT_QUOTES),
            'deskripsi' => htmlspecialchars($this->security->xss_clean($this->input->post('deskripsi')), ENT_QUOTES),
        );
        $this->db->where('id_merch', $id);
        return $this->db->update($this->table2, $data);
    }

    public function merchandise_delete($id)
    {
        $this->db->where('id_merch', $id);
        $result = $this->db->delete($this->table2);
        return $result;
    }

    public function foto_delete($group)
    {
        // $detail         = $this->MerchandiseModel->getFotoGroup($group);
        $this->db->where('group_foto', $group);
        $result = $this->db->delete('foto_merchandise');
        return $result;
    }

    private function _get_merchandise_query()
    {
        $this->db->select('*');
        $this->db->from($this->table2);
        $this->db->join('merchandise_kategori', 'merchandise.kategori = merchandise_kategori.id_kategori_merch');
        $i = 0;
        foreach ($this->column_search2 as $item) {
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
            $this->db->order_by($this->column_order2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order2)) {
            $order2 = $this->order2;
            $this->db->order_by(key($order2), $order2[key($order2)]);
        }
    }

    function count_merchandise_filtered()
    {
        $this->_get_merchandise_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_merchandise()
    {
        $this->db->from($this->table2);
        return $this->db->count_all_results();
    }

    public function tambah_merchandise($group_foto, $lastid)
    {
        $data = array(
            'nama_merch' => htmlspecialchars($this->security->xss_clean($this->input->post('merchandise')), ENT_QUOTES),
            'kategori' => htmlspecialchars($this->security->xss_clean($this->input->post('kategori')), ENT_QUOTES),
            'stock' => htmlspecialchars($this->security->xss_clean($this->input->post('stock')), ENT_QUOTES),
            'harga' => htmlspecialchars($this->security->xss_clean($this->input->post('harga')), ENT_QUOTES),
            'berat' => htmlspecialchars($this->security->xss_clean($this->input->post('berat')), ENT_QUOTES),
            'foto' => htmlspecialchars($group_foto, ENT_QUOTES),
            'foto_utama' => $lastid,
            'diskon' => htmlspecialchars($this->security->xss_clean($this->input->post('diskon')), ENT_QUOTES),
            'deskripsi' => htmlspecialchars($this->security->xss_clean($this->input->post('deskripsi')), ENT_QUOTES),
            'is_deliver' => htmlspecialchars($this->security->xss_clean($this->input->post('is_deliver')), ENT_QUOTES),
            'linkebook' => htmlspecialchars($this->security->xss_clean($this->input->post('linkebook')), ENT_QUOTES),
        );  
        return $this->db->insert('merchandise', $data);
    }

    public function update_foto($foto = NULL, $id = NULL)
    {
        $data = array(
            'foto' => htmlspecialchars($foto, ENT_QUOTES),
        );
        $this->db->where('id', $id);
        return $this->db->update('foto_merchandise', $data);
    }

    public function cekData()
    {
        $this->db->limit(1);
        $this->db->order_by('group_foto', 'DESC');
        return $this->db->get('foto_merchandise')->row_array();
    }

    public function upload($insert, $data)
    {
        $this->db->insert_batch('foto_merchandise', $insert);
        // $this->db->set('main_foto', 1);
        // $this->db->where('foto', $data);
        // $this->db->update('foto_merchandise');
        return $this->db->affected_rows();
    }

    public function getDataGroup()
    {
        $this->db->where('main_foto =', 1);
        $this->db->group_by('group_foto');
        return $this->db->get('foto_merchandise')->result_array();
    }

    public function getFotoGroup($group)
    {
        $this->db->where('group_foto =', $group);
        return $this->db->get('foto_merchandise')->result_array();
    }

    public function detailfoto($group)
    {
        return $this->db->get_where('foto_merchandise', ['group_foto' => $group])->result_array();
    }

    public function update_merch()
    {
        $data = array(
            'nama_merch' => htmlspecialchars($this->security->xss_clean($this->input->post('merchandise')), ENT_QUOTES),
            'kategori' => htmlspecialchars($this->security->xss_clean($this->input->post('kategori')), ENT_QUOTES),
            'stock' => htmlspecialchars($this->security->xss_clean($this->input->post('stock')), ENT_QUOTES),
            'harga' => htmlspecialchars($this->security->xss_clean($this->input->post('harga')), ENT_QUOTES),
            'berat' => htmlspecialchars($this->security->xss_clean($this->input->post('berat')), ENT_QUOTES),
            'foto_utama' => htmlspecialchars($this->security->xss_clean($this->input->post('main_foto')), ENT_QUOTES),
            'diskon' => htmlspecialchars($this->security->xss_clean($this->input->post('diskon')), ENT_QUOTES),
            'deskripsi' => htmlspecialchars($this->security->xss_clean($this->input->post('deskripsi')), ENT_QUOTES),
            'is_deliver' => htmlspecialchars($this->security->xss_clean($this->input->post('is_deliver')), ENT_QUOTES),
            'linkebook' => htmlspecialchars($this->security->xss_clean($this->input->post('linkebook')), ENT_QUOTES),
        );
        $this->db->where('id_merch', htmlspecialchars($this->security->xss_clean($this->input->post('id_merch')), ENT_QUOTES));
        return $this->db->update('merchandise', $data);
    }

    public function update_main_foto()
    {
        $data = array(
            'main_foto' => htmlspecialchars($this->security->xss_clean($this->input->post('main_foto')), ENT_QUOTES),
        );
        $this->db->where('id', htmlspecialchars($this->security->xss_clean($this->input->post('id_foto')), ENT_QUOTES));
        return $this->db->update('foto_merchandise', $data);
    }

    public function view_join($id)
    {
        $query = "SELECT * FROM merchandise, merchandise_kategori WHERE kategori = id_kategori_merch AND id_merch = $id";
        return $this->db->query($query);
    }

    public function datakategori()
    {
        $query = "SELECT * FROM merchandise_kategori WHERE status = 1";
        return $this->db->query($query);
    }

    public function getallmerchandise()
    {
        $query = "SELECT foto_merchandise.foto, merchandise_kategori.nama_kategori_merch, merchandise.nama_merch, merchandise.harga, merchandise.diskon, merchandise.deskripsi, merchandise.id_merch, merchandise.kategori, stock
        FROM foto_merchandise, merchandise, merchandise_kategori
        where merchandise.foto_utama = foto_merchandise.id and merchandise.kategori = merchandise_kategori.id_kategori_merch
        ";
        return $this->db->query($query);
    }

    public function getfotobyid($id, $foto)
    {
        $this->db->select('foto_merchandise.foto');
        $this->db->from('foto_merchandise');
        $this->db->join('merchandise', 'merchandise.foto = foto_merchandise.group_foto');
        $this->db->join('merchandise_kategori', 'merchandise.kategori = merchandise_kategori.id_kategori_merch');
        $this->db->where('merchandise.id_merch', $id);
        $this->db->where('foto_merchandise.foto !=', $foto);

        return $this->db->get();
    }

    public function getdatabyid($id)
    {
        $query = "SELECT merchandise_kategori.nama_kategori_merch, merchandise.nama_merch, merchandise.harga, stock, merchandise.diskon, merchandise.deskripsi, merchandise.id_merch, foto_merchandise.foto
        FROM merchandise, merchandise_kategori, foto_merchandise
        where merchandise.kategori = merchandise_kategori.id_kategori_merch and merchandise.foto_utama = foto_merchandise.id and merchandise.id_merch = $id";
        return $this->db->query($query);
    }

    public function getallmerchandisebykategori($id)
    {
        $query = "SELECT foto_merchandise.foto, merchandise_kategori.nama_kategori_merch, merchandise.nama_merch, merchandise.harga, merchandise.diskon, merchandise.deskripsi, merchandise.id_merch, merchandise.kategori
        FROM foto_merchandise, merchandise, merchandise_kategori
        where merchandise.foto_utama = foto_merchandise.id and merchandise.kategori = merchandise_kategori.id_kategori_merch and merchandise.kategori = $id";
        return $this->db->query($query);
    }


    public function getallmerchandiselimit()
    {
        $query = "SELECT foto_merchandise.foto, merchandise_kategori.nama_kategori_merch, merchandise.nama_merch, merchandise.harga, merchandise.diskon, merchandise.deskripsi, merchandise.id_merch, merchandise.kategori
        FROM foto_merchandise, merchandise, merchandise_kategori
        where merchandise.foto_utama = foto_merchandise.id and merchandise.kategori = merchandise_kategori.id_kategori_merch
        order by merchandise.id_merch DESC
        LIMIT 5
        ";
        return $this->db->query($query);
    }

    public function cek_keranjang($id_merch, $id_user)
    {
        $query = "SELECT *
        FROM keranjang_merchandise
        WHERE id_merchandise = $id_merch AND id_user = $id_user";
        return $this->db->query($query);
    }

    public function get_keranjang($id_user)
    {
        $query = "SELECT keranjang_merchandise.*, foto_merchandise.*, merchandise.id_merch, merchandise.nama_merch, merchandise.stock, merchandise.harga, merchandise.diskon, merchandise.is_deliver
        FROM keranjang_merchandise, user, merchandise, foto_merchandise
        WHERE user.id_user = keranjang_merchandise.id_user AND keranjang_merchandise.id_user = $id_user AND merchandise.id_merch = keranjang_merchandise.id_merchandise AND foto_merchandise.id = merchandise.foto_utama";
        return $this->db->query($query);
    }

    public function uncheck_status_merchandise($id_keranjang)
    {
        $query = "UPDATE keranjang_merchandise SET keranjang_merchandise.status = 0 WHERE id_keranjang = $id_keranjang";
        return $this->db->query($query);
    }

    public function check_status_merchandise($id_keranjang)
    {
        $query = "UPDATE keranjang_merchandise SET keranjang_merchandise.status = 1 WHERE id_keranjang = $id_keranjang";
        return $this->db->query($query);
    }

    public function get_keranjang_byid($id_keranjang)
    {
        $query = "SELECT *
        FROM keranjang_merchandise
        WHERE id_keranjang = $id_keranjang";
        return $this->db->query($query);
    }

    public function getkeranjangdipilih($id)
    {
        $query = "SELECT *
        FROM keranjang_merchandise, merchandise
        WHERE status = 1 AND id_merchandise = id_merch AND id_user = $id";
        return $this->db->query($query);
    }

    public function is_deliv($id){
        $query = "SELECT *
        FROM keranjang_merchandise, merchandise
        WHERE status = 1 AND id_merchandise = id_merch AND id_user = $id AND is_deliver = 0 ";
        return $this->db->query($query);
    }

    public function checkout()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = array(
            'id_user' => htmlspecialchars($this->security->xss_clean($this->input->post('id_user')), ENT_QUOTES),
            'tgl_pesan' => date('Y-m-d H:i:s'),
            'expedisi' => htmlspecialchars($this->security->xss_clean($this->input->post('expedisi')), ENT_QUOTES),
            'paket' => htmlspecialchars($this->security->xss_clean($this->input->post('paket')), ENT_QUOTES),
            'email_penerima' => htmlspecialchars($this->security->xss_clean($this->input->post('email_penerima')), ENT_QUOTES),
            'estimasi' => htmlspecialchars($this->security->xss_clean($this->input->post('estimasi')), ENT_QUOTES),
            'ongkir' => htmlspecialchars($this->security->xss_clean($this->input->post('ongkir')), ENT_QUOTES),
            'berat' => htmlspecialchars($this->security->xss_clean($this->input->post('berat')), ENT_QUOTES),
            'grand_total' => htmlspecialchars($this->security->xss_clean($this->input->post('grand_total')), ENT_QUOTES),
            'total_bayar' => htmlspecialchars($this->security->xss_clean($this->input->post('total_bayar')), ENT_QUOTES),
            'nama_penerima' => htmlspecialchars($this->security->xss_clean($this->input->post('nama_penerima')), ENT_QUOTES),
            'tlpn_penerima' => htmlspecialchars($this->security->xss_clean($this->input->post('tlpn_penerima')), ENT_QUOTES),
            'alamat' => htmlspecialchars($this->security->xss_clean($this->input->post('alamat')), ENT_QUOTES),
            'provinsi' => htmlspecialchars($this->security->xss_clean($this->input->post('provinsi')), ENT_QUOTES),
            'kota' => htmlspecialchars($this->security->xss_clean($this->input->post('kota')), ENT_QUOTES),
            'kodepos' => htmlspecialchars($this->security->xss_clean($this->input->post('kodepos')), ENT_QUOTES),

        );
        return $this->db->insert('pesanan_m', $data);
    }

    public function detailpesanan($id_pesanan){
        $query = "SELECT MAX(id_pesanan) AS id_pesanan FROM pesanan_m";
        $id_pesanan = $this->db->query($query)->row_array();
        foreach ($this->MerchandiseModel->getkeranjangdipilih($this->session->userdata('id_user'))->result_array() as $items){
            $data = array(
            'id_pesanan' => $id_pesanan['id_pesanan'],
            'id_merch' => $items['id_merch'],
            'qty' => $items['qty'],
        );
        $this->db->insert('detailpesanan_m', $data);
        }
        return 'berhasil';
    }
}
