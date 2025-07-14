<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>PTSP - Sistem Informasi Akta Cerai</title>
    <meta content="Informasi AKta Cerai" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="assets/img/logo/logo-ms-bna.webp">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

    <!-- Background -->
    <div class="ac-pages"></div>

    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main">
            <div class="container-fluid">

                <!-- Logo container-->
                <div class="logo">
                    <a href="<?= base_url() ?>" class="logo">
                        <div class="text-white">
                            <img src="assets/img/logo/logo-ms-bna.webp" alt="" class="logo-small">
                            <img src="assets/img/logo/logo-ac.webp" alt="" class="logo-large">
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
                            <a href="ac"><i class="mdi mdi-home"></i>Beranda</a>
                        </li>

                        <li class="has-submenu">
                            <a href="info_ac"><i class="mdi mdi-buffer"></i>Informasi Akta Cerai</a>
                        </li>

                        <li class="has-submenu">
                            <a href="valid_ac"><i class="mdi mdi-black-mesa"></i>Validasi Akta Cerai</a>
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

                <div class="card bg-primary mini-stat position-relative ">
                    <div class="card-header">
                        <h1 class="text-white display-4">
                            <p class="text-center">LAYANAN INFORMASI AKTA CERAI</p>
                        </h1>
                        <h3 class="text-white text-center">MAHKAMAH SYAR'IYAH BANDA ACEH</h3>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <div class="alert alert-success bg-success text-white text-center" role="alert">
                                <h4 class="alert-heading font-18">Selamat Datang</h4>
                                <p>Merupakan aplikasi validasi akta cerai online dari Mahkamah Syar'iyah Banda Aceh,
                                    sebagai alat untuk masyarakat agar bisa melakukan pengecekan status penerbitan dan
                                    validasi mandiri atas keabsahan akta cerai.</p>
                                <p class="mb-0">Jika masih ragu dalam pengecekan secara online, anda bisa datang
                                    langsung ke kantor saat jam
                                    kerja untuk menemui petugas Informasi.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="card bg-primary m-b-30">
                            <img class="card-img-top img-fluid" src="assets/img/ac.jpg" alt="Card image cap">
                            <div class="card-body text-center">
                                <h4 class="card-title font-16 mt-0 text-white">Info Akta Cerai</h4>
                                <p class="card-text text-white">Informasi Penerbitan Akta Cerai</p>
                                <a href="info_ac" class="btn btn-warning waves-effect waves-light">Lihat</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="card bg-primary m-b-30">
                            <img class="card-img-top img-fluid" src="assets/img/ac.jpg" alt="Card image cap">
                            <div class="card-body text-center">
                                <h4 class="card-title font-16 mt-0 text-white">Validasi Akta Cerai</h4>
                                <p class="card-text text-white">Pengecekan Keabsahan Akta Cerai</p>
                                <a href="valid_ac" class="btn btn-warning waves-effect waves-light">Lihat</a>
                            </div>
                        </div>
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
    <!-- END wrapper -->
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