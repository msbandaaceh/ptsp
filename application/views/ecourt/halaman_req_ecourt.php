<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>PTSP - PERMOHONAN USER ECOURT</title>
    <meta content="Informasi AKta Cerai" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="assets/img/logo/logo-ms-bna.webp">

    <!-- Sweet Alert -->
    <link href="assets/vendor/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">

    <link href="assets/vendor/bootstrap-md-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>

    <!-- Background -->
    <div class="ecourt-pages"></div>

    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main">
            <div class="container-fluid">

                <!-- Logo container-->
                <div class="logo">
                    <a href="<?= base_url() ?>" class="logo">
                        <div class="text-white">
                            <img src="assets/img/logo/logo-ms-bna.webp" alt="" class="logo-small">
                            <img src="assets/img/logo/logo-ecourt.webp" alt="" class="logo-large">
                        </div>
                    </a>

                </div>

                <!-- End Logo container-->

                <div class="menu-extras topbar-custom">
                    <ul class="navbar-right d-flex list-inline float-right mb-0">
                        <li class="menu-item list-inline-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div> <!-- end container -->
        </div>
        <!-- end topbar-main -->

        <!-- MENU Start -->
        <div class="navbar-custom">
            <div class="container-fluid">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">

                        <li class="has-submenu">
                            <a href="ecourt"><i class="mdi mdi-home"></i>Beranda</a>
                        </li>

                        <li class="has-submenu">
                            <a href="req_ecourt"><i class="mdi mdi-buffer"></i>Permohonan Pengguna E-Court</a>
                        </li>

                        <li class="float-right">
                            <a href="admin">
                                <i class="mdi mdi-account-key"></i>Login
                                Admin
                            </a>
                        </li>
                    </ul>
                    <!-- End navigation menu -->
                </div> <!-- end #navigation -->
            </div> <!-- end container -->
        </div> <!-- end navbar-custom -->
    </header>
    <!-- End Navigation Bar-->

    <!-- Begin page -->
    <div class="wrapper">
        <div class="page-title-box-no-bg">
            <div class="container-fluid">

                <div class="card bg-success">
                    <div class="card-header">
                        <h5 class="display-6">
                            <p class="text-center text-green">FORMULIR PERMOHONAN PENGGUNA E-COURT</p>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="cbJenisPihak" class="col-sm-2 col-form-label">Jenis Pihak <code>*</code></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="cbJenisPihak" onchange="gantiJenisPihak()">
                                    <option>Pilih Jenis Pihak</option>
                                    <option value="1">Perorangan</option>
                                </select>
                            </div>
                        </div>

                        <!-- Form Pengguna Perorangan -->
                        <div id="userPerorangan" style="display: none">
                            <div class="alert alert-info text-center" role="alert">
                                DATA UMUM
                            </div>

                            <form method="POST" action="simpan_ecourt" enctype="multipart/form-data">
                                <input class="form-control" type="hidden" id="jenisPihak_1" name="jenisPihak">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap <code>*</code></label>
                                    <input class="form-control" type="text" id="nama" name="nama" required
                                        placeholder="Masukkan Nama" autocomplete="off">
                                    Penulisan nama tidak diperbolehkan ada tanda petik ('), karena akan bermasalah pada
                                    tahap ePayment

                                </div>
                                <div class="form-group">
                                    <label for="ni">NIK <code>*</code></label>
                                    <input class="form-control" data-parsley-type="digits" data-parsley-min="16"
                                        data-parsley-maxlength="16" type="text" id="ni" name="ni" autocomplete="off"
                                        placeholder="Masukkan Nomor Induk Kependudukan" required>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="tmptLahir">Tempat Lahir
                                                <code>*</code></label>
                                            <input class="form-control" type="text" id="tmptLahir" name="tmptLahir"
                                                autocomplete="off" placeholder="Masukkan Tempat Lahir" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="tglLahir">Tanggal Lahir
                                                <code>*</code></label>
                                            <input class="form-control floating-label" type="text" id="tglLahir"
                                                placeholder="Pilih" autocomplete="off">
                                            <input class="form-control" type="hidden" id="tglLahir_" name="tglLahir"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="cbJenisKelamin">Jenis Kelamin
                                                <code>*</code></label>
                                            <select class="form-control" id="cbJenisKelamin" name="jenisKelamin"
                                                required>
                                                <option>Pilih</option>
                                                <option value="1">Laki - laki</option>
                                                <option value="2">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="cbAgama">Agama
                                                <code>*</code></label>
                                            <select class="form-control" id="cbAgama" name="agama" required>
                                                <option>Pilih</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Protestan">Protestan</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Kong Hu Cu">Kong Hu Cu</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat <code>*</code></label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="2" required
                                        placeholder="Masukkan Alamat Lengkap Anda" autocomplete="off"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="cbKawin">Status Kawin
                                                <code>*</code></label>
                                            <select class="form-control" id="cbKawin" name="kawin" required>
                                                <option>Pilih</option>
                                                <option value="1">Kawin</option>
                                                <option value="2">Belum Kawin</option>
                                                <option value="3">Duda</option>
                                                <option value="4">Janda</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="pekerjaan">Pekerjaan
                                                <code>*</code></label>
                                            <input class="form-control" type="text" id="pekerjaan" name="pekerjaan"
                                                required placeholder="Masukkan Pekerjaan Anda" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info text-center" role="alert">
                                    DATA KHUSUS
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="bank">Bank <code>*</code></label>
                                            <select class="form-control" id="bank" name="bank" required>
                                                <option value="">Pilih</option>
                                                <option value="BSI">BSI</option>
                                                <option value="BPD ACEH">BPD ACEH</option>
                                                <option value="B C A">B C A</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="no_rek">Nomor Rekening
                                                <code>*</code></label>
                                            <input class="form-control" data-parsley-type="digits"
                                                data-parsley-maxlength="15" type="text" id="no_rek" name="no_rek"
                                                required placeholder="Masukkan Nomor Rekening Anda" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nama_rek">Nama Pemilik Rekening
                                        <code>*</code></label>
                                    <input class="form-control" type="text" id="nama_rek" name="nama_rek" required
                                        placeholder="Masukkan Nama Pemilik Rekening" autocomplete="off">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="no_telp">Nomor Telepon</label>
                                            <input class="form-control" data-parsley-type="digits"
                                                data-parsley-maxlength="15" type="text" id="no_telp" name="no_telp"
                                                placeholder="Masukkan Nomor Telepon Anda" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="no_hp">Nomor Handphone
                                                <code>*</code></label>
                                            <input class="form-control" data-parsley-type="digits"
                                                data-parsley-maxlength="15" type="text" id="no_hp" name="no_hp" required
                                                placeholder="Masukkan Nomor Handphone Anda" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Alamat E-Mail
                                        <code>*</code></label>
                                    <input class="form-control" type="text" id="email" name="email" required
                                        placeholder="Masukkan Alamat Email Anda" parsley-type="email"
                                        autocomplete="off">
                                    Pastikan Email belum pernah digunakan untuk mendaftar akun E-Court
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="difabel">Berkebutuhan Khusus
                                                <code>*</code></label>
                                            <select class="form-control" required id="difabel" name="difabel">
                                                <option>Pilih</option>
                                                <option value="1">Tidak</option>
                                                <option value="2">Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="pendidikan">Pendidikan
                                                <code>*</code></label>
                                            <select required class="form-control" id="pendidikan" name="pendidikan">
                                                <option>Pilih</option>
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="Tidak Ada">Belum Sekolah</option>
                                                <option value="TK">TK</option>
                                                <option value="SD">SD</option>
                                                <option value="SLTP">SLTP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="D1">D1</option>
                                                <option value="D2">D2</option>
                                                <option value="D3">D3</option>
                                                <option value="D4">D4</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>File KTP/Passport/Surat Keterangan Pengganti KTP (maks 5Mb <em>ekstensi
                                            jpg/png/pdf</em>) <code>*</code></label>
                                    <input type="file" required class="filestyle" id="file" accept=".pdf, .png, .jpg"
                                        data-buttonname="btn-secondary" name="dokumen">
                                </div>

                                <span class="badge badge-pill badge-danger mb-3">* Wajib diisi</span>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input required type="checkbox" class="custom-control-input"
                                            id="customControlInline">
                                        <label class="custom-control-label" for="customControlInline">Saya telah membaca
                                            dan memahami <a class="text-warning" href="#" data-toggle="modal"
                                                data-target=".modal-sk">Syarat dan Ketentuan</a>.</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="text-center">
                                        <div class="g-recaptcha"
                                            data-sitekey="<?= $this->config->item('g_site_key')?>"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="text-center">
                                        <button type="submit" id="btnSimpan"
                                            class="btn btn-success waves-effect waves-light">
                                            Simpan
                                        </button>
                                        <button type="reset" id="btnReset" class="btn btn-secondary waves-effect m-l-5">
                                            Reset
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Form Pengguna Perorangan -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>
    </div>
    <div id="wrapper-page">
        <!-- page-title-box -->
        <div class="page-content-wrapper">



            <!-- end container-fluid -->
        </div>
    </div>

    <div class="modal fade modal-sk" tabindex="-1" role="dialog" aria-labelledby="modalPanjar" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="title" class="modal-title mt-0">Syarat dan Ketentuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    Layanan ini merupakan inovasi untuk pelayanan pembuatan akun e-court bagi pengguna lain secara
                    online. Layanan ini sebagai pendukung layanan meja e-court yang diperuntukan
                    bagi masyarakat di wilayah hukum Mahkamah SYar'iyah Banda Aceh khususnya yang memiliki keterbatasan
                    waktu dan kendala jarak untuk datang ke Mahkamah Syar'iyah Banda Aceh
                    Kelas IA secara langsung. </br>

                    Sebelum melakukan permohonan akun e-Court bagi pengguna lain, perhatikan hal-hal sebagai berikut
                    :</br>

                    1. Pemohon Akun harus pihak yang berperkara di wilayah hukum Mahkamah Syar'iyah Banda Aceh Kelas
                    1A</br>
                    2. Kami sangat merekomendasikan menggunakan email dari layanan GMAIL.</br>
                    3. Nomor Handphone yang didaftarkan adalah nomor whatsapp yang akan digunakan sebagai media
                    notifikasi</br>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="text-center">
                            <button type="button" data-dismiss="modal" class="btn btn-danger waves-effect waves-light">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- END wrapper -->

    <?php
    if ($this->session->flashdata('info')) {
        $result = $this->session->flashdata('info');
        if ($result == '1') {
            $pesan = $this->session->flashdata('pesan_sukses');
        } elseif ($result == '2') {
            $pesan = $this->session->flashdata('pesan_peringatan');
        } else {
            $pesan = $this->session->flashdata('pesan_gagal');
        }
    } else {
        $result = "-1";
        $pesan = "";
    }
    ?>

    <script type="text/javascript">
        var config = {
            result: '<?= $result ?>',
            pesan: '<?= $pesan ?>'
        };
    </script>

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/waves.min.js"></script>

    <script src="assets/vendor/jquery-sparkline/jquery.sparkline.min.js"></script>

    <script src="assets/vendor/bootstrap-md-datetimepicker/js/moment-with-locales.min.js"></script>
    <script src="assets/vendor/timepicker/bootstrap-material-datetimepicker.js"></script>
    <script src="assets/vendor/bootstrap-filestyle/js/bootstrap-filestyle.js"></script>

    <!-- Sweet-Alert  -->
    <script src="assets/vendor/sweetalert/sweetalert.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <script src="assets/js/ecourt.js"></script>
    <script src="assets/js/parsley.js"></script>

    <script>
        $(document).ready(function () {
            $('form').parsley();
        });
    </script>
</body>

</html>