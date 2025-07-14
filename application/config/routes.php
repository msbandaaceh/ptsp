<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'LandingPage';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

# Route Informasi Akta Cerai
$route['ac'] = 'ac/HalamanUtama';
$route['info_ac'] = 'ac/HalamanUtama/info_ac';
$route['valid_ac'] = 'ac/HalamanUtama/valid_ac';
$route['cari_ac'] = 'ac/HalamanUtama/cari_ac';
$route['validasi_ac'] = 'ac/HalamanUtama/validasi_ac';

# Route Pengembalian Sisa Panjar Elektronik
$route['panjar'] = 'panjar/HalamanUtama';
$route['info_panjar'] = 'panjar/HalamanUtama/info_panjar';
$route['cari_panjar'] = 'panjar/HalamanUtama/cari_panjar';
$route['simpan_req_panjar'] = 'panjar/HalamanUtama/simpan_req_panjar';

# Route Permohonan Pengguna Ecourt
$route['ecourt'] = 'ecourt/HalamanUtama';
$route['req_ecourt'] = 'ecourt/HalamanUtama/req_ecourt';
$route['simpan_ecourt'] = 'ecourt/HalamanUtama/simpan_ecourt';

# Route Permintaan Pengambilan Produk
$route['produk'] = 'produk/HalamanUtama';

# Route Antrian Sidang
$route['antrian'] = 'antrian_sidang/HalamanUtama';
$route['ruang_sidang1'] = 'antrian_sidang/HalamanUtama/ruang_sidang_1';
$route['ruang_sidang2'] = 'antrian_sidang/HalamanUtama/ruang_sidang_2';
$route['ruang_sidang3'] = 'antrian_sidang/HalamanUtama/ruang_sidang_3';

# Route Admin
$route['login'] = 'admin/HalamanLogin';
$route['validasi'] = 'admin/HalamanLogin/validasi';
$route['admin'] = 'admin/HalamanDashboard';
$route['keluar'] = 'admin/HalamanLogin/keluar';

# Manajemen Pengguna
$route['manage_users'] = 'admin/HalamanDashboard/manage_users';
$route['modal_users'] = 'admin/HalamanDashboard/modal_users';
$route['simpan_user'] = 'admin/HalamanDashboard/simpan_user';
$route['hapus_user'] = 'admin/HalamanDashboard/hapus_user';

# Permohonan E-Panjar
$route['val_psp'] = 'admin/HalamanDashboard/e_panjar';
$route['modal_panjar'] = 'admin/HalamanDashboard/modal_panjar';
$route['proses_panjar'] = 'admin/HalamanDashboard/proses_panjar';

# Permohonan E-Court
$route['val_ecourt'] = 'admin/HalamanDashboard/e_court';
$route['modal_ecourt'] = 'admin/HalamanDashboard/modal_ecourt';
$route['proses_ecourt'] = 'admin/HalamanDashboard/proses_ecourt';