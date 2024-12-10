<?php

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mProduk');
        $this->load->model('mSatuan');
        $this->load->model('mKategori');
    }

    public function index()
    {
        $data['page'] = "Barang";
        $data['judul'] = "Data Barang";
        $data['deskripsi'] = "Manage Data Barang";
        $data['kategori'] = $this->mKategori->getData();
        $data['satuan'] = $this->mSatuan->getData();
        $data['data'] = $this->mProduk->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('produk/view_produk', $data);
        $this->load->view('templates/footer');
    }

    public function tampilkanData()
    {
        $data = $this->mProduk->getData();
        echo json_encode($data);
    }

    public function tambahData()
    {
        $this->form_validation->set_rules('nama_produk', 'Nama Barang', 'trim|required');
        $this->form_validation->set_rules('id_kategori', 'Kategori Barang', 'required');
        $this->form_validation->set_rules('id_satuan', 'Satuan Barang', 'trim|required');
        $this->form_validation->set_rules('harga_beli', 'Harga Beli', 'required');
        $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required');
        $this->form_validation->set_rules('harga_pokok', 'Harga Pokok', 'required');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            log_message('error', 'Validation errors: ' . validation_errors());
            $response = array('response' => 'error', 'message' => validation_errors());
        } else {
            $nama_produk = $this->input->post('nama_produk');
            $valiData = $this->mProduk->cekDuplicate($nama_produk);
            if ($valiData >= 1) {
                $response = array('response' => 'error', 'message' => validation_errors());
            } else {
                $id_kategori = $this->input->post('id_kategori');
                $data = array(
                    'id_produk' => $this->mProduk->getKode($id_kategori),
                    'nama_produk' => $nama_produk,
                    'id_kategori' => $id_kategori,
                    'id_satuan' => $this->input->post('id_satuan'),
                    'barcode' => $this->input->post('barcode'),
                    'harga_beli' => $this->input->post('harga_beli'),
                    'harga_jual' => $this->input->post('harga_jual'),
                    'harga_pokok' => $this->input->post('harga_pokok'),
                );
                $data = $this->security->xss_clean($data);
                if ($this->mProduk->insertData($data)) {
                    $response = array('response' => 'success', 'message' => "Record added successfully");
                } else {
                    $response = array('response' => 'error', 'message' => 'Terjadi Kesalahan, Data gagal disimpan');
                }
            }
        }
        echo json_encode($response);
    }

    public function perbaruiData()
    {
        $this->form_validation->set_rules('nama_produk', 'Nama Barang', 'trim|required');
        $this->form_validation->set_rules('id_kategori', 'Kategori Barang', 'required');
        $this->form_validation->set_rules('id_satuan', 'Satuan Barang', 'trim|required');
        $this->form_validation->set_rules('harga_beli', 'Harga Beli', 'numeric');
        $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'numeric');
        $this->form_validation->set_rules('harga_pokok', 'Harga Pokok', 'numeric');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            $response = array('response' => 'error', 'message' => validation_errors());
        } else {
            $id_produk = $this->input->post('id_produk');
            $data = array(
                'nama_produk' => $this->input->post('nama_produk'),
                'id_kategori' => $this->input->post('id_kategori'),
                'id_satuan' => $this->input->post('id_satuan'),
                'barcode' => $this->input->post('barcode'),
                'harga_beli' => $this->input->post('harga_beli'),
                'harga_jual' => $this->input->post('harga_jual'),
                'harga_pokok' => $this->input->post('harga_pokok'),
            );
            $data = $this->security->xss_clean($data);
            if ($post = $this->mProduk->updateData($id_produk, $data)) {
                $response = array('response' => 'success', 'message' => "Record updated successfully");
            } else {
                $response = array('response' => 'error', 'message' => 'Terjadi Kesalahan, Data gagal disimpan');
            }
        }

        echo json_encode($response);
    }

    public function tampilkanDataById()
    {
        $id_produk = $this->input->post('id_produk');
        $data = $this->mProduk->getDataById($id_produk);
        echo json_encode($data);
    }

    public function hapusData()
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id_produk');
            if ($this->mProduk->deleteData($id)) {
                $data = array('response' => 'success');
            } else {
                $data = array('response' => 'error');
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }
}