<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Supplier extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mSupplier');
	}

	function index()
	{
		$data['page'] = "Supplier ";
		$data['judul'] = "Data Supplier";
		$data['deskripsi'] = "Manage Data Supplier";
		$this->load->view('templates/header', $data);
		$this->load->view('supplier/view_supplier', $data);
		$this->load->view('templates/footer', $data);
	}

	function tampilkanData()
	{
		$data = $this->mSupplier->getData();
		echo json_encode($data);
	}

	function tambahData()
	{
		$this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'trim|required');
		$this->form_validation->set_rules('jenis', 'jenis Perusahaan', 'required');
		$this->form_validation->set_rules('kontak_person', 'Kontak Person', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
		$this->form_validation->set_rules('no_kontak', 'Nomor Kontak', 'numeric');
		$this->form_validation->set_rules('no_telp', 'Nomor Telp', 'numeric');
		$this->form_validation->set_rules('no_fax', 'Nomor Fax', 'numeric');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == FALSE) {
			$response = array('responce' => 'error', 'message' => validation_errors());
		} else {
			$nama_supplier = $this->input->post('nama_supplier');
			$validData = $this->mSupplier->cekDuplicate($nama_supplier);
			if ($validData >= 1) {
				$response = array('responce' => 'error', 'message' => 'Nama Supplier Barang Sudah Terdaftar..');
			} else {
				$data = array(
					'nama_supplier' => $nama_supplier,
					'jenis' => $this->input->post('jenis'),
					'kontak_person' => $this->input->post('kontak_person'),
					'no_kontak' => $this->input->post('no_kontak'),
					'kota' => $this->input->post('kota'),
					'email' => $this->input->post('email'),
					'no_telp' => $this->input->post('no_telp'),
					'no_fax' => $this->input->post('no_fax'),
					'alamat' => $this->input->post('alamat')
				);
				$data = $this->security->xss_clean($data);
				if ($this->mSupplier->insertData($data)) {
					$response = array('responce' => 'success', 'message' => 'Record added Successfully');
				} else {
					$response = array('responce' => 'error', 'message' => 'Terjadi Kesalahan, Data GAGAL di Simpan');
				}
			}
		}
		echo json_encode($response);
	}

	function perbaruiData()
	{
		$this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'required');
		$this->form_validation->set_rules('jenis', 'jenis Perusahaan', 'required');
		$this->form_validation->set_rules('kontak_person', 'Kontak Person', 'required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('no_kontak', 'Nomor Kontak', 'numeric');
		$this->form_validation->set_rules('no_telp', 'Nomor Telp', 'numeric');
		$this->form_validation->set_rules('no_fax', 'Nomor Fax', 'numeric');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == FALSE) {
			$response = array('responce' => 'error', 'message' => validation_errors());
		} else {
			$id_supplier = $this->input->post('id_supplier');
			$data = array(
				'nama_supplier' => $this->input->post('nama_supplier'),
				'jenis' => $this->input->post('jenis'),
				'kontak_person' => $this->input->post('kontak_person'),
				'no_kontak' => $this->input->post('no_kontak'),
				'kota' => $this->input->post('kota'),
				'email' => $this->input->post('email'),
				'no_telp' => $this->input->post('no_telp'),
				'no_fax' => $this->input->post('no_fax'),
				'alamat' => $this->input->post('alamat')
			);
			$data = $this->security->xss_clean($data);
			if ($post = $this->mSupplier->updateData($id_supplier, $data)) {
				$response = array('responce' => 'success', 'message' => 'Record update Successfully');
			} else {
				$response = array('responce' => 'error', 'message' => 'Terjadi Kesalahan, Data GAGAL di Simpan');
			}
		}
		echo json_encode($response);
	}

	function tampilkanDataByID()
	{
		$id_supplier = $this->input->post('id_supplier');
		$data = $this->mSupplier->getDataById($id_supplier);
		echo json_encode($data);
	}

	function hapusData()
	{
		if ($this->input->is_ajax_request()) {
			$id = $this->input->post('id_supplier');
			if ($this->mSupplier->deleteData($id)) {
				$data = array('responce' => 'success');
			} else {
				$data = array('responce' => 'error');
			}
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

}