<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HalamanUtama extends CI_Controller
{
    private $security_headers = [
        'X-Content-Type-Options: nosniff',
        'X-Frame-Options: DENY',
        'Content-Security-Policy: default-src \'self\'',
        'Strict-Transport-Security: max-age=31536000; includeSubDomains'
    ];

    function __construct()
    {
        parent::__construct();
        $this->load->model('ModelAntrian', 'antrian');
        $this->load->helper('security');

        // Set security headers for all responses
        foreach ($this->security_headers as $header) {
            $this->output->set_header($header);
        }
    }

    public function index()
    {
        $this->load->view('antrian/halaman_utama');
    }

    /**
     * Generic method to handle all courtroom data
     * @param int $room_number
     * @return array
     */
    private function get_room_data($room_number)
    {
        $default_response = [
            'klas' => '0',
            'nomor' => "TIDAK ADA SIDANG",
            'no_perkara' => null
        ];

        $idAntrian = $this->antrian->get_antrian_sidang($room_number);
        if ($idAntrian->num_rows() <= 0) {
            return $default_response;
        }

        $idAntri = $this->antrian->get_current_sidang($room_number);
        if ($idAntri->num_rows() <= 0) {
            return [
                'klas' => '2',
                'nomor' => "MAHKAMAH SYAR'IYAH BANDA ACEH",
                'no_perkara' => null
            ];
        }

        // Sanitize all output data
        return [
            'klas' => '1',
            'nomor' => html_escape($idAntri->row()->no_struk),
            'no_perkara' => html_escape($idAntri->row()->nomor_perkara)
        ];
    }

    /**
     * Secure JSON response helper
     * @param array $data
     */
    private function secure_json_response($data)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));
    }

    public function ruang_sidang_1()
    {
        $this->secure_json_response($this->get_room_data(1));
    }

    public function ruang_sidang_2()
    {
        $this->secure_json_response($this->get_room_data(2));
    }

    public function ruang_sidang_3()
    {
        $this->secure_json_response($this->get_room_data(3));
    }
}