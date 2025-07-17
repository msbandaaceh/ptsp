<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelAdmin extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	private function add_audittrail($action, $title, $table, $descrip)
	{
		try {
			$data = array(
				'datetime' => date("Y-m-d H:i:s"),
				'ipaddress' => $this->input->ip_address(),
				'username' => $this->session->userdata('username'),
				'tablename' => $table,
				'action' => $action,
				'title' => $title,
				'description' => $descrip
			);
			$this->db->insert('sys_audittrail', $data);
		} catch (Exception $e) {

		}
	}

	private function fetch_description($title, $data)
	{
		$descrip = '<br><table style="vertical-align:top" cellspacing="0" cellpadding="1" border="1">';
		$descrip .= '<tr><th>Nama Kolom</th><th>Nilai</th></tr>';
		foreach ($data as $key => $value) {
			$descrip .= '<tr>';
			$descrip .= '<td>' . $key . '</td>';
			$descrip .= '<td>' . $value . '</td>';
			$descrip .= '</tr>';
		}
		$descrip .= '</table>';
		return $descrip;
	}

	// MODEL DATA PEGAWAI (start)
	public function all_users_data()
	{
		$this->db->order_by('userid', 'ASC');
		return $this->db->select('*')->from('v_users')->where('role > 0')->get()->result();
	}

	public function all_petugas_data()
	{
		$this->db->order_by('aktif', 'DESC');
		$this->db->order_by('id', 'ASC');
		return $this->db->select('*')->from('data_petugas')->where('aktif', '1')->get()->result();
	}

	public function all_nilai_petugas($tahun)
	{
		$this->db->order_by('id', 'ASC');
		return $this->db->select('*')->from('v_nilai_petugas')->where('tgl_nilai LIKE "%'.$tahun.'%"')->get()->result();
	}

	public function nilai_petugas()
	{
		$this->db->select('petugas_id, nama, foto,
        ROUND(AVG(skor_ramah),2) as rata_keramahan,
        ROUND(AVG(skor_puas),2) as rata_kepuasan,
        ROUND((AVG(skor_ramah) + AVG(skor_puas)) / 2,2) as total_skor');
		$this->db->group_by('petugas_id');
		return $this->db->get('v_nilai_petugas')->result();
	}

	public function all_panjar_data()
	{
		$this->db->order_by('status', 'ASC');
		$this->db->order_by('id', 'ASC');
		return $this->db->select('*')->from('v_e_panjar')->get()->result();
	}

	public function all_panjar_done()
	{
		$this->db->order_by('status', 'ASC');
		$this->db->order_by('id', 'ASC');
		$this->db->where('status > 0');
		return $this->db->select('*')->from('v_e_panjar')->get()->result();
	}

	public function all_panjar_wait()
	{
		$this->db->order_by('status', 'ASC');
		$this->db->order_by('id', 'ASC');
		$this->db->where('status = 0');
		return $this->db->select('*')->from('v_e_panjar')->get()->result();
	}

	public function all_produk_data()
	{
		$this->db->order_by('status', 'ASC');
		$this->db->order_by('id', 'ASC');
		return $this->db->select('*')->from('v_produk')->get()->result();
	}

	public function all_ecourt_data()
	{
		$this->db->order_by('status', 'ASC');
		$this->db->order_by('id', 'ASC');
		return $this->db->select('*')->from('data_ecourt')->get()->result();
	}

	public function all_ecourt_done()
	{
		$this->db->order_by('status', 'ASC');
		$this->db->order_by('id', 'ASC');
		$this->db->where('status > 0');
		return $this->db->select('*')->from('data_ecourt')->get()->result();
	}

	public function all_ecourt_wait()
	{
		$this->db->order_by('status', 'ASC');
		$this->db->order_by('id', 'ASC');
		$this->db->where('status = 0');
		return $this->db->select('*')->from('data_ecourt')->get()->result();
	}

	public function pilih_role()
	{
		try {
			$this->db->order_by('id', 'ASC');
			$this->db->where('id > 0');
			return $this->db->get('ref_role');
		} catch (Exception $e) {
			return $e;
		}
	}

	public function pegawai_data($id)
	{
		$this->db->where('id', $id);
		return $this->db->select('*')->from('v_pegawai')->get()->result();
	}

	public function tambah_pegawai($data)
	{
		$table = 'pegawai';
		try {
			$this->db->insert($table, $data);
			$title = "Tambah Pegawai [Pegawai=<b>" . $data['nama_gelar'] . "</b>]<br />Tambah tabel <b>pegawai</b>]";
			$descrip = null;
			$this->add_audittrail("TAMBAH", $title, $table, $descrip);
			return 1;
		} catch (Exception $e) {
			return $e;
		}
	}

	public function update_pegawai($data, $id)
	{
		$table = 'pegawai';
		try {
			$this->db->where('id', $id);
			$this->db->update($table, $data);
			$title = "Update Pegawai [Pegawai=<b>" . $data['nama_gelar'] . "</b>]<br />Update tabel <b>pegawai</b>]";
			$descrip = null;
			$this->add_audittrail("UPDATE", $title, $table, $descrip);
			return 1;
		} catch (Exception $e) {
			return $e;
		}
	}

	public function hapus_pegawai($id)
	{
		$table = 'pegawai';
		try {
			$this->db->where('id', $id);
			$this->db->delete($table);
			$title = "Hapus Pegawai [Pegawai=<b>" . $id . "</b>]<br />Hapus tabel <b>pegawai</b>]";
			$descrip = $this->fetch_description($title, $id);
			$this->add_audittrail("HAPUS", $title, $table, $descrip);
			return 1;
		} catch (Exception $e) {
			return $e;
		}
	}
	//MODEL DATA PEGAWAI (end)

	private function _get_datatables_query()
	{
		$pengguna_id = $this->session->userdata('userid');
		$group_id = $this->session->userdata('group_id');

		if ($group_id == '2' || $group_id == '3') {
			$arr_group = array('2', '3');
			$arr_pelaksanaan = array('1', '30');
			$this->db->where('tujuan_id', $group_id);
			$this->db->where('tujuan_disposisi_jabatan_id', '2');
			$this->db->where_in('status_pelaksanaan_id', $arr_pelaksanaan);
			$this->db->from('v_suratmasuk');
		} else {
			$this->db->where('status_pelaksanaan_id<>', '20');
			$this->db->where('tujuan_disposisi_id', $pengguna_id);
			$this->db->from('v_suratmasuk');
		}

	}

	public function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$this->db->order_by('register_id', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from('v_suratmasuk');
		return $this->db->count_all_results();
	}

	public function get_seleksi($nama_tabel, $kolom_seleksi, $seleksi)
	{
		try {
			$this->db->where($kolom_seleksi, $seleksi);
			return $this->db->get($nama_tabel);
		} catch (Exception $e) {
			return 0;
		}
	}

	public function get_seleksi_pertama($groupid)
	{
		try {
			return $this->db->query('SELECT * FROM v_suratmasuk WHERE CASE WHEN tujuan_disposisi_jabatan_id IS NULL THEN tujuan_id=' . $groupid . ' ELSE tujuan_disposisi_jabatan_id=' . $groupid . ' END');
		} catch (Exception $e) {
			return 0;
		}
	}

	public function get_history_pelaksanaan($nama_tabel, $register_id, $reg)
	{
		try {
			$this->db->select('tanggal_pelaksanaan,dari_jabatan,keterangan');
			$this->db->where($register_id, $reg);
			$this->db->order_by('pelaksanaan_id', 'ASC');
			return $this->db->get($nama_tabel);
		} catch (Exception $e) {
			return 0;
		}
	}

	public function get_seleksi2($nama_tabel, $kolom_seleksi1, $seleksi1, $kolom_seleksi2, $seleksi2)
	{
		try {
			$this->db->where($kolom_seleksi1, $seleksi1);
			$this->db->where($kolom_seleksi2, $seleksi2);
			return $this->db->get($nama_tabel);
		} catch (Exception $e) {
			return 0;
		}
	}


	public function get_data($nama_tabel)
	{
		try {
			return $this->db->get($nama_tabel);
		} catch (Exception $e) {
			return 0;
		}
	}

	public function simpan_data($tabel, $data)
	{
		try {
			$this->db->insert($tabel, $data);
			return 1;
		} catch (Exception $e) {
			return 0;
		}
	}

	public function pembaharuan_data($tabel, $data, $kolom_seleksi, $seleksi)
	{
		try {
			$this->db->where($kolom_seleksi, $seleksi);
			$this->db->update($tabel, $data);
			return 1;
		} catch (Exception $e) {
			return 0;
		}
	}

	public function hapus_data($tabel, $id)
	{
		try {
			$this->db->where('userid', $id);
			$this->db->delete($tabel);
			return 1;
		} catch (Exception $e) {
			return $e;
		}
	}

	public function get_konfigurasi($id)
	{
		try {
			$this->db->where('id', $id);
			return $this->db->get('sys_config');
		} catch (Exception $e) {
			return 0;
		}
	}
}