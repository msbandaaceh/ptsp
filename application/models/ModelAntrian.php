<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelAntrian extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db_antrian = $this->load->database('db_antrian', TRUE);
    }

    public function get_antrian_sidang($ruang)
    {
        $query = $this->db_antrian
            ->select('*')
            ->from('antrian')
            ->where('tanggal_sidang', date('Y-m-d'))
            ->where('ruangan_id', $ruang)
            ->get();
            
        return $query;
    }

    public function get_current_sidang($ruang)
    {
        $query = $this->db_antrian
            ->select('*')
            ->from('antrian')
            ->where('tanggal_sidang', date('Y-m-d'))
            ->where('ruangan_id', $ruang)
            ->where('disidang', $ruang)
            ->get();
            
        return $query;
    }
}