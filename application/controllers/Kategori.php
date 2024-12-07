<?php

class Kategori extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("mKategori");
    }

    public function index() {
        $data['judul'] = "Kategori";
        $this->load->view("templates/header", $data);
        $this->load->view("kategori/view_kategori", $data);
        $this->load->view("templates/footer");
    }

    public function getData() {
        $data = $this->mKategori->getData();
        echo json_encode($data);
    }
}