<?php

class Api extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('ModelApi', 'api');
        $this->load->model('ModelNotifikasi', 'notif');

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Content-Type: application/json');
    }

    public function simpan_data()
    {
        header('Content-Type: application/json');

        $input = json_decode(trim(file_get_contents("php://input")), true);

        // Validasi input minimal
        if (!isset($input['tabel'], $input['data'])) {
            http_response_code(400);
            echo json_encode(['status' => false, 'message' => $input]);
            return;
        }

        $tabel = $input['tabel'];
        $data = $input['data'];
        $api = $input['apine'];

        if ($api <> 'M4hk4m4hBn4@2025') {
            http_response_code(500);
            echo json_encode(['status' => false, 'message' => 'Error: Tidak diizinkan akses']);
        } else {
            try {
                $query = $this->api->simpan_data($tabel, $data);

                if ($query) {
                    echo json_encode(['status' => true, 'message' => 'Simpan Data Berhasil']);
                } else {
                    http_response_code(500);
                    echo json_encode(['status' => false, 'message' => 'Gagal Simpan Data']);
                }

            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['status' => false, 'message' => 'Error: ' . $e->getMessage()]);
            }
        }
    }
}