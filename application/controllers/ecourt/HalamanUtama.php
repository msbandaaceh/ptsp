<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HalamanUtama extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('ModelEcourt', 'ecourt');
    }

    public function index()
    {
        $this->load->view('ecourt/halaman_utama');
    }

    public function req_ecourt()
    {
        $this->load->View('ecourt/halaman_req_ecourt');
    }

    public function simpan_ecourt()
    {
        $response = $this->input->post('g-recaptcha-response');
        $secret = $this->config->item('g_secret');

        $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response");
        $responseData = json_decode($verify);

        if ($responseData->success) {
            // Lolos reCAPTCHA
            $jenisPihak = $this->input->post('jenisPihak');

            if ($jenisPihak == '1') {
                $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
                $this->form_validation->set_rules('ni', 'NIK', 'trim|required');
                $this->form_validation->set_rules('tmptLahir', 'Tempat Lahir', 'trim|required');
                $this->form_validation->set_rules('tglLahir', 'Tanggal Lahir', 'trim|required');
                $this->form_validation->set_rules('jenisKelamin', 'Jenis Kelamin', 'trim|required');
                $this->form_validation->set_rules('agama', 'Agama', 'trim|required');
                $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
                $this->form_validation->set_rules('kawin', 'Status Perkawinan', 'trim|required');
                $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required');
                $this->form_validation->set_rules('bank', 'Bank', 'trim|required');
                $this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'trim|required');
                $this->form_validation->set_rules('nama_rek', 'Nama Pemilik Rekening', 'trim|required');
                $this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'trim|required');
                $this->form_validation->set_rules('email', 'Alamat Email', 'trim|required');
                $this->form_validation->set_rules('difabel', 'Status Berkebutuhan Khusus', 'trim|required');
                $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'trim|required');

                $this->form_validation->set_message('required', '%s Tidak Boleh Kosong');

                if ($this->form_validation->run() == FALSE) {
                    //echo json_encode(array('st' => 0, 'msg' => 'Tidak Berhasil:<br/>'.validation_errors()));
                    $input_fields = [
                        'nama',
                        'ni',
                        'tmptLahir',
                        'tglLahir',
                        'jenisKelamin',
                        'agama',
                        'alamat',
                        'kawin',
                        'pekerjaan',
                        'bank',
                        'no_rek',
                        'nama_rek',
                        'no_hp',
                        'email',
                        'difabel',
                        'pendidikan'
                    ];

                    // Inisialisasi variabel untuk menyimpan pesan error
                    $error_messages = '';

                    // Loop melalui setiap input dan tambahkan pesan error jika ada
                    foreach ($input_fields as $field) {
                        $error_messages .= form_error($field);
                    }

                    $this->session->set_flashdata('info', '3');
                    $this->session->set_flashdata('pesan_gagal', $error_messages);
                    redirect('req_ecourt', validation_errors());
                    return;
                }

                if (!empty($_FILES['dokumen']['name'])) {
                    $max_size = 5000 * 1024; // 5MB in bytes
                    if ($_FILES['dokumen']['size'] > $max_size) {
                        $this->session->set_flashdata('info', '3');
                        $this->session->set_flashdata('pesan_gagal', 'Gagal simpan Permohonan, file KTP terlalu besar (Maksimal 5MB)');
                        redirect('req_ecourt');
                    } elseif (!in_array($_FILES['dokumen']['type'], ['application/pdf', 'image/jpeg', 'image/png'])) {
                        $this->session->set_flashdata('info', '3');
                        $this->session->set_flashdata('pesan_gagal', 'Gagal simpan Permohonan, file KTP harus pdf, jpg, atau png');
                        redirect('req_ecourt');
                    } else {
                        $doc = time() . '-' . $_FILES["dokumen"]['name'];
                        $config = array(
                            'upload_path' => './assets/dokumen/ecourt/',
                            'allowed_types' => "pdf|jpg|png",
                            'file_ext_tolower' => TRUE,
                            'file_name' => $doc,
                            'overwrite' => TRUE,
                            'remove_spaces' => TRUE,
                            'max_size' => "5000" // 5000 KB = 5MB
                        );

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if (!$this->upload->do_upload('dokumen')) {
                            $error = $this->upload->display_errors();
                            $this->session->set_flashdata('info', '3');
                            $this->session->set_flashdata('pesan_gagal', 'Gagal upload file: ' . $error);
                            redirect('req_ecourt');
                        } else {
                            $upload_data = $this->upload->data();
                            // Lanjutkan dengan proses penyimpanan data atau lainnya
                        }
                    }
                } else {
                    $this->session->set_flashdata('info', '3');
                    $this->session->set_flashdata('pesan_gagal', 'Gagal simpan Permohonan, file KTP tidak boleh kosong');
                    redirect('req_ecourt');
                }

                $jenisPihak = $this->input->post('jenisPihak');
                $nama = $this->input->post('nama');
                $nik = $this->input->post('ni');
                $tmptLahir = $this->input->post('tmptLahir');
                $tglLahir = $this->input->post('tglLahir');
                $jenisKelamin = $this->input->post('jenisKelamin');
                $agama = $this->input->post('agama');
                $alamat = $this->input->post('alamat');
                $kawin = $this->input->post('kawin');
                $pekerjaan = $this->input->post('pekerjaan');
                $bank = $this->input->post('bank');
                $no_rek = $this->input->post('no_rek');
                $nama_rek = $this->input->post('nama_rek');
                $telp = $this->input->post('no_telp');
                $no_hp = $this->input->post('no_hp');
                $email = $this->input->post('email');
                $difabel = $this->input->post('difabel');
                $pendidikan = $this->input->post('pendidikan');

                $dataPemohon = array(
                    'jenisPihak' => $jenisPihak,
                    'nama' => $nama,
                    'no_induk' => $nik,
                    'tmp_lahir' => $tmptLahir,
                    'tgl_lahir' => $tglLahir,
                    'jk' => $jenisKelamin,
                    'alamat' => $alamat,
                    'agama' => $agama,
                    'kawin' => $kawin,
                    'pekerjaan' => $pekerjaan,
                    'bank' => $bank,
                    'no_rek' => $no_rek,
                    'nama_rek' => $nama_rek,
                    'telp' => $telp,
                    'nohp' => $no_hp,
                    'email' => $email,
                    'difabel' => $difabel,
                    'pendidikan' => $pendidikan,
                    'dokumen_1' => (!empty($upload_data['file_name']) ? $upload_data['file_name'] : NULL),
                    'dibuat' => date('Y-m-d H:i:s')
                );
            }

            $querySimpan = $this->ecourt->simpan_data('data_ecourt', $dataPemohon);

            if ($querySimpan == 1) {
                $queryPetugas = $this->ecourt->get_seleksi_petugas('4');
                if ($queryPetugas->num_rows() > 0) {
                    $nama = $queryPetugas->row()->fullname;
                    $nohp = $queryPetugas->row()->nohp;

                } else {
                    $querySupervisor = $this->ecourt->get_seleksi_petugas('1');
                    $nama = $querySupervisor->row()->fullname;
                    $nohp = $querySupervisor->row()->nohp;
                }

                $pesan = "Yth. *" . $nama . "*, Ada Permohonan Pengguna E-Court Baru, silakan ditindaklanjuti";

                $dataNotif = array(
                    'jenis_pesan' => 'ecourt',
                    'pesan' => $pesan,
                    'nohp' => $nohp,
                    'dibuat' => date('Y-m-d H:i:s')
                );

                $this->ecourt->simpan_data('sys_notif', $dataNotif);

                $this->session->set_flashdata('info', '1');
                $this->session->set_flashdata('pesan_sukses', 'Permohonan Pendaftaran Pengguna E-Court Berhasil di Ajukan');
                redirect('req_ecourt');
            } else {
                $this->session->set_flashdata('info', '3');
                $this->session->set_flashdata('pesan_gagal', 'Gagal Simpan, ' . $querySimpan);
                redirect('req_ecourt');
            }
        } else {
            // Gagal reCAPTCHA
            $this->session->set_flashdata('info', '3');
            $this->session->set_flashdata('pesan_gagal', 'Gagal Simpan, CAPCTHA salah');
            redirect('req_ecourt');
        }
    }
}
