<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('generate_qrcode_base64')) {
    function generate_qrcode_base64($data, $level = 'H', $size = 2)
    {
        // Dapatkan instance CI
        $ci =& get_instance();

        // Load library ciqrcode jika belum diload
        if (!isset($ci->ciqrcode)) {
            $ci->load->library('ciqrcode');
        }

        // Konfigurasi QR code
        $config['cacheable']    = false; // Tidak perlu cache
        $config['cachedir']     = ''; // Tidak perlu direktori cache
        $config['errorlog']     = ''; // Tidak perlu log error
        $config['quality']      = false; // Kualitas tinggi
        $config['size']         = '256'; // Ukuran gambar
        $config['black']        = array(0, 0, 0); // Warna foreground (hitam)
        $config['white']        = array(255, 255, 255); // Warna background (putih)
        $ci->ciqrcode->initialize($config);

        // Set parameter QR code
        $params['data'] = $data;
        $params['level'] = $level;
        $params['size'] = $size;

        // Mulai output buffering
        ob_start();
        // Generate QR code dan output langsung ke buffer
        $ci->ciqrcode->generate($params);
        // Dapatkan isi buffer
        $image_string = ob_get_contents();
        // Akhiri buffering dan bersihkan
        ob_end_clean();

        // Encode gambar menjadi base64
        $base64 = base64_encode($image_string);

        return $base64;
    }
}
