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
                                    <option value="2">Pemerintah</option>
                                    <option value="3">Badan Hukum</option>
                                </select>
                            </div>
                        </div>

                        <div id="formEcourt"></div>
                    </div>
                </div>
                <!-- end row -->
            </div>
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
    <script src="assets/js/app.js?v=1.0.0"></script>
    <script src="assets/js/parsley.js"></script>
    <script src="assets/js/ecourt.js?v=1.0.0"></script>
</body>

</html>