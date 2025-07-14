<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HalamanUtama extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('ModelPanjar', 'panjar');
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

    public function login_admin()
    {
        $this->load->view('panjar/halaman_login');
    }

    public function cari_panjar()
    {
        $this->form_validation->set_rules('no_perkara', 'Nomor Perkara', 'trim|required|max_length[5]');
        $this->form_validation->set_rules('tahun', 'Tahun Perkara', 'trim|required|max_length[4]');

        $this->form_validation->set_message('required', '%s Tidak Boleh Kosong');
        $this->form_validation->set_message('max_length', '%s Tidak Boleh Melebihi %s Karakter');

        if ($this->form_validation->run() == FALSE) {
            //echo json_encode(array('st' => 0, 'msg' => 'Tidak Berhasil:<br/>'.validation_errors()));
            $this->session->set_flashdata('info', '2');
            $this->session->set_flashdata('pesan_peringatan', form_error('no_perkara') . ' ' . form_error('tahun'));
            redirect('info_panjar', validation_errors());
            return;
        }

        $no_perkara = $this->input->post('no_perkara');
        $tahun = $this->input->post('tahun');
        $jenis = $this->input->post('jenis');

        if ($jenis == 'G') {
            $nomor_perkara = $no_perkara . '/Pdt.G/' . $tahun . '/MS.Bna';
        } else {
            $nomor_perkara = $no_perkara . '/Pdt.P/' . $tahun . '/MS.Bna';
        }
        $queryPerkara = $this->panjar->get_seleksi_perkara($nomor_perkara);
        //die(var_dump($queryAC->result_array()));
        if ($queryPerkara->num_rows() > 0) {
            $data['biaya_perkara'] = $this->panjar->get_seleksi_panjar($nomor_perkara);
            $data['status_info'] = '1';

            //die(var_dump($queryPanjar));

            $this->session->set_flashdata('nomor', $no_perkara);
            $this->session->set_flashdata('tahun', $tahun);
            $data['nomor_perkara'] = $nomor_perkara;
            #$data['nama_pihak1'] = $this->tanggalhelper->sensorNama($queryPerkara->row()->pihak1_nama);
            #$data['nama_pihak2'] = $this->tanggalhelper->sensorNama($queryPerkara->row()->pihak2_nama);
            $data['id_perkara'] = $queryPerkara->row()->perkara_id;
            $data['jenis_perkara'] = $queryPerkara->row()->jenis_perkara_text;

            $this->session->set_flashdata('info', '1');
            $this->session->set_flashdata('pesan_sukses', 'Nomor perkara ditemukan');

            $this->load->View('panjar/halaman_info_panjar', $data);
        } else {
            # Nomor Perkara Tidak Terdaftar
            $this->session->set_flashdata('info', '2');
            $this->session->set_flashdata('pesan_peringatan', 'Nomor perkara tidak terdaftar');
            redirect('info_panjar');
        }
    }

    public function simpan_req_panjar()
	{
		$this->form_validation->set_rules('no_perkara', 'Nomor Perkara', 'trim|required');
		$this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'trim|required');
		$this->form_validation->set_rules('nama_rek', 'Nama di Rekening', 'trim|required');
		$this->form_validation->set_rules('nohp', 'Nomor Handphone', 'trim|required');

		$this->form_validation->set_message('required', '%s Tidak Boleh Kosong');

		if ($this->form_validation->run() == FALSE) {
			//echo json_encode(array('st' => 0, 'msg' => 'Tidak Berhasil:<br/>'.validation_errors()));
			$this->session->set_flashdata('info', '3');
			$this->session->set_flashdata('pesan_gagal', form_error('no_perkara') . form_error('no_rek') . form_error('nama_rek') . form_error('nohp'));
			redirect('cari_panjar', validation_errors());
			return;
		}

		$id = $this->input->post('id');
		$no_rek = $this->input->post('no_rek');
		$nama_rek = $this->input->post('nama_rek');
		$hp = $this->input->post('nohp');

		$dataPemohon = array(
			'id_perkara' => $id,
			'norek' => $no_rek,
			'namarek' => $nama_rek,
			'nohp' => $hp,
			'created_on' => date('Y-m-d H:i:s')
		);

		$querySimpan = $this->panjar->simpan_data('data_e_panjar', $dataPemohon);


		if ($querySimpan == 1) {
            $queryPetugas = $this->panjar->get_seleksi_petugas('3');
            if ($queryPetugas->num_rows() > 0) {
                $nama = $queryPetugas->row()->fullname;
                $nohp = $queryPetugas->row()->nohp;
                
            } else {
                $querySupervisor = $this->panjar->get_seleksi_petugas('1');
                $nama = $querySupervisor->row()->fullname;
                $nohp = $querySupervisor->row()->nohp;
            }

            $pesan = "Yth. *".$nama."*, Ada Permohonan E-Panjar Baru, silakan ditindaklanjuti";

            $dataNotif = array(
                'jenis_pesan' => 'panjar',
                'pesan' => $pesan,
                'nohp' => $nohp,
                'dibuat' => date('Y-m-d H:i:s')
            );
    
            $this->panjar->simpan_data('sys_notif', $dataNotif);

			$this->session->set_flashdata('info', '1');
			$this->session->set_flashdata('pesan_sukses', 'Permohonan E-Panjar Berhasil di Ajukan');
			redirect('info_panjar');
		} else {
			$this->session->set_flashdata('info', '3');
			$this->session->set_flashdata('pesan_gagal', 'Gagal Simpan, ' . $querySimpan);
			redirect('info_panjar');
		}
	}

    public function keluar()
    {
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('panjar_login');
    }
}
