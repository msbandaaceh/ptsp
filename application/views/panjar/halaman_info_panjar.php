<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>PTSP - Sistem Permohonan Transfer Sisa Panjar</title>
    <meta content="Informasi AKta Cerai" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="assets/img/logo/logo-ms-bna.webp">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">

    <!-- Sweet Alert -->
    <link href="assets/vendor/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

    <!-- Table css -->
    <link href="assets/vendor/RWD-Table-Patterns/dist/css/rwd-table.min.css" rel="stylesheet" type="text/css"
        media="screen">
</head>

<body>

    <!-- Background -->
    <div class="panjar-pages"></div>

    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main">
            <div class="container-fluid">

                <!-- Logo container-->
                <div class="logo">
                    <a href="<?= base_url() ?>" class="logo">
                        <div class="text-white">
                            <img src="assets/img/logo/logo-ms-bna.webp" alt="" class="logo-small">
                            <img src="assets/img/logo/logo-panjar.webp" alt="" class="logo-large">
                        </div>
                    </a>
                </div>
                <!-- End Logo container-->

                <?php if (!$status_info) { ?>
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
                <?php } ?>
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
                                <a href="panjar"><i class="mdi mdi-home"></i>Beranda</a>
                            </li>

                            <li class="has-submenu">
                                <a href="info_panjar"><i class="mdi mdi-buffer"></i>Permohonan Pengembalian Sisa Panjar</a>
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
                            <p class="text-center">LAYANAN PERMOHONAN TRANSFER SISA PANJAR</p>
                        </h4>
                    </div>
                    <?php if (!$status_info) {
                        ?>
                        <div class="card-body">
                            <h4 class="text-center font-18">Masukkan Nomor dan Tahun Perkara Anda</h4>
                            <form method="POST" action="cari_panjar">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                        <div class="row mb-3">
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" autocomplete="off"
                                                    placeholder="Contoh : 10" maxlength="5" id="no_perkara"
                                                    name="no_perkara" value="<?= $this->session->flashdata('nomor') ?>">
                                            </div>
                                            <div class="col-lg-2">
                                                <select class="form-control" name="jenis">
                                                    <option value="G">Pdt.G</option>
                                                    <option value="P">Pdt.P</option>
                                                </select>
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
                                        <?php if (!$status_info) { ?>
                                            <div class="row justify-content-center">
                                                <div class="col-lg-4">
                                                    <button type="submit" class="btn btn-info form-control" id="btnCek"
                                                        type="button">
                                                        Cek
                                                    </button>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <?php if ($status_info) {
                    ?>
                    <div id="info_panjar" class="card bg-primary mini-stat position-relative">
                        <div class="card-body">
                            <?php
                            if ($status_info == "1") {
                                ?>
                                <h3 class="text-center"> Perkara <?= $jenis_perkara ?></h3>
                                <p class="text-center">Nomor Perkara : <?= $nomor_perkara ?></p>
                                <div class="row justify-content-center">
                                    <?php
                                    $psp = 0;
                                    $sisa = 0;
                                    $debet = 0;
                                    $kredit = 0;
                                    $prodeo = 0;
                                    $count = count($biaya_perkara);
                                    $repeat = false;
                                    $tahapan = 0;
                                    $stop = false;
                                    $i = 0;
                                    $putus = 0;
                                    $sisa_psp = 0;
                                    foreach ($biaya_perkara as $row) {
                                        if ($tahapan == $row->tahapan_id) {
                                            $stop = false;
                                        } else {
                                            if ($tahapan != 0) {
                                                echo "<tr>";
                                                echo "<th>Total</td>";
                                                echo "<th>Rp. " . number_format($debet, 0, ',', '.') . "</th>";
                                                echo "<th>Rp. " . number_format($kredit, 0, ',', '.') . "</th>";
                                                echo "<th>Rp. " . number_format($sisa, 0, ',', '.') . "</th>";
                                                echo "<th></th>";
                                                echo "</tr>";
                                                echo "</table>";
                                            }
                                        }

                                        if ($row->uraian == 'Pengembalian Sisa Panjar') {
                                            $psp = 1;
                                        }

                                        if ($row->uraian == 'Meterai') {
                                            $putus = 1;
                                        }

                                        if ($tahapan == 0 or $tahapan != $row->tahapan_id) {
                                            $tahapan = $row->tahapan_id;
                                            $repeat = true;
                                            $sisa = 0;
                                            $debet = 0;
                                            $kredit = 0;
                                        }

                                        if ($repeat) {
                                            if ($tahapan != 10) {
                                                echo "<div style='padding-top:20px;'></div>";
                                            }
                                            if ($tahapan == 10) {
                                                $tahapannama = " TINGKAT PERTAMA";
                                            } elseif ($tahapan == 20) {
                                                $tahapannama = " TINGKAT BANDING";
                                            } elseif ($tahapan == 30) {
                                                $tahapannama = " TINGKAT KASASI";
                                            } elseif ($tahapan == 40) {
                                                $tahapannama = " PENINJAUAN KEMBALI";
                                            } elseif ($tahapan == 50) {
                                                $tahapannama = " EKSEKUSI";
                                            }
                                            ?>

                                            <?php
                                            echo "<div class=\"col-lg-10\">";
                                            echo "<div class=\"table-responsive b-0\" data-pattern=\"priority-columns\">";
                                            echo "<table class=\"table table-bordered\">";
                                            echo "<th colspan=\"7\" class=\"text-center\">DATA BIAYA PERKARA</th>";
                                            echo "<tr>";
                                            echo "<td width='5%' class=\"text-center\" rowspan=\"2\">No</td>";
                                            echo "<td width='15%' class=\"text-center\" rowspan=\"2\">Tanggal Transaksi</td>";
                                            echo "<td width='35%' class=\"text-center\" rowspan=\"2\">Uraian</td>";
                                            echo "<td width='45%' class=\"text-center\" colspan=\"3\">Nominal</td>";
                                            echo "<td width='15%' class=\"text-center\" rowspan=\"2\">Keterangan</td>";
                                            echo "</tr>";

                                            echo "<tr>";
                                            echo "<td width='15%' bgcolor=\"#5FB85C\" style=\"text-align: center;border-left: 1px solid white;\" class=\"info\"><font color=\"#fff\">Pemasukan</td>";
                                            echo "<td width='15%' bgcolor=\"#5FB85C\" style=\"text-align: center;\" class=\"info\"><font color=\"#fff\">Pengeluaran</td>";
                                            echo "<td width='15%' bgcolor=\"#5FB85C\" style=\"text-align: center;\" class=\"info\"><font color=\"#fff\">Sisa</td>";
                                            echo "</tr>";
                                            $repeat = false;
                                            $stop = false;
                                        }

                                        if ($row->jenis_transaksi == 1) {
                                            $sisa = $sisa + $row->jumlah;
                                            $debet = $debet + $row->jumlah;
                                        } elseif ($row->jenis_transaksi == -1) {
                                            $sisa = $sisa - $row->jumlah;
                                            $kredit = $kredit + $row->jumlah;
                                        }

                                        if ($row->uraian == 'Panjar Biaya Perkara' && $debet == '0') {
                                            $prodeo = 1;
                                        }

                                        echo "<tr>";
                                        echo "<td>" . ($i + 1) . "</td>";
                                        echo "<td>" . $this->tanggalhelper->convertDayDate($row->tanggal_transaksi) . "</td>";
                                        echo "<td>" . $row->uraian . "</td>";
                                        if ($row->jenis_transaksi == 1) {
                                            echo "<td>Rp. " . number_format($row->jumlah, 0, ',', '.') . "</td>";
                                            echo "<td></td>";
                                            echo "<td>Rp. " . number_format($sisa, 0, ',', '.') . "</td>";
                                        } elseif ($row->jenis_transaksi == -1) {
                                            echo "<td></td>";
                                            echo "<td>Rp. " . number_format($row->jumlah, 0, ',', '.') . "</td>";
                                            echo "<td>Rp. " . number_format($sisa, 0, ',', '.') . "</td>";
                                        }
                                        echo "<td>" . $row->keterangan . "</td>";
                                        echo "</tr>";
                                        $i++;
                                        if (($i == $count or $stop == true)) {
                                            echo "<tr>";
                                            echo "<th bgcolor=\"#5FB85C\" colspan=\"3\" style=\"text-align: center;\"><font color=\"#fff\">Total</td>";
                                            echo "<th bgcolor=\"#5FB85C\" style=\"text-align: right;\" ><font color=\"#fff\">Rp. " . number_format($debet, 0, ',', '.') . "</td>";
                                            echo "<th bgcolor=\"#5FB85C\" style=\"text-align: right;\"><font color=\"#fff\">Rp. " . number_format($kredit, 0, ',', '.') . "</td>";
                                            echo "<th bgcolor=\"#5FB85C\" style=\"text-align: right;\"><font color=\"#fff\">Rp. " . number_format($sisa, 0, ',', '.') . "</td>";
                                            echo "<th bgcolor=\"#5FB85C\" style=\"text-align: right;\"></td>";
                                            echo "</tr>";
                                            echo "</table>";
                                            echo "</div>";
                                            echo "</div>";

                                            if ($sisa == 0) {
                                                $sisa_psp = 1;
                                            }

                                            $repeat = false;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <?php
                            if ($prodeo == '1') {
                                ?>
                                <div class="alert alert-info bg-info text-white text-center ml-4 mr-4" role="alert">
                                    <h5>Tidak Ada Biaya Perkara. Perkara ini adalah perkara Prodeo</h5>
                                </div>
                                <?php
                            } else {
                                if ($putus == '1') {
                                    if ($psp == '1') {
                                        ?>
                                        <div class="alert alert-info bg-info text-white text-center ml-4 mr-4" role="alert">
                                            <h5>Data Biaya Perkara berhasil Ditemukan. Sisa Panjar Perkara Anda Sudah Diambil</h5>
                                        </div>
                                        <?php
                                    } else {
                                        if ($sisa_psp == '1') {
                                            ?>
                                            <div class="alert alert-info bg-info text-white text-center ml-4 mr-4" role="alert">
                                                <h5>Data Biaya Perkara berhasil Ditemukan. Tidak Ada Sisa Panjar Perkara</h5>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="alert alert-info bg-info text-white text-center ml-4 mr-4" role="alert">
                                                <h5><strong>Selamat!</strong> Data Biaya Perkara berhasil Ditemukan.</h5>
                                            </div>

                                            <div class="row justify-content-center mb-3 ml-4 mr-4">
                                                <div class="col-lg-8">
                                                    <h5 class="card-text text-white text-center">Anda belum ambil Sisa Panjar? Ingin ambil
                                                        Sisa Panjar tanpa datang ke Pengadilan? Jangan khawatir! Kami akan fasilitasi anda
                                                        untuk ambil Sisa Panjar melalui transfer Bank. Silakan isi formulir
                                                        permohonan melalui link di bawah ini.</h5>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center mb-3">
                                                <div class="col-md-6 text-center">
                                                    <a class="btn btn-info waves-effect waves-light" onclick="TampilRequestPanjar()">
                                                        <h6>Buat Permohonan</h6>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <div class="alert alert-info bg-info text-white text-center ml-4 mr-4" role="alert">
                                        <h5>Sisa Panjar Perkara Anda Belum Bisa Diambil karena Perkara Masih Berjalan</h5>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            <?php
                            } ?>
                    </div>

                    <div id="form_panjar" style="display: none;" class="card bg-primary mini-stat position-relative">
                        <div class="card-body">
                            <form method="POST" action="simpan_req_panjar">
                                <input type="hidden" name="id" value="<?= $id_perkara ?>" class="form-control" />
                                <div class="form-group">
                                    <label>Nomor Perkara<code> *</code></label>
                                    <input type="text" value="<?= $nomor_perkara ?>" name="no_perkara" class="form-control"
                                        readonly />
                                </div>
                                <div class="form-group">
                                    <label>Nomor Rekening BSI<code> *</code></label>
                                    <div>
                                        <input data-parsley-type="digits" type="text" name="no_rek"
                                            data-parsley-maxlength="15" class="form-control" required
                                            placeholder="Masukkan Nomor Rekening BSI Anda" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nama Rekening<code> *</code></label>
                                    <input type="text" class="form-control" name="nama_rek" required
                                        placeholder="Nama Sesuai Rekening" />
                                </div>
                                <div class="form-group">
                                    <label>Nomor Handphone<code> *</code></label>
                                    <div>
                                        <input data-parsley-type="digits" data-parsley-maxlength="15" name="nohp"
                                            type="text" class="form-control" required
                                            placeholder="Masukkan Nomor Handphone (Ex: 08220000000)" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="alert alert-danger" role="alert">
                                        <strong>* Wajib Diisi</strong>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="card bg-warning mini-stat position-relative">
                                        <div class="card-body">
                                            <h6>Dengan menekan tombol Kirim, anda menyetujui Syarat dan Ketentuan berikut :
                                            </h6>
                                            <ul>
                                                <li>E-Panjar dapat dilakukan jika Sisa Panjar min Rp10.000</li>
                                                <li>Permohonan Transfer Sisa Panjar Perkara hanya menggunakan rekening BSI
                                                    (Bank Syariah Indonesia)</li>
                                                <li>Notifikasi akan dikirim ke nomor yang anda masukkan di formulir apabila
                                                    sisa panjar telah ditransfer</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success waves-effect waves-light">
                                            Kirim
                                        </button>
                                        <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                            Reset
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="info_panjar" class="btn btn-warning waves-effect waves-light">
                            <h6>Cek Perkara Lain</h6>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
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

    <script>
        function TampilRequestPanjar() {
            $('#info_panjar').hide();
            $('#form_panjar').show();
        }
    </script>

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/waves.min.js"></script>

    <script src="assets/vendor/jquery-sparkline/jquery.sparkline.min.js"></script>

    <!-- Sweet-Alert  -->
    <script src="assets/vendor/sweetalert/sweetalert.min.js"></script>

    <!-- Responsive-table-->
    <script src="assets/vendor/RWD-Table-Patterns/dist/js/rwd-table.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <script src="assets/js/parsley.js"></script>

    <script>
        $(document).ready(function () {
            $('form').parsley();
        });
    </script>

    <?php
    $this->session->sess_destroy();
    ?>

</body>

</html>