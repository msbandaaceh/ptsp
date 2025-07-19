<!-- page wrapper start -->
<style>
    .c3 text {
        fill: #ffffff !important;
        /* Ganti dengan warna yang kamu inginkan */
        font-family: 'Arial', sans-serif;
    }

    .c3-tooltip {
        color: #000 !important;
        /* Warna teks tooltip */
        background-color: #ffffff !important;
        /* Warna latar belakang tooltip */
        border: 1px solid #ccc;
    }

    .c3-tooltip th {
        color: #000 !important;
        /* Warna judul (nama petugas) */
        background-color: #333 !important;
        /* Warna latar judul */
        font-weight: bold;
    }

    .c3-tooltip td {
        color: #000 !important;
        /* Warna label dan nilai */
    }
</style>
<div class="wrapper">
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="page-title">Daftar Penilaian Petugas Pelayanan</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Daftar Penilaian Petugas Layanan PTSP MS Banda Aceh</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end container-fluid -->

    </div>
    <!-- page-title-box -->

    <div class="page-content-wrapper">
        <div class="container-fluid">
            <form action="nilai_petugas" method="POST">
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-20">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Jenis Periode</label>
                                            <select class="custom-select" id="jenis_periode" name="jenis_periode"
                                                onchange="gantiJenisPeriode()">
                                                <option value="1">Triwulan</option>
                                                <option value="2">Periode Tanggal</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group" id="tahun_periode">
                                            <label>Tahun Periode</label>
                                            <select class="custom-select" name="tahun_periode">
                                                <?php foreach ($tahun_periode as $tahun) { ?>
                                                    <option value="<?= $tahun->tahun ?>"><?= $tahun->tahun ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group" id="periode_tgl_awal" style="display: none">
                                            <label>Tanggal Awal</label>
                                            <div>
                                                <input type="text" class="form-control floating-label"
                                                    placeholder="Tanggal Awal" id="tgl_awal">
                                                <input type="hidden" id="tgl_awal_kirim" name="tgl_awal">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group" id="triwulan">
                                            <label>Periode Triwulan</label>
                                            <select class="custom-select" name="triwulan">
                                                <option value="1">Triwulan I</option>
                                                <option value="2">Triwulan II</option>
                                                <option value="3">Triwulan III</option>
                                                <option value="4">Triwulan IV</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="periode_tgl_akhir" style="display: none">
                                            <label>Tanggal Akhir</label>
                                            <div>
                                                <input type="text" class="form-control floating-label"
                                                    placeholder="Tanggal Akhir" id="tgl_akhir">
                                                <input type="hidden" id="tgl_akhir_kirim" name="tgl_akhir">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit"
                                            class="btn btn-block btn-outline-primary waves-effect waves-light">Filter
                                            Periode</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-12">
                    <h2 class="text-center">HASIL PENILAIAN PETUGAS LAYANAN PERIODE <?= $periode ?></h2>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="card m-b-20 text-white bg-primary">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Rekapitulasi Seluruh Penilaian Petugas Layanan
                            </h4>
                            <?php if ($petugas) { ?>
                                <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                                    <li class="list-inline-item">
                                        <h5 class="mb-0"><?= $total_responden ?></h5>
                                        <p>Responden</p>
                                    </li>
                                    <li class="list-inline-item">
                                        <h5 class="mb-0"><?= $total_keramahan ?> / 5.00</h5>
                                        <p>Tingkat Keramahan</p>
                                    </li>
                                    <li class="list-inline-item">
                                        <h5 class="mb-0"><?= $total_kepuasan ?> / 5.00</h5>
                                        <p>Tingkat Kepuasan</p>
                                    </li>
                                </ul>

                                <div id="chart_petugas"></div>
                            <?php } else { ?>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                        <h4><em>Data Penilaian Tidak Ditemukan</em></h4>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="card m-b-20 text-white bg-primary">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Petugas Layanan Terbaik</h4>
                            <div class="row">
                                <?php
                                if ($petugas_terbaik) {
                                    foreach ($petugas_terbaik as $best) {
                                        ?>
                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                            <div class="card m-b-20 text-white bg-primary">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <img class="rounded-circle shadow" alt="200x200" width="120"
                                                                src="assets/foto/petugas/<?= $best->foto ?>"
                                                                title="Skor Akhir <?= $best->total_skor ?>"
                                                                data-holder-rendered="true">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <?= $best->nama ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            Keramahan : <?= $best->rata_keramahan ?> / 5.00
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            Kepuasan : <?= $best->rata_kepuasan ?> / 5.00
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                        <h4><em>Data Penilaian Tidak Ditemukan</em></h4>
                                    </div>
                                    <?php
                                } ?>
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
<!-- Required datatable js -->
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="assets/vendor/datatables/dataTables.responsive.min.js"></script>
<script src="assets/vendor/bootstrap-md-datetimepicker/js/moment-with-locales.min.js"></script>
<script src="assets/vendor/bootstrap-md-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<!-- Peity JS -->
<script src="assets/vendor/peity/jquery.peity.min.js"></script>
<!-- Sweet-Alert  -->
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script>

<script src="assets/vendor/raphael/raphael-min.js"></script>
<script src="assets/plugins/d3/d3.min.js"></script>
<script src="assets/plugins/c3/c3.min.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>
<script src="assets/js/parsley.js"></script>

<script>
    const labels = ['x'];
    const ramah = ['Tingkat Keramahan'];
    const puas = ['Tingkat Kepuasan'];

    <?php foreach ($petugas as $item): ?>
        labels.push('<?= $item->nama ?>');
        ramah.push(<?= $item->rata_keramahan ?>);
        puas.push(<?= $item->rata_kepuasan ?>);
    <?php endforeach; ?>

    const chart = c3.generate({
        bindto: '#chart_petugas',
        data: {
            x: 'x',
            columns: [
                labels,
                ramah,
                puas
            ],
            types: {
                'Tingkat Keramahan': 'bar',
                'Tingkat Kepuasan': 'bar'
            }
        },
        bar: {
            width: {
                ratio: 0.8 // default 0.6; tingkatkan jadi 0.8–1 untuk batang lebih tebal
            }
        },
        axis: {
            rotated: true,
            x: {
                type: 'category'
            },
            y: {
                label: 'Skor',
                min: 0,
                max: 5,
                padding: {
                    top: 0,
                    bottom: 0
                }
            }
        },
        color: {
            pattern: ['#1f77b4', '#ff7f0e'] // 💡 warna khusus: biru untuk keramahan, oranye untuk kepuasan
        }
    });
</script>
</body>

</html>