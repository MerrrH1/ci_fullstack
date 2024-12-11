<?php
class mSupplier extends CI_Model{

  	function getData(){
    	$data=$this->db->get('tbl_m_supplier')->result();
		return $data;
  	}	
	function getRowData(){
    	return $this->db->get('tbl_m_supplier');
  	}	
  	//Menambahkan data (Cread)
  	function insertData($data){
		return $this->db->insert('tbl_m_supplier',$data);
	}

	//Untuk Menampilkan Data berdasarkan ID (Read)
  	function getDataById($id){
		$this->db->where('id_supp',$id);
		return $this->db->get('tbl_m_supplier')->row();
	}

  	//Update Data berdasarkan ID (Update)
	function updateData($id,$data){
		$this->db->where('id_supp',$id);
		return $this->db->update('tbl_m_supplier',$data);
	}
  
  	//Menghapus data berdasarkan ID (Delete)
	function deleteData($id){
		$this->db->where('id_supp',$id);
		return $this->db->delete('tbl_m_supplier');
	}

	//Validasi Data Duplikat
	function cekDuplicate($kategori) {
        $this->db->where('nama_supp',$kategori);
        $query = $this->db->get('tbl_m_supplier');
        return $query->num_rows();
    }
}