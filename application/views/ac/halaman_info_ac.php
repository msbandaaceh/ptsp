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
        <?php if (!$status_info) { ?>
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
                            <p class="text-center">LAYANAN INFORMASI AKTA CERAI</p>
                        </h4>
                    </div>
                    <?php if (!$status_info) {
                        ?>
                        <form method="POST" action="cari_ac">
                            <div class="card-body">
                                <h4 class="text-center font-18">Masukkan Nomor dan Tahun Perkara Anda</h4>
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
                            </div>
                            <?php if (!$status_info) { ?>
                                <div class="card-footer">
                                    <div class="row justify-content-md-center">
                                        <div class="col-lg-4">
                                            <button type="submit" class="btn btn-info form-control" id="btnCek" type="button">
                                                Cek
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

                <?php if ($status_info) {
                    ?>
                    <div class="card bg-primary mini-stat position-relative">
                        <div class="card-body">
                            <?php
                            if ($status_info == "1") {
                                ?>
                                <h3 class="text-center"> Perkara <?= $jenis_perkara ?></h3>
                                <p class="text-center">Nomor Perkara : <?= $nomor_perkara ?></p>
                                <div class="row justify-content-md-center">
                                    <div class="col-lg-8">
                                        <table class="table table-bordered">
                                            <th colspan="3" class="text-center">DATA PERKARA</th>
                                            <tr>
                                                <td>#</td>
                                                <td>NAMA PIHAK</td>
                                                <td>STATUS AKTA CERAI</td>
                                            </tr>
                                            <tr>
                                                <td>PENGGUGAT</td>
                                                <td><?= $nama_pihak1 ?></td>
                                                <td>
                                                    <?php
                                                    if ($tgl_ambil_pihak1) {
                                                        $tgl1 = $this->tanggalhelper->convertDayDate($tgl_ambil_pihak1);
                                                        ?>
                                                        <span class="badge badge-success">SUDAH DIAMBIL</span> <?= $tgl1 ?>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span class="badge badge-warning">BELUM DIAMBIL</span>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>TERGUGAT</td>
                                                <td><?= $nama_pihak2 ?></td>
                                                <td>
                                                    <?php
                                                    if ($tgl_ambil_pihak2) {
                                                        $tgl2 = $this->tanggalhelper->convertDayDate($tgl_ambil_pihak2);
                                                        ?>
                                                        <span class="badge badge-success">SUDAH DIAMBIL</span> <?= $tgl2 ?>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span class="badge badge-warning">BELUM DIAMBIL</span>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="alert alert-info bg-info text-white text-center" role="alert">
                                    <h5>Akta Cerai sudah tersedia. </br>
                                        <strong>Perhatian !</strong> Kepada Tergugat diharapkan untuk
                                        menyelesaikan seluruh kewajiban-kewajibannya sebelum mengambil Akta Cerai. Terima Kasih
                                    </h5>
                                </div>

                                <?php if (!$tgl_ambil_pihak1 or !$tgl_ambil_pihak2) { ?>
                                    <!--
                                    <div class="row justify-content-md-center mb-3">
                                        <div class="col-lg-8">
                                            <h5 class="card-text text-white text-center">Anda belum ambil Akta Cerai? Ingin ambil
                                                Akta Cerai tanpa antri? Jangan khawatir! Kami akan fasilitasi anda untuk ambil Akta
                                                Cerai tanpa antrian. Silakan isi formulir permohonan melalui link di bawah ini.</h5>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6 text-center">
                                            <a href="req_produk" class="btn btn-info waves-effect waves-light">
                                                <h6>Buat Permohonan</h6>
                                            </a>
                                        </div>
                                    </div>
                                    -->
                                <?php } ?>
                                <?php
                            } elseif ($status_info == '2') {
                                ?>
                                <h3 class="text-center"> Perkara <?= $jenis_perkara ?></h3>
                                <p class="text-center">Nomor Perkara : <?= $nomor_perkara ?></p>
                                <div class="row justify-content-md-center">
                                    <div class="col-lg-8">
                                        <table class="table table-bordered">
                                            <th colspan="3" class="text-center">DATA PERKARA</th>
                                            <tr>
                                                <td>#</td>
                                                <td>NAMA PIHAK</td>
                                                <td>STATUS AKTA CERAI</td>
                                            </tr>
                                            <tr>
                                                <td>PENGGUGAT</td>
                                                <td><?= $nama_pihak1 ?></td>
                                                <td>
                                                    <?php
                                                    if ($tgl_ambil_pihak1) {
                                                        $tgl1 = $this->tanggalhelper->convertDayDate($tgl_ambil_pihak1);
                                                        ?>
                                                        <span class="badge badge-success">SUDAH DIAMBIL</span> <?= $tgl1 ?>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span class="badge badge-warning">BELUM DIAMBIL</span>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>TERGUGAT</td>
                                                <td><?= $nama_pihak2 ?></td>
                                                <td>
                                                    <?php
                                                    if ($tgl_ambil_pihak2) {
                                                        $tgl2 = $this->tanggalhelper->convertDayDate($tgl_ambil_pihak2);
                                                        ?>
                                                        <span class="badge badge-success">SUDAH DIAMBIL</span> <?= $tgl2 ?>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span class="badge badge-warning">BELUM DIAMBIL</span>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="alert alert-warning bg-warning text-white text-center" role="alert">
                                    <h5><strong>Mohon Maaf!</strong> Akta Cerai anda belum terbit.</h5>
                                </div>
                                <?php
                            } elseif ($status_info == '3') {
                                ?>
                                <h3 class="text-center"> Perkara <?= $jenis_perkara ?></h3>
                                <p class="text-center">Nomor Perkara : <?= $nomor_perkara ?></p>
                                <div class="alert alert-danger bg-danger text-white text-center" role="alert">
                                    <h5><strong>Mohon Maaf!</strong> Perkara selain Perceraian Tidak Menerbitkan Akta Cerai.
                                    </h5>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="card-footer text-center">
                            <a href="info_ac" class="btn btn-warning waves-effect waves-light">
                                <h6>Cek Perkara Lain</h6>
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