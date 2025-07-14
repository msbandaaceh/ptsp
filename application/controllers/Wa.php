<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wa extends CI_Controller
{
    public function notifikasi()
    {
        $this->load->model('ModelNotifikasi', 'notif');
        $apine = $this->input->get('kuncine');
        if ($apine <> 'W3dhu56emBeL') {
            echo json_encode(array("hasill" => "ANDA TIDAK BERHAK AKSES !!!!"));
        } else {
            $pesan = $this->notif->notif();
            if ($pesan <> 0) {
                echo json_encode(array("hasil" => $pesan));
            } else {
                echo json_encode(array("hasil" => 0));
            }
        }
    }

    public function update_data()
    {
        $this->load->model('ModelNotifikasi', 'notif');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $tabel = $this->input->post('tabel');
        $apine = $this->input->post('kuncine');
        if ($apine <> 'W3dhu56emBeL') {
            echo json_encode(array("hasill" => "ANDA TIDAK BERHAK AKSES !!!!"));
        } else {
            $pesan = $this->notif->update_data($id, $status, $tabel);
            echo json_encode(array("hasil" => $pesan));
        }
    }
}