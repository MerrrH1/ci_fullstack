<?php

class mProduk extends CI_Model {
    public function getData() {
        $this->db->select('tbl_m_produk.*, tbl_m_kategori.nama_kategori, tbl_m_satuan.nama_satuan');
        $this->db->from('tbl_m_produk');
        $this->db->join('tbl_m_kategori','tbl_m_kategori.id_kategori = tbl_m_produk.id_kategori', 'inner');
        $this->db->join('tbl_m_satuan','tbl_m_satuan.id_satuan = tbl_m_produk.id_kategori', 'inner');
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
        $query = $this->db->query("SELECT MAX(RIGHT(id_produk, 6)) AS id_max FROM tbl_m_produk WHERE id_kategori='$id_kategori'");
        $isCode = '';
        if($query->num_rows() > 0) {
            foreach ($query->result() as $k) {
                $tmp = ((int)$k->id_max) +1;
                $isCode = sprintf('%OGs', $tmp);
            }
        } else {
            $isCode = "000001";
        }
        return $id_kategori. $isCode;
    }
}