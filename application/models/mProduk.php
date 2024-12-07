<?php

class mProduk extends CI_Model {
    public function getData() {
        $this->db->select('tbl_m_produk.*, tbl_m_kategori.nama_kategori, tbl_m_satuan.nama_satuan');
        $this->db->from('tbl_m_produk');
        $this->db->join('tbl_m_kategori','tbl_m_kategori.id_kategori = tbl_m_produk.id_kategori', 'inner');
        $this->db->join('tbl_m_satuan','tbl_m_satuan.id_satuan = tbl_m_produk.id_kategori', 'inner');
        $result = $this->db->get();
        return $result;
    }
}