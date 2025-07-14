<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>PTSP - Validasi Akta Cerai</title>
    <meta content="Informasi AKta Cerai" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="assets/img/logo/logo-ms-bna.webp">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">

    <!-- Sweet Alert -->
    <link href="assets/vendor/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
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
        <?php if (!$status_validasi) { ?>
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
                                    <i class="mdi mdi-account-key"></i>Login Admin
                                </a>
                            </li>
                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end #navigation -->
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->
        <?php } ?>
    </header>
    <!-- End Navigation Bar-->

    <!-- Begin page -->
    <div class="wrapper">
        <div class="page-title-box-no-bg">
            <div class="container">
                <div class="card bg-primary mini-stat position-relative">
                    <div class="card-header">
                        <h4 class="text-white">
                            <p class="text-center">INFORMASI VALIDASI AKTA CERAI</p>
                        </h4>
                    </div>
                    <?php if (!$status_validasi) {
                        ?>
                        <form method="POST" action="validasi_ac">
                            <div class="card-body">
                                <h4 class="text-center font-18">Masukkan Nomor dan Tahun Perkara</h4>
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <div class="row mb-3">
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" autocomplete="off"
                                                    placeholder="Contoh : 10" maxlength="5" id="no_perkara"
                                                    name="no_perkara" value="<?= $this->session->flashdata('nomor') ?>">
                                            </div>
                                            <div class="col-lg-2">
                                                <a class="btn btn-light waves-effect form-control text-dark">
                                                    Pdt.G
                                                </a>
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" maxlength="4" autocomplete="off"
                                                    placeholder="Contoh : <?= date('Y') ?>"
                                                    value="<?= $this->session->flashdata('tahun') ?>" name="tahun">
                                            </div>
                                            <div class="col-lg-2">
                                                <a class="btn btn-light waves-effect form-control text-dark">
                                                    MS.Bna
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="text-center font-18">Masukkan Nomor dan Tahun Akta Cerai</h4>
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <div class="row mb-3">
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" autocomplete="off"
                                                    placeholder="Contoh : 10" maxlength="5" id="no_ac" name="no_ac"
                                                    value="<?= $this->session->flashdata('nomor_ac') ?>">
                                            </div>
                                            <div class="col-lg-2">
                                                <a class="btn btn-light waves-effect form-control text-dark">
                                                    AC
                                                </a>
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" maxlength="4" autocomplete="off"
                                                    placeholder="Contoh : <?= date('Y') ?>"
                                                    value="<?= $this->session->flashdata('tahun_ac') ?>" name="tahun_ac">
                                            </div>
                                            <div class="col-lg-2">
                                                <a class="btn btn-light waves-effect form-control text-dark">
                                                    MS.Bna
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if (!$status_validasi) { ?>
                                <div class="card-footer">
                                    <div class="row justify-content-md-center">
                                        <div class="col-lg-4">
                                            <button type="submit" class="btn btn-info form-control" id="btnCek" type="button">
                                                Validasi Akta Cerai
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </form>
                        <?php
                    }
                    ?>
                </div>

                <?php if ($status_validasi) {
                    ?>
                    <div class="card bg-primary mini-stat position-relative">
                        <div class="card-body">
                            <?php
                            if ($status_validasi == "1") {
                                ?>
                                <p class="text-center">Nomor Perkara : <?= $nomor_perkara ?></p>
                                <p class="text-center">Nomor Akta Cerai : <?= $nomor_perkara ?></p>
                                <div class="row justify-content-md-center">
                                    <div class="col-lg-8">
                                        <table class="table table-bordered">
                                            <th colspan="2" class="text-center">DATA PERKARA</th>
                                            <tr>
                                                <td>#</td>
                                                <td>NAMA PIHAK</td>
                                            </tr>
                                            <tr>
                                                <td>PENGGUGAT</td>
                                                <td><?= $nama_pihak1 ?></td>
                                            </tr>
                                            <tr>
                                                <td>TERGUGAT</td>
                                                <td><?= $nama_pihak2 ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="alert alert-info bg-info text-white text-center" role="alert">
                                    <h5><strong>Mahkamah Syar'iyah Banda Aceh Menyatakan Akta Cerai Ini Sah</strong></h5>
                                </div>

                                <?php
                            }
                            ?>
                        </div>
                        <div class="card-footer text-center">
                            <a href="valid_ac" class="btn btn-warning waves-effect waves-light">
                                <h6>Cek Validasi Akta Cerai Lain</h6>
                            </a>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container-fluid -->

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

    <!-- Sweet-Alert  -->
    <script src="assets/vendor/sweetalert/sweetalert.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <?php
    $this->session->sess_destroy();
    ?>

</body>

</html>