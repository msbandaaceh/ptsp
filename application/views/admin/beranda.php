<!-- page wrapper start -->
<div class="wrapper">
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Dashboard</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Selamat Datang di Dashboard Admin PTSP Online MS Banda Aceh
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end container-fluid -->

    </div>
    <!-- page-title-box -->

    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4 col-md-4 col-sm-12">
                    <div class="card bg-primary mini-stat position-relative">
                        <div class="card-body">
                            <div class="mini-stat-desc">
                                <h6 class="text-uppercase verti-label text-white-50">Produk</h6>
                                <div class="text-white">
                                    <h6 class="text-uppercase mt-0 text-white-50">Pengambilan Produk</h6>
                                    <h3 class="mb-3 mt-0">0 Permohonan</h3>
                                    <div class="">
                                        <span class="badge badge-light text-success"> 100% </span>
                                        <span class="ml-2">Progres Penyelesaian</span>
                                    </div>
                                </div>
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-buffer display-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-sm-12">
                    <div class="card bg-primary mini-stat position-relative">
                        <div class="card-body">
                            <div class="mini-stat-desc">
                                <h6 class="text-uppercase verti-label text-white-50">E-Panjar</h6>
                                <div class="text-white">
                                    <h6 class="text-uppercase mt-0 text-white-50">E-Panjar</h6>
                                    <h3 class="mb-3 mt-0"><?= $countPanjar ?> Permohonan</h3>
                                    <div>
                                        <?php
                                        if ($progresPanjar < 50) {
                                            ?>
                                            <span class="badge badge-light text-danger"> <?= $progresPanjar ?>% </span>
                                            <?php
                                        } elseif ($progresPanjar >= 50 && $progresPanjar < 100) {
                                            ?>
                                            <span class="badge badge-light text-warning"> <?= $progresPanjar ?>% </span>
                                            <?php
                                        } else {
                                            ?>
                                            <span class="badge badge-light text-success"> <?= $progresPanjar ?>% </span>
                                            <?php
                                        }
                                        ?>
                                        <span class="ml-2">Progres Penyelesaian</span>
                                    </div>
                                </div>
                                <div class="mini-stat-icon">
                                    <i class="fas fa-money-check display-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-sm-12">
                    <div class="card bg-primary mini-stat position-relative">
                        <div class="card-body">
                            <div class="mini-stat-desc">
                                <h6 class="text-uppercase verti-label text-white-50">E-Court</h6>
                                <div class="text-white">
                                    <h6 class="text-uppercase mt-0 text-white-50">User E-Court</h6>
                                    <h3 class="mb-3 mt-0"><?= $countEcourt ?> Permohonan</h3>
                                    <div>
                                        <?php
                                        if ($progresEcourt < 50) {
                                            ?>
                                            <span class="badge badge-light text-danger"> <?= $progresEcourt ?>% </span>
                                            <?php
                                        } elseif ($progresEcourt >= 50 && $progresEcourt < 100) {
                                            ?>
                                            <span class="badge badge-light text-warning"> <?= $progresEcourt ?>% </span>
                                            <?php
                                        } else {
                                            ?>
                                            <span class="badge badge-light text-success"> <?= $progresEcourt ?>% </span>
                                            <?php
                                        }
                                        ?>
                                        <span class="ml-2">Progres Penyelesaian</span>
                                    </div>
                                </div>
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-briefcase-check display-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end page content-->

</div>
<!-- page wrapper end -->
<!-- Footer -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                2025 © PTSP Online<span class="d-none d-sm-inline-block"> - Crafted with <i
                        class="mdi mdi-heart text-danger"></i> by IT MS Banda Aceh</span>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->

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

<!-- Peity JS -->
<script src="assets/vendor/peity/jquery.peity.min.js"></script>
<!-- Sweet-Alert  -->
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script>

<script src="assets/vendor/raphael/raphael-min.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>

</body>

</html>