<?php

class Produk extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('mProduk');
        $this->load->model('mSatuan');
        $this->load->model('mKategori');
    }

    public function index() {
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

    public function tampilkanData() {
        $data = $this->mProduk->getData();
        echo json_encode($data);
    }

    public function tampilkanDataByI() {
        $id_produk = $this->input->post('id_produk');
        $data = $this->mKategori->getDataById($id_produk);
        echo json_encode($data);
    }
}