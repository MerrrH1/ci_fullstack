<?php 

class Satuan extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model("mSatuan");
    }

    public function index() {
        $data['judul'] = "Satuan";
        $data['data'] = $this->mSatuan->getData();
        $this->load->view("templates/header", $data);
        $this->load->view("satuan/view_satuan", $data);
        $this->load->view("templates/footer");
    }

    public function tampilkanData() {
        $data = $this->mSatuan->getData();
        echo json_encode($data);
    }
}
?>