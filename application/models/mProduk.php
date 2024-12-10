<?php

class mProduk extends CI_Model {
    public function getData() {
        $this->db->select('p.*, k.nama_kategori, s.nama_satuan');
        $this->db->from('tbl_m_produk p');
        $this->db->join('tbl_m_kategori k','p.id_kategori = k.id_kategori', 'inner');
        $this->db->join('tbl_m_satuan s','p.id_satuan = s.id_satuan', 'inner');
        return $this->db->get()->result();
    }

    public function insertData($data) {
        $this->db->insert('tbl_m_produk', $data);
    }

    public function getDataById($id) {
        $this->db->where('id_produk', $id);
        return $this->db->get('tbl_m_produk')->row();
    }

    public function updateData($id, $data) {
        $this->db->where('id_produk', $id);
        return $this->db->update('tbl_m_produk', $data);
    }

    public function deleteData($id) {
        $this->db->where('id_produk', $id);
        return $this->db->delete('tbl_m_produk');
    }

    public function cekDuplicate($kategori) {
        $this->db->where('nama_produk', $kategori);
        $query = $this->db->get('tbl_m_produk');
        return $query->num_rows();
    }

    public function getKode($id_kategori) {
        $query = $this->db->query("SELECT MAX(RIGHT(id_produk, 6)) AS id_max FROM tbl_m_produk");
        $isCode = '';
        if($query->num_rows() > 0) {
            foreach ($query->result() as $k) {
                $tmp = ((int)$k->id_max) +1;
                $isCode = sprintf('%06d', $tmp);
            }
        } else {
            $isCode = "000001";
        }
        return $id_kategori. $isCode;
    }
}