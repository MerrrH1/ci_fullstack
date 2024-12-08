<?php

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("mKategori");
    }

    public function index()
    {
        $data['judul'] = "Kategori";
        $this->load->view("templates/header", $data);
        $this->load->view("kategori/view_kategori", $data);
        $this->load->view("templates/footer");
    }

    public function tampilkanData()
    {
        $data = $this->mKategori->getData();
        echo json_encode($data);
    }

    public function tambahData()
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|is_unique[tbl_m_kategori.nama_kategori]');

        if ($this->form_validation->run() == FALSE) {
            $response = array('response' => 'error', 'message' => validation_errors());
        } else {
            $nama_kategori = $this->input->post('nama_kategori');

            try {
                $data = ['nama_kategori' => $nama_kategori];
                if ($this->mKategori->insertData($data)) {
                    $response = array('response' => 'success', 'message' => 'Kategori berhasil ditambahkan');
                } else {
                    $response = array('response' => 'error', 'message' => 'Terjadi kesalahan saat menambahkan kategori');
                }
            } catch (Exception $e) {
                $response = array('response' => 'error', 'message' => 'Terjadi kesalahan database: ' . $e->getMessage());
            }
        }

        echo json_encode($response);
    }

    // public function perbaruiData()
    // {
    //     $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');
    //     $this->form_validation->set_rules('id_kategori', 'ID Kategori', 'required');
    //     if ($this->form_validation->run() == FALSE) {
    //         $response = array('response' => 'error', 'message' => validation_errors());
    //     } else {
    //         $nama_kategori = $this->input->post('nama_kategori');
    //         $id_kategori = $this->input->post('id_kategori');
    //         $validData = $this->mKategori->cekDuplicate($nama_kategori);
    //         if ($validData >= 1) {
    //             $response = array('response' => 'error', 'message' => "Nama Kategori Barang sudah Terdaftar...");
    //         } else {
    //             $data = ['nama_kategori' => $nama_kategori];
    //             if ($this->mKategori->updateData($id_kategori, $data)) {
    //                 $response = array('response' => 'success', 'message' => "Record Update Successfully");
    //             } else {
    //                 $response = array('response' => 'error', 'message' => "Terjadi Kesalahan, Data GAGAL Disimpan");
    //             }
    //         }
    //     }
    //     echo json_encode($response);
    // }

    public function tampilkanDataById()
    {
        $id_kategori = $this->input->post('id_kategori');
        $data = $this->mKategori->getDataById($id_kategori);
        echo json_encode($data);
    }

    public function hapusData()
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id_kategori');
            if ($this->mKategori->deleteData($id)) {
                $data = array('response' => 'success');
            } else {
                $data = array('response' => 'success');
            }
            echo json_encode($data);
        } else {
            echo 'No direct script access allowed';
        }
    }
}