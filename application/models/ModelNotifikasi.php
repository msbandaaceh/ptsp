<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelNotifikasi extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function tambahNotif($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    public function format_nomorhp($nohp)
    {
        $nohps = explode("/", str_replace("'", "", $nohp));
        $nohp = $nohps[0];
        if ((substr($nohp, 0, 3) == '+62') or (substr($nohp, 0, 2) == '62')) {
            $hp = $nohp;
        } else {
            $hp = substr_replace("$nohp", "62", 0, 1);
        }

        return $hp;
    }

    public function notif()
    {
        $notif = [];
        try {
            $kweri_notif = $this->db->query("SELECT * FROM sys_notif WHERE status = 0");

            if ($kweri_notif->num_rows() > 0) {
                foreach ($kweri_notif->result() as $row) {

                    //$cari = array("#jenis_perkara#", "#namap#", "#tgl_daftar#", "#noperk#");
                    //$ganti = array($row->jenis_perkara_nama, str_replace("'", "''", $row->namap), $row->tgl_daftar, $row->nomor_perkara);
                    $pesans = "*[NOTIFIKASI OTOMATIS PTSP ONLINE MS BANDA ACEH]*\n\n" . $row->pesan . "\n\nPesan ini dikirim otomatis oleh sistem MS Banda Aceh";
                    //$tanggals = date("Y-m-d H:i:s");
                    //$this->db->query("insert into waku.perkara_daftar(perkara_id,nomor_perkara,tanggal_daftar,nama_pihak,nomor_hp,pesan,dikirim)values($row->perkara_id,'$row->nomor_perkara','$row->tgl_daftar','" . str_replace("'", "''", $row->namap) . "','$row->telp1','$pesans','$tanggals')");
                    $pesan = array(
                        "telp" => $this->format_nomorhp($row->nohp),
                        "pesan" => $pesans,
                        "tabel" => "sys_notif",
                        "id" => $row->id
                    );
                    $notif[] = $pesan;
                }
                return $notif;
            }


        } catch (Exception $e) {
            $pesan = array("error" => $e);
            $notif[] = $pesan;
        }
    }

    public function update_data($id, $status, $tabel)
    {
        $notif = [];
        $tgl = date('Y-m-d H:i:s');
        try {
            $data = [
                'status' => $status,
                'dikirim' => $tgl,
            ];
    
            $this->db->where('id', $id);
            $this->db->update($tabel, $data);
    
        } catch (Exception $e) {
            $notif[] = ["error" => $e->getMessage()];
        }

        return $notif;
    }
}