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

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
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
            <div class="container">

                <div class="card mini-stat bg-primary position-relative ">
                    <div class="card-header">
                        <h2 class="display-6">
                            <p class="text-center text-green">LAYANAN PERMOHONAN PENGGUNA E-COURT</p>
                        </h2>
                        <h3 class="text-center">MAHKAMAH SYAR'IYAH BANDA ACEH</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-center">
                            Merupakan aplikasi permohonan pembuatan akun pengguna E-Court Mahkamah Agung Republik
                            Indonesia. Pihak dapat melakukan permohonan pembuatan akun E-Court tanpa datang ke kantor
                            Mahkamah Syar'iyah Banda Aceh.

                            Jika anda mengalami kesulitan dalam mengisi formulir permohonan, silakan hubungi Petugas
                            PTSP Online melalui chat, voice call, atau video call Whatsapp (Tautan tersedia di Beranda
                            PTSP Online MS Banda Aceh).
                        </p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="req_ecourt" class="btn btn-warning waves-effect waves-light">Lihat</a>
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

    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>

</html>