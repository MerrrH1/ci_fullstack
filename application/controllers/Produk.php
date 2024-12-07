<?php

class Produk extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('mProduk');
    }

    public function index() {
        $data['judul'] = "Produk";
        $data['data'] = $this->mProduk->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('produk/view_produk', $data);
        $this->load->view('templates/footer');
    }
}