<?php

class mKategori extends CI_Model {
    public function getData() {
        return $this->db->get("tbl_m_kategori")->result();
    }

    public function insertData($data) {
        return $this->db->insert("tbl_m_kategori", $data);
    }

    public function getDataById($id) {
        $this->db->where('id_kategori', $id);
        return $this->db->get('tbl_m_kategori')->row();
    }

    public function updateData($id, $data) {
        $this->db->where('id_kategori', $id);
        return $this->db->update('tbl_m_kategori', $data);
    }

    public function deleteData($id) {
        $this->db->where('id_kategori', $id);
        return $this->db->delete('tbl_m_kategori');
    }

    public function cekDuplicate($kategori) {
        $this->db->where('nama_kategori', $kategori);
        $query = $this->getDataById('tbl_m_kategori');
        return $query->num_rows();
    }
}