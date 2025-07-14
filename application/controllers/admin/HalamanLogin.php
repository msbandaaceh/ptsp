<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HalamanLogin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('ModelAdmin', 'admin');
    }

    public function index()
    {
        $this->load->view('admin/halaman_login');
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

    public function validasi()
    {
        $this->form_validation->set_rules('username', 'Username Pengguna', 'trim|required|max_length[18]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_message('required', '%s Tidak Boleh Kosong');
        $this->form_validation->set_message('max_length', '%s Tidak Boleh Melebihi 18 Karakter');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('info', '2');
            $this->session->set_flashdata('pesan_peringatan', form_error('username') . ' ' . form_error('password'));
            redirect('login', validation_errors());
            return;
        }

        $user = $this->input->post('username');
        $pass = $this->input->post('password');

        $queryUser = $this->admin->get_seleksi('sys_users', 'username', $user);
        $cekUser = $queryUser->num_rows();

        if ($cekUser == 1) {
            $kunci = $queryUser->row()->kunci_user;
            $passEnkrip = $this->arr2md5(array($kunci, $pass));
            $passUser = $queryUser->row()->password;
            //die(var_dump($row));
            if ($passUser == $passEnkrip) {
                $this->session->set_userdata('login_attempts', 0);
                // Regenerate session ID to prevent session fixation
                $this->session->sess_regenerate();

                $this->session->set_userdata('status_login', TRUE);
                $this->session->set_userdata('userid', $queryUser->row()->userid);
                $this->session->set_userdata('fullname', $queryUser->row()->fullname);
                $this->session->set_userdata('nohp', $queryUser->row()->nohp);
                $this->session->set_userdata('role', $queryUser->row()->role);

                redirect('admin');
            } else {
                $this->session->set_flashdata('info', '3');
                $this->session->set_flashdata('pesan_gagal', "Password Salah");
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('info', '3');
            $this->session->set_flashdata('pesan_gagal', "User Tidak Ditemukan");
            redirect('login');
        }
    }

    public function keluar()
    {
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('login');
    }
}
