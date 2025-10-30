<?php

class ModelApi extends CI_Model
{
    public function simpan_data($tabel, $data)
    {
        return $this->db->insert($tabel, $data);
    }
}