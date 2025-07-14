<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HalamanUtama extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('ModelAC', 'ac');
    }

    public function index()
    {
        $this->load->view('ac/halaman_utama');
    }

    public function info_ac()
    {
        $data['status_info'] = "";
        $this->load->View('ac/halaman_info_ac', $data);
    }

    public function valid_ac()
    {
        $data['status_validasi'] = "";
        $this->load->View('ac/halaman_validasi_ac', $data);
    }

    public function cari_ac()
    {
        $this->form_validation->set_rules('no_perkara', 'Nomor Perkara', 'trim|required|max_length[5]');
        $this->form_validation->set_rules('tahun', 'Tahun Perkara', 'trim|required|max_length[4]');

        $this->form_validation->set_message('required', '%s Tidak Boleh Kosong');
        $this->form_validation->set_message('max_length', '%s Tidak Boleh Melebihi %s Karakter');

        if ($this->form_validation->run() == FALSE) {
            //echo json_encode(array('st' => 0, 'msg' => 'Tidak Berhasil:<br/>'.validation_errors()));
            $this->session->set_flashdata('info', '2');
            $this->session->set_flashdata('pesan_peringatan', form_error('no_perkara') . ' ' . form_error('tahun'));
            redirect('info_ac', validation_errors());
            return;
        }

        $no_perkara = $this->input->post('no_perkara');
        $tahun = $this->input->post('tahun');

        $nomor_perkara = $no_perkara . '/Pdt.G/' . $tahun . '/MS.Bna';
        $queryPerkara = $this->ac->get_seleksi_perkara($nomor_perkara);
        //die(var_dump($queryAC->result_array()));
        if ($queryPerkara->num_rows() > 0) {
            $queryAC = $this->ac->get_seleksi_ac($nomor_perkara);
            if ($queryAC->num_rows() > 0) {
                $data['tgl_ambil_pihak1'] = $queryAC->row()->tgl_penyerahan_akta_cerai;
                $data['tgl_ambil_pihak2'] = $queryAC->row()->tgl_penyerahan_akta_cerai_pihak2;

                if ($queryAC->row()->doc_ac) {
                    # Akta Cerai Ditemukan
                    $data['status_info'] = "1";
                } else {
                    # Akta Cerai Belum Terbit
                    $data['status_info'] = "2";
                }
            } else {
                # Perkara selain Perceraian
                $data['status_info'] = "3";
            }

            $this->session->set_flashdata('nomor', $no_perkara);
            $this->session->set_flashdata('tahun', $tahun);
            $data['nomor_perkara'] = $nomor_perkara;
            $data['nama_pihak1'] = $this->tanggalhelper->sensorNama($queryPerkara->row()->pihak1_nama);
            $data['nama_pihak2'] = $this->tanggalhelper->sensorNama($queryPerkara->row()->pihak2_nama);
            $data['jenis_perkara'] = $queryPerkara->row()->jenis_perkara_text;

            $this->session->set_flashdata('info', '1');
            $this->session->set_flashdata('pesan_sukses', 'Nomor perkara ditemukan');

            $this->load->View('ac/halaman_info_ac', $data);
        } else {
            # Nomor Perkara Tidak Terdaftar
            $this->session->set_flashdata('info', '2');
            $this->session->set_flashdata('pesan_peringatan', 'Nomor perkara tidak terdaftar');
            redirect('info_ac');
        }
    }

    public function validasi_ac()
    {
        $this->form_validation->set_rules('no_perkara', 'Nomor Perkara', 'trim|required|max_length[5]');
        $this->form_validation->set_rules('tahun', 'Tahun Perkara', 'trim|required|max_length[4]');
        $this->form_validation->set_rules('no_ac', 'Nomor Akta Cerai', 'trim|required|max_length[5]');
        $this->form_validation->set_rules('tahun_ac', 'Tahun Akta Cerai', 'trim|required|max_length[4]');

        $this->form_validation->set_message('required', '%s Tidak Boleh Kosong');
        $this->form_validation->set_message('max_length', '%s Tidak Boleh Melebihi %s Karakter');

        if ($this->form_validation->run() == FALSE) {
            //echo json_encode(array('st' => 0, 'msg' => 'Tidak Berhasil:<br/>'.validation_errors()));
            $this->session->set_flashdata('info', '2');
            $this->session->set_flashdata('pesan_peringatan', form_error('no_perkara') . ' ' . form_error('tahun') . '' . form_error('no_ac') . ' ' . form_error('tahun_ac'));
            redirect('valid_ac', validation_errors());
            return;
        }

        $no_perkara = $this->input->post('no_perkara');
        $tahun = $this->input->post('tahun');
        $no_ac = $this->input->post('no_ac');
        $tahun_ac = $this->input->post('tahun_ac');

        $nomor_perkara = $no_perkara . '/Pdt.G/' . $tahun . '/MS.Bna';
        $nomor_ac = $no_ac . '/AC/' . $tahun_ac . '/MS.Bna';
        $queryAC = $this->ac->get_seleksi_validasi_ac($nomor_perkara, $nomor_ac);
        //die(var_dump($queryAC->result_array()));
        if ($queryAC->num_rows() > 0) {
            # Akta Cerai Ditemukan
            $data['status_validasi'] = "1";
            $this->session->set_flashdata('nomor', $no_perkara);
            $this->session->set_flashdata('tahun', $tahun);
            $data['nomor_perkara'] = $nomor_perkara;
            $data['nomor_ac'] = $nomor_ac;
            $data['nama_pihak1'] = $queryAC->row()->pihak1_nama;
            $data['nama_pihak2'] = $queryAC->row()->pihak2_nama;

            $this->session->set_flashdata('info', '1');
            $this->session->set_flashdata('pesan_sukses', 'Nomor perkara ditemukan');

            $this->load->View('ac/halaman_validasi_ac', $data);
        } else {
            # Nomor Perkara Tidak Terdaftar
            $this->session->set_flashdata('info', '2');
            $this->session->set_flashdata('pesan_peringatan', 'Akta Cerai Tidak Ditemukan');
            redirect('valid_ac');
        }
    }
}
