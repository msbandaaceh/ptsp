<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HalamanDashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status_login') == FALSE) {
			redirect('keluar');
		}

		$this->load->model('ModelAdmin', 'admin');
	}

	private function arr2md5($arrinput)
	{
		$hasil = '';
		foreach ($arrinput as $val) {
			if ($hasil == '') {
				$hasil = md5($val);
			} else {
				$code = md5($val);
				for ($hit = 0; $hit < min(array(strlen($code), strlen($hasil))); $hit++) {
					$hasil[$hit] = chr(ord($hasil[$hit]) ^ ord($code[$hit]));
				}
			}
		}
		return (md5($hasil));
	}

	public function index()
	{
		//$data['countProduk'] = count($this->admin->all_produk_data());
		$countPanjar = count($this->admin->all_panjar_data());
		$countEcourt = count($this->admin->all_ecourt_data());

		$panjarDone = count($this->admin->all_panjar_done());
		$ecourtDone = count($this->admin->all_ecourt_done());

		$data['countPanjar'] = $countPanjar;
		$data['countEcourt'] = $countEcourt;
		if ($countPanjar > 0) {
			$data['progresPanjar'] = round($panjarDone / $countPanjar * 100, 2);
		} else {
			$data['progresPanjar'] = 100;
		}

		if ($countEcourt > 0) {
			$data['progresEcourt'] = round($ecourtDone / $countEcourt * 100, 2);
		} else {
			$data['progresEcour'] = 100;
		}

		$this->load->view('admin/header');
		$this->load->view('admin/beranda', $data);
	}

	##########################################
	#										 #
	#	 SEMUA FUNGSI PRODUK PENGADILAN		 #
	#										 #
	##########################################

	##########################################
	#										 #
	#	 	  SEMUA FUNGSI E-PANJAR			 #
	#										 #
	##########################################

	public function e_panjar()
	{
		$data['allPanjar'] = count($this->admin->all_panjar_data());
		$data['panjarDone'] = count($this->admin->all_panjar_done());
		$data['panjarWait'] = count($this->admin->all_panjar_wait());
		$data['panjar'] = $this->admin->all_panjar_data();
		$this->load->view('admin/header');
		$this->load->view('admin/e_panjar', $data);
	}

	public function modal_panjar()
	{
		$id = $this->encrypt->decode(base64_decode($this->input->post('id')));
		$jenis = $this->input->post('jenis');

		$status = array('' => "Pilih Status", '1' => 'Diproses', '2' => 'Tidak Diproses');

		$judul = "PROSES PERMOHONAN";
		$query = $this->admin->get_seleksi('v_e_panjar', 'id', $id);
		$no_perkara = $query->row()->nomor_perkara;
		$nama_pihak = $query->row()->pihak_p;
		$no_rek = $query->row()->norek;
		$nama_rek = $query->row()->namarek;

		if ($jenis == 1) {
			$stat = form_dropdown('status', $status, '', 'class="form-control" onChange="statusProses()" id="status"');

			echo json_encode(
				array(
					'st' => 1,
					'id' => $id,
					'judul' => $judul,
					'no_perkara' => $no_perkara,
					'nama_pihak' => $nama_pihak,
					'no_rek' => $no_rek,
					'nama_rek' => $nama_rek,
					'status' => $stat
				)
			);
		} else {
			$stat_ = $query->row()->status;
			$nominal = $query->row()->nominal;
			$tgl_trans = $query->row()->tgl_trans;
			$no_trans = $query->row()->no_trans;
			$ket = $query->row()->ket;
			$stat = form_dropdown('status', $status, $stat_, 'class="form-control" onChange="statusProses()" disabled id="status"');
			echo json_encode(
				array(
					'st' => 1,
					'id' => $id,
					'judul' => $judul,
					'no_perkara' => $no_perkara,
					'nama_pihak' => $nama_pihak,
					'no_rek' => $no_rek,
					'nama_rek' => $nama_rek,
					'status' => $stat,
					'nominal' => $nominal,
					'tgl_trans' => $tgl_trans,
					'no_trans' => $no_trans,
					'ket' => $ket
				)
			);
		}

		return;
	}

	public function proses_panjar()
	{
		$jenis_proses = $this->input->post('jenis');
		$id = $this->input->post('id');
		$notif = $this->input->post('notif');

		if ($jenis_proses == '2') {
			$this->form_validation->set_rules('ket', 'Keterangan', 'trim|required');
			$this->form_validation->set_message('required', '%s Tidak Boleh Kosong');

			if ($this->form_validation->run() == FALSE) {
				//echo json_encode(array('st' => 0, 'msg' => 'Tidak Berhasil:<br/>'.validation_errors()));
				$this->session->set_flashdata('info', '3');
				$this->session->set_flashdata('pesan_gagal', form_error('ket'));
				redirect('val_psp', validation_errors());
				return;
			}

			$ket = $this->input->post('ket');

			$dataValidasi = array(
				'status' => $jenis_proses,
				'ket' => $ket,
				'modified_on' => date('Y-m-d H:i:s')
			);
		} elseif ($jenis_proses == '1') {
			$this->form_validation->set_rules('tgl', 'Keterangan', 'trim|required');
			$this->form_validation->set_rules('nominal_tf', 'Keterangan', 'trim|required');
			$this->form_validation->set_rules('nomor_tf', 'Keterangan', 'trim|required');

			$this->form_validation->set_message('required', '%s Tidak Boleh Kosong');

			if ($this->form_validation->run() == FALSE) {
				//echo json_encode(array('st' => 0, 'msg' => 'Tidak Berhasil:<br/>'.validation_errors()));
				$this->session->set_flashdata('info', '3');
				$this->session->set_flashdata('pesan_gagal', form_error('tgl') . form_error('nominal_tf') . form_error('nomor_tf'));
				redirect('val_psp', validation_errors());
				return;
			}

			$ket = $this->input->post('ket_proses');
			$tgl = $this->input->post('tgl');
			$nominal_tf = $this->input->post('nominal_tf');
			$nominal = $this->input->post('nominal');
			$nomor = $this->input->post('nomor_tf');

			$dataValidasi = array(
				'status' => $jenis_proses,
				'tgl_trans' => $tgl,
				'no_trans' => $nomor,
				'nominal' => $nominal_tf,
				'ket' => $ket,
				'modified_on' => date('Y-m-d H:i:s')
			);
		}

		$queryUpdate = $this->admin->pembaharuan_data('data_e_panjar', $dataValidasi, 'id', $id);

		if ($queryUpdate == 1) {
			$queryPemohon = $this->admin->get_seleksi('v_e_panjar', 'id', $id);
			$nohp = $queryPemohon->row()->nohp;
			$nama = $queryPemohon->row()->namarek;
			$no_perkara = $queryPemohon->row()->nomor_perkara;

			if ($jenis_proses == 1) {
				$pesan = "Assalamu'alaikum Wr. Wb.\n";
				$pesan .= "Yth. " . $nama . ", Permohonan E-Panjar Anda Dengan Nomor Perkara " . $no_perkara . " Sudah Ditransfer ke Nomor Rekening Anda pada " . $tgl . " sebesar " . $nominal . " dengan No. Reference " . $nomor . "\n";
				$pesan .= "Terima Kasih telah menggunakan Layanan E-Panjar";
			} elseif ($jenis_proses == 2) {
				$pesan = "Assalamu'alaikum Wr. Wb.\n";
				$pesan .= "Yth. " . $nama . ", Permohonan E-Panjar Anda Dengan Nomor Perkara " . $no_perkara . " Belum Dapat Dilakukan Ditransfer ke Nomor Rekening Anda pada dikarenakan " . $ket . "\n";
				$pesan .= "Terima Kasih telah menggunakan Layanan E-Panjar";
			}

			$dataNotif = array(
				'jenis_pesan' => "panjar",
				'pesan' => $pesan,
				'nohp' => $nohp,
				'dibuat' => date('Y-m-d H:i:s')
			);

			if ($notif == 'on') {
				$this->admin->simpan_data('sys_notif', $dataNotif);
			}

			$this->session->set_flashdata('info', '1');
			$this->session->set_flashdata('pesan_sukses', 'Data Pengembalian Sisa Panjar Berhasil Diproses');
			redirect('val_psp');
		} else {
			$this->session->set_flashdata('info', '3');
			$this->session->set_flashdata('pesan_gagal', 'Gagal Proses Data, ' . $queryUpdate);
			redirect('val_psp');
		}
	}

	##########################################
	#										 #
	#	 	  SEMUA FUNGSI E-COURT			 #
	#										 #
	##########################################

	public function e_court()
	{
		$data['allEcourt'] = count($this->admin->all_ecourt_data());
		$data['EcourtDone'] = count($this->admin->all_ecourt_done());
		$data['EcourtWait'] = count($this->admin->all_ecourt_wait());
		$data['ecourt'] = $this->admin->all_ecourt_data();
		$this->load->view('admin/header');
		$this->load->view('admin/e_court', $data);
	}

	public function data_detail($id)
	{
		$a = str_replace('___', '/', $this->uri->segment(2));
		$idDecrypt = $this->encryption->decrypt($a);

		$queryPemohon = $this->admin->get_seleksi('data_ecourt', 'id', $idDecrypt)->row();
		if ($queryPemohon->jenisPihak == '1') {
			$data['nama'] = $queryPemohon->nama;
			$data['nik'] = $queryPemohon->no_induk;
			$data['tmpLahir'] = $queryPemohon->tmp_lahir;
			$data['tglLahir'] = $queryPemohon->tgl_lahir;
			$data['jk'] = $queryPemohon->jk;
			$data['alamat'] = $queryPemohon->alamat;
			$data['agama'] = $queryPemohon->agama;
			$data['kawin'] = $queryPemohon->kawin;
			$data['pekerjaan'] = $queryPemohon->pekerjaan;
			$data['bank'] = $queryPemohon->bank;
			$data['no_rek'] = $queryPemohon->no_rek;
			$data['nama_rek'] = $queryPemohon->nama_rek;
			$data['telp'] = $queryPemohon->telp;
			$data['no_hp'] = $queryPemohon->nohp;
			$data['email'] = $queryPemohon->email;
			$data['difabel'] = $queryPemohon->difabel;
			$data['pendidikan'] = $queryPemohon->pendidikan;
			$data['ktp'] = $queryPemohon->dokumen_1;
			$data['dibuat'] = $queryPemohon->dibuat;
		}
	}

	public function modal_ecourt()
	{
		$id = $this->encrypt->decode(base64_decode($this->input->post('id')));
		$jenis = $this->input->post('jenis');

		$status = array('' => "Pilih Status", '1' => 'Diproses', '2' => 'Tidak Diproses');

		$judul = "PROSES PERMOHONAN";
		$query = $this->admin->get_seleksi('data_ecourt', 'id', $id);
		$jenisPihak = $query->row()->jenisPihak;
		if ($jenisPihak == 1) {
			$jenisPihak = "Perorangan";
			$nama = $query->row()->nama;
			$nik = $query->row()->no_induk;
			$tmp_lahir = $query->row()->tmp_lahir;
			$tgl_lahir = $query->row()->tgl_lahir;
			$jk = $query->row()->jk;
			$alamat = $query->row()->alamat;
			$agama = $query->row()->agama;
			$kawin = $query->row()->kawin;
			$pekerjaan = $query->row()->pekerjaan;
			$bank = $query->row()->bank;
			$no_rek = $query->row()->no_rek;
			$nama_rek = $query->row()->nama_rek;
			$telp = $query->row()->telp;
			$no_hp = $query->row()->nohp;
			$email = $query->row()->email;
			$difabel = $query->row()->difabel;
			$pendidikan = $query->row()->pendidikan;
			$ktp = base_url() . 'assets/dokumen/ecourt/' . $query->row()->dokumen_1;
		}

		if ($jenis == 1) {
			$stat = form_dropdown('status', $status, '', 'class="form-control" onChange="statusProses()" id="status"');

			echo json_encode(
				array(
					'st' => 1,
					'id' => $id,
					'judul' => $judul,
					'jenisPihak' => $jenisPihak,
					'nik' => $nik,
					'nama' => $nama,
					'tmp_lahir' => $tmp_lahir,
					'tgl_lahir' => $tgl_lahir,
					'jk' => $jk,
					'alamat' => $alamat,
					'agama' => $agama,
					'kawin' => $kawin,
					'pekerjaan' => $pekerjaan,
					'bank' => $bank,
					'no_rek' => $no_rek,
					'nama_rek' => $nama_rek,
					'status' => $stat,
					'telp' => $telp,
					'no_hp' => $no_hp,
					'email' => $email,
					'difabel' => $difabel,
					'pendidikan' => $pendidikan,
					'ktp' => $ktp
				)
			);
		} else {
			$stat_ = $query->row()->status;
			$password = $query->row()->password;
			$ket = $query->row()->ket;
			$stat = form_dropdown('status', $status, $stat_, 'class="form-control" onChange="statusProses()" disabled id="status"');
			echo json_encode(
				array(
					'st' => 1,
					'id' => $id,
					'judul' => $judul,
					'jenisPihak' => $jenisPihak,
					'nik' => $nik,
					'nama' => $nama,
					'tmp_lahir' => $tmp_lahir,
					'tgl_lahir' => $tgl_lahir,
					'jk' => $jk,
					'alamat' => $alamat,
					'agama' => $agama,
					'kawin' => $kawin,
					'pekerjaan' => $pekerjaan,
					'bank' => $bank,
					'no_rek' => $no_rek,
					'nama_rek' => $nama_rek,
					'telp' => $telp,
					'no_hp' => $no_hp,
					'email' => $email,
					'difabel' => $difabel,
					'pendidikan' => $pendidikan,
					'ktp' => $ktp,
					'password' => $password,
					'status' => $stat,
					'ket' => $ket
				)
			);
		}

		return;
	}

	public function proses_ecourt()
	{
		$jenis_proses = $this->input->post('jenis');
		$id = $this->input->post('id');
		$notif = $this->input->post('notif');

		if ($jenis_proses == '2') {
			$this->form_validation->set_rules('ket', 'Keterangan', 'trim|required');
			$this->form_validation->set_message('required', '%s Tidak Boleh Kosong');

			if ($this->form_validation->run() == FALSE) {
				//echo json_encode(array('st' => 0, 'msg' => 'Tidak Berhasil:<br/>'.validation_errors()));
				$this->session->set_flashdata('info', '3');
				$this->session->set_flashdata('pesan_gagal', form_error('ket'));
				redirect('val_ecourt', validation_errors());
				return;
			}

			$ket = $this->input->post('ket');

			$dataValidasi = array(
				'status' => $jenis_proses,
				'ket' => $ket,
				'diperbarui' => date('Y-m-d H:i:s')
			);
		} elseif ($jenis_proses == '1') {
			$this->form_validation->set_rules('password', 'Password Ecourt', 'trim|required');

			$this->form_validation->set_message('required', '%s Tidak Boleh Kosong');

			if ($this->form_validation->run() == FALSE) {
				//echo json_encode(array('st' => 0, 'msg' => 'Tidak Berhasil:<br/>'.validation_errors()));
				$this->session->set_flashdata('info', '3');
				$this->session->set_flashdata('pesan_gagal', form_error('password'));
				redirect('val_ecourt', validation_errors());
				return;
			}

			$ket = $this->input->post('ket_proses');
			$password = $this->input->post('password');

			$dataValidasi = array(
				'status' => $jenis_proses,
				'password' => $password,
				'ket' => $ket,
				'diperbarui' => date('Y-m-d H:i:s')
			);
		}

		$queryUpdate = $this->admin->pembaharuan_data('data_ecourt', $dataValidasi, 'id', $id);

		if ($queryUpdate == 1) {
			$queryPemohon = $this->admin->get_seleksi('data_ecourt', 'id', $id);
			$nohp = $queryPemohon->row()->nohp;
			$nama = $queryPemohon->row()->nama;
			$email = $queryPemohon->row()->email;

			if ($jenis_proses == 1) {
				$pesan = "Assalamu'alaikum Wr. Wb.\n";
				$pesan .= "Yth. " . $nama . ", Permohonan Pendaftaran Pengguna E-Court Anda Dengan Nomor Perkara Sudah Diproses.\n";
				$pesan .= "Silakan login ke aplikasi Ecourt Mahkamah Agung di alamat https://ecourt.mahkamahagung.go.id/login dengan menggunakan :\n";
				$pesan .= "*Username* : " . $email . "\n";
				$pesan .= "*Password* : " . $password . "\n";
				$pesan .= "Terima Kasih telah menggunakan Layanan Pendaftaran Pengguna E-Ecourt MS Banda Aceh";
			} elseif ($jenis_proses == 2) {
				$pesan = "Assalamu'alaikum Wr. Wb.\n";
				$pesan .= "Yth. " . $nama . ", Permohonan Pendaftaran Pengguna E-Court Anda Belum Dapat Diproses dikarenakan " . $ket . ". Silakan lakukan pendaftaran ulang.\n";
				$pesan .= "Terima Kasih telah menggunakan Layanan Pendaftaran Pengguna E-Ecourt MS Banda Aceh";
			}

			$dataNotif = array(
				'jenis_pesan' => "ecourt",
				'pesan' => $pesan,
				'nohp' => $nohp,
				'dibuat' => date('Y-m-d H:i:s')
			);

			if ($notif == 'on') {
				$this->admin->simpan_data('sys_notif', $dataNotif);
			}

			$this->session->set_flashdata('info', '1');
			$this->session->set_flashdata('pesan_sukses', 'Data Permohonan Pengguna Ecourt Berhasil Diproses');
			redirect('val_ecourt');
		} else {
			$this->session->set_flashdata('info', '3');
			$this->session->set_flashdata('pesan_gagal', 'Gagal Proses Data, ' . $queryUpdate);
			redirect('val_ecourt');
		}
	}

	##########################################
	#										 #
	#	 SEMUA FUNGSI MANAJEMEN PENGGUNA	 #
	#										 #
	##########################################

	public function manage_users()
	{
		$data['users'] = $this->admin->all_users_data();
		$this->load->view('admin/header');
		$this->load->view('admin/manage_users', $data);
	}

	public function modal_users()
	{
		$id = $this->encrypt->decode(base64_decode($this->input->post('id')));

		$queryRole = $this->admin->pilih_role();
		$role = array();
		$role[''] = "Pilih Role Pengguna";
		foreach ($queryRole->result() as $row) {
			$role[$row->id] = $row->nama_role;
		}

		$status = array('' => "Pilih Status", '1' => 'Aktif', '0' => 'Tidak Aktif');

		$nama = "";
		$hp = "";
		$username = "";
		$password = "";

		if ($id == '-1') {
			$id = '';
			$judul = "TAMBAH DATA PENGGUNA";
			$role_cb = form_dropdown('role', $role, '', 'class="form-control" id="role"');
			$aktif_cb = form_dropdown('status', $status, '', 'class="form-control" id="status"');
		} else {
			$judul = "EDIT DATA PENGGUNA";
			$query = $this->admin->get_seleksi('v_users', 'userid', $id);
			$nama = $query->row()->nama;
			$hp = $query->row()->hp;
			$role_user = $query->row()->role;
			$username = $query->row()->username;
			$stat = $query->row()->status;
			$password = "xxxx";

			$role_cb = form_dropdown('role', $role, $role_user, 'class="form-control" id="role"');
			$aktif_cb = form_dropdown('status', $status, $stat, 'class="form-control" id="status"');
		}

		echo json_encode(
			array(
				'st' => 1,
				'judul' => $judul,
				'username' => $username,
				'pass' => $password,
				'nama' => $nama,
				'id' => $id,
				'status' => $aktif_cb,
				'role' => $role_cb,
				'hp' => $hp
			)
		);
		return;
	}

	public function simpan_user()
	{
		$password = $this->input->post('password');

		if ($password != 'xxxx') {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
			$this->form_validation->set_message('min_length', '%s Tidak Boleh Kurang Dari %s Karakter');
		}

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('hp', 'Nomor Handphone', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('status', 'Status Pengguna', 'trim|required');
		$this->form_validation->set_rules('role', 'Role Pengguna', 'trim|required');

		$this->form_validation->set_message('required', '%s Tidak Boleh Kosong');

		if ($this->form_validation->run() == FALSE) {
			//echo json_encode(array('st' => 0, 'msg' => 'Tidak Berhasil:<br/>'.validation_errors()));
			$this->session->set_flashdata('info', '3');
			$this->session->set_flashdata('pesan_gagal', form_error('role') . form_error('status') . form_error('nama') . form_error('password') . form_error('hp') . form_error('username'));
			redirect('manage_users', validation_errors());
			return;
		}

		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');

		$hp = $this->input->post('hp');
		$status = $this->input->post('status');
		$role = $this->input->post('role');

		if ($id) {
			if ($password == 'xxxx') {
				$dataPengguna = array(
					'userid' => $id,
					'fullname' => $nama,
					'username' => $username,
					'nohp' => $hp,
					'role' => $role,
					'status' => $status,
					'modified_by' => $this->session->userdata('fullname'),
					'modified_on' => date('Y-m-d H:i:s')
				);
			} else {
				$kunci_user = md5(uniqid());
				$password_enkrip = $this->arr2md5(array($kunci_user, $password));
				$dataPengguna = array(
					'userid' => $id,
					'fullname' => $nama,
					'username' => $username,
					'password' => $password_enkrip,
					'nohp' => $hp,
					'kunci_user' => $kunci_user,
					'role' => $role,
					'status' => $status,
					'modified_by' => $this->session->userdata('fullname'),
					'modified_on' => date('Y-m-d H:i:s')
				);
			}

			$querySimpan = $this->admin->pembaharuan_data('sys_users', $dataPengguna, 'userid', $id);
		} else {

			$kunci_user = md5(uniqid());
			$password_enkrip = $this->arr2md5(array($kunci_user, $password));
			$dataPengguna = array(
				'userid' => $id,
				'fullname' => $nama,
				'username' => $username,
				'password' => $password_enkrip,
				'nohp' => $hp,
				'kunci_user' => $kunci_user,
				'status' => $status,
				'role' => $role,
				'created_by' => $this->session->userdata('fullname'),
				'created_on' => date('Y-m-d H:i:s')
			);
			$querySimpan = $this->admin->simpan_data('sys_users', $dataPengguna);
		}

		if ($querySimpan == 1) {
			$this->session->set_flashdata('info', '1');
			if ($id) {
				$this->session->set_flashdata('pesan_sukses', 'Pengguna Berhasil di Perbarui');
			} else {

				$pesan = "Assalamu'alaikum Wr. Wb.\n";
				$pesan .= "Yth. " . $nama . ", Anda didaftarkan sebagai petugas PTSP Online. Dengan :\n";
				$pesan .= "Username = " . $username . "\n";
				$pesan .= "Password = " . $password . "\n\n";
				$pesan .= "Silakan Login melalui Aplikasi PTSP Online MS Banda Aceh";

				$dataNotif = array(
					'jenis_pesan' => "user",
					'pesan' => $pesan,
					'nohp' => $hp,
					'dibuat' => date('Y-m-d H:i:s')
				);

				$this->admin->simpan_data('sys_notif', $dataNotif);

				$this->session->set_flashdata('pesan_sukses', 'Pengguna Baru Berhasil di Tambahkan');
			}
			redirect('manage_users');
		} else {
			$this->session->set_flashdata('info', '3');
			$this->session->set_flashdata('pesan_gagal', 'Gagal Simpan, ' . $querySimpan);
			redirect('manage_users');
		}
	}

	public function hapus_user()
	{
		$id = $this->encrypt->decode(base64_decode($this->input->post('id')));

		$hapusPengguna = $this->admin->hapus_data('sys_users', $id);
		if ($hapusPengguna) {
			$this->session->set_flashdata('info', '1');
			$this->session->set_flashdata('pesan_sukses', 'Data Pengguna Berhasil di hapus');
			redirect('manage_users');
		} else {
			$this->session->set_flashdata('info', '3');
			$this->session->set_flashdata('pesan_gagal', 'Data Pengguna Gagal di hapus');
			redirect('manage_users');
		}
	}

	##########################################
	#										 #
	#	   SEMUA FUNGSI PETUGAS LAYANAN	 	 #
	#										 #
	##########################################

	public function petugas()
	{
		$data['petugas'] = $this->admin->all_petugas_data();
		$this->load->view('admin/header');
		$this->load->view('admin/list_petugas', $data);
	}

	public function modal_petugas()
	{
		$id = $this->encrypt->decode(base64_decode($this->input->post('id')));

		$nama = "";
		$jabatan = "";
		$foto = "";

		if ($id == '-1') {
			$id = '';
			$judul = "TAMBAH DATA PETUGAS";
		} else {
			$judul = "EDIT DATA PETUGAS";
			$query = $this->admin->get_seleksi('data_petugas', 'id', $id);
			$nama = $query->row()->nama;
			$jabatan = $query->row()->jabatan;
			$foto = $query->row()->foto;
		}

		echo json_encode(
			array(
				'st' => 1,
				'judul' => $judul,
				'nama' => $nama,
				'id' => $id,
				'jabatan' => $jabatan,
				'foto' => $foto
			)
		);
		return;
	}

	public function simpan_petugas()
	{

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('jabatan', 'Jabatan Petugas', 'trim|required');

		$this->form_validation->set_message(['required' => '%s Tidak Boleh Kosong']);

		if ($this->form_validation->run() == FALSE) {
			//echo json_encode(array('st' => 0, 'msg' => 'Tidak Berhasil:<br/>'.validation_errors()));
			$this->session->set_flashdata('info', '3');
			$this->session->set_flashdata('pesan_gagal', validation_errors());
			redirect('list_petugas');
			return;
		}

		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$jabatan = $this->input->post('jabatan');

		if (!empty($_FILES['foto']['name'])) {
			$max_size = 5000 * 1024;
			if ($_FILES['foto']['size'] > $max_size) {
				$this->session->set_flashdata('info', '3');
				$this->session->set_flashdata('pesan_gagal', 'Gagal simpan, file Foto terlalu besar (Maksimal 5MB)');
				redirect('list_petugas');
			} elseif ($_FILES['foto']['type'] != 'image/png') {
				$this->session->set_flashdata('info', '3');
				$this->session->set_flashdata('pesan_gagal', 'Gagal simpan Permohonan, file KTP harus png');
				redirect('list_petugas');
			} else {
				$doc = time() . '-' . $_FILES["foto"]['name'];
				$config = array(
					'upload_path' => './assets/foto/petugas/',
					'allowed_types' => "png",
					'file_ext_tolower' => TRUE,
					'file_name' => $doc,
					'overwrite' => TRUE,
					'remove_spaces' => TRUE,
					'max_size' => "5000"
				);

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('foto')) {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('info', '3');
					$this->session->set_flashdata('pesan_gagal', 'Gagal upload file: ' . $error);
					redirect('list_petugas');
				} else {
					$upload_data = $this->upload->data();
				}
			}
		} else {
			if (!$this->input->post('id')) {
				$this->session->set_flashdata('info', '3');
				$this->session->set_flashdata('pesan_gagal', 'Gagal simpan, file Foto tidak boleh kosong');
				redirect('list_petugas');
			}
		}

		if ($id) {

		} else {
			$data = array(
				'nama' => $nama,
				'jabatan' => $jabatan,
				'foto' => $upload_data['file_name'],
				'created_by' => $this->session->userdata('fullname'),
				'created_on' => date('Y-m-d H:i:s')
			);

			#die(var_dump($data));

			$querySimpan = $this->admin->simpan_data('data_petugas', $data);
		}

		if ($querySimpan == 1) {
			$this->session->set_flashdata('info', '1');
			if ($id) {
				$this->session->set_flashdata('pesan_sukses', 'Petugas Berhasil di Perbarui');
			} else {
				$this->session->set_flashdata('pesan_sukses', 'Petugas Baru Berhasil di Tambahkan');
			}
			redirect('list_petugas');
		} else {
			$this->session->set_flashdata('info', '3');
			$this->session->set_flashdata('pesan_gagal', 'Gagal Simpan, ' . $querySimpan);
			redirect('list_petugas');
		}
	}

	public function nilai_petugas()
	{
		$tahun_periode = $this->admin->ambil_tahun_survei();

		if (!$this->input->post('jenis_periode')) {
			$data = [
				'jenis' => '0'
			];
			
			$periode = 'TAHUN ' . date('Y');
		} else {
			$jenis_periode = $this->input->post('jenis_periode');
			if ($jenis_periode == '1') {
				$tahun = $this->input->post('tahun_periode');
				$triwulan = $this->input->post('triwulan');

				$data = [
					'jenis' => $jenis_periode,
					'data_nilai' => [
						'tahun' => $tahun,
						'triwulan' => $triwulan
					]
				];

				$periode = 'TRIWULAN ' . $triwulan . ' TAHUN ' . $tahun;
			} else {
				$tgl_awal = $this->input->post('tgl_awal');
				$tgl_akhir = $this->input->post('tgl_akhir');

				$data = [
					'jenis' => $jenis_periode,
					'data_nilai' => [
						'tgl_awal' => $tgl_awal,
						'tgl_akhir' => $tgl_akhir
					]
				];

				$periode = $this->tanggalhelper->konversiTanggal($tgl_awal) . ' s/d ' . $this->tanggalhelper->konversiTanggal($tgl_akhir);
			}
		}

		$nilai['total_responden'] = count($this->admin->all_nilai_petugas_periode($data));
		$nilai['total_keramahan'] = $this->admin->nilai_keramahan_periode($data)->row()->rata_keramahan;
		$nilai['total_kepuasan'] = $this->admin->nilai_kepuasan_periode($data)->row()->rata_kepuasan;
		$nilai['petugas_terbaik'] = $this->admin->petugas_terbaik_periode($data);
		$nilai['tahun_periode'] = $tahun_periode;
		$nilai['periode'] = $periode;
		$nilai['petugas'] = $this->admin->nilai_petugas_periode($data);
		#die(var_dump($nilai));
		$this->load->view('admin/header');
		$this->load->view('admin/list_nilai_petugas', $nilai);
	}
}
