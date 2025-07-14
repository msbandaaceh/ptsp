<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HalamanUtama extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('ModelProduk', 'produk');
    }

    public function index()
    {
        $this->load->view('panjar/halaman_utama');
    }

    public function info_panjar()
    {
        $data['status_info'] = "";
        $this->load->View('panjar/halaman_info_panjar', $data);
    }

}
