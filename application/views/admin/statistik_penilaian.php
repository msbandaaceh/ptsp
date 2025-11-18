<!-- page wrapper start -->
<style>
    .c3 text {
        fill: #ffffff !important;
        font-family: 'Arial', sans-serif;
    }

    .c3-tooltip {
        color: #000 !important;
        background-color: #ffffff !important;
        border: 1px solid #ccc;
    }

    .c3-tooltip th {
        color: #000 !important;
        background-color: #333 !important;
        font-weight: bold;
    }

    .c3-tooltip td {
        color: #000 !important;
    }
</style>
<div class="wrapper">
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="page-title">Statistik Penilaian Petugas Pelayanan</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Statistik Penilaian Petugas Layanan PTSP MS Banda Aceh</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page-title-box -->

    <div class="page-content-wrapper">
        <div class="container-fluid">
            <form action="statistik_penilaian" method="POST">
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
                    <h2 class="text-center">STATISTIK PENILAIAN PETUGAS LAYANAN PERIODE <?= $periode ?></h2>
                </div>
            </div>

            <!-- Statistik Umum -->
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card m-b-20 text-white bg-primary">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Total Responden</h4>
                            <h2 class="mb-0"><?= $total_responden ?></h2>
                            <p class="mb-0">Orang</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card m-b-20 text-white bg-success">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Rata-rata Keramahan</h4>
                            <h2 class="mb-0"><?= $total_keramahan ?></h2>
                            <p class="mb-0">dari 5.00</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card m-b-20 text-white bg-info">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Rata-rata Kepuasan</h4>
                            <h2 class="mb-0"><?= $total_kepuasan ?></h2>
                            <p class="mb-0">dari 5.00</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Distribusi Skor -->
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Distribusi Skor Keramahan</h4>
                            <div id="chart_distribusi_keramahan"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Distribusi Skor Kepuasan</h4>
                            <div id="chart_distribusi_kepuasan"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trend Bulanan -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Trend Penilaian Bulanan</h4>
                            <div id="chart_trend_bulanan"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Per Hari -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Statistik Per Hari dalam Seminggu</h4>
                            <div id="chart_statistik_hari"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Per Petugas -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Statistik Detail Per Petugas</h4>
                            <div class="table-responsive">
                                <table id="tabelStatistikPetugas" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NAMA PETUGAS</th>
                                            <th>RATA-RATA KERAMAHAN</th>
                                            <th>RATA-RATA KEPUASAN</th>
                                            <th>RATA-RATA TOTAL</th>
                                            <th>MIN KERAMAHAN</th>
                                            <th>MAX KERAMAHAN</th>
                                            <th>MIN KEPUASAN</th>
                                            <th>MAX KEPUASAN</th>
                                            <th>JUMLAH RESPONDEN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($statistik_petugas) {
                                            $no = 1;
                                            foreach ($statistik_petugas as $petugas) {
                                                ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $petugas->nama ?></td>
                                                    <td><?= $petugas->rata_keramahan ?> / 5.00</td>
                                                    <td><?= $petugas->rata_kepuasan ?> / 5.00</td>
                                                    <td><strong><?= $petugas->rata_total ?> / 5.00</strong></td>
                                                    <td><?= $petugas->min_keramahan ?></td>
                                                    <td><?= $petugas->max_keramahan ?></td>
                                                    <td><?= $petugas->min_kepuasan ?></td>
                                                    <td><?= $petugas->max_kepuasan ?></td>
                                                    <td><?= $petugas->jumlah_responden ?></td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="10" class="text-center">Tidak ada data</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
    // Chart Distribusi Skor Keramahan
    const distribusiKeramahan = ['Skor'];
    <?php
    // Inisialisasi array untuk semua skor 1-5
    $dist_keramahan = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
    foreach ($distribusi_keramahan as $dist) {
        $dist_keramahan[$dist->skor] = $dist->jumlah;
    }
    for ($i = 1; $i <= 5; $i++) {
        echo "distribusiKeramahan.push(" . $dist_keramahan[$i] . ");\n";
    }
    ?>

    const chartDistribusiKeramahan = c3.generate({
        bindto: '#chart_distribusi_keramahan',
        data: {
            columns: [distribusiKeramahan],
            type: 'bar'
        },
        bar: {
            width: {
                ratio: 0.6
            }
        },
        axis: {
            x: {
                type: 'category',
                categories: ['1', '2', '3', '4', '5']
            },
            y: {
                label: 'Jumlah Responden'
            }
        },
        color: {
            pattern: ['#1f77b4']
        }
    });

    // Chart Distribusi Skor Kepuasan
    const distribusiKepuasan = ['Skor'];
    <?php
    $dist_kepuasan = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
    foreach ($distribusi_kepuasan as $dist) {
        $dist_kepuasan[$dist->skor] = $dist->jumlah;
    }
    for ($i = 1; $i <= 5; $i++) {
        echo "distribusiKepuasan.push(" . $dist_kepuasan[$i] . ");\n";
    }
    ?>

    const chartDistribusiKepuasan = c3.generate({
        bindto: '#chart_distribusi_kepuasan',
        data: {
            columns: [distribusiKepuasan],
            type: 'bar'
        },
        bar: {
            width: {
                ratio: 0.6
            }
        },
        axis: {
            x: {
                type: 'category',
                categories: ['1', '2', '3', '4', '5']
            },
            y: {
                label: 'Jumlah Responden'
            }
        },
        color: {
            pattern: ['#ff7f0e']
        }
    });

    // Chart Trend Bulanan
    const labelsTrend = ['x'];
    const keramahanTrend = ['Keramahan'];
    const kepuasanTrend = ['Kepuasan'];

    <?php
    $namaBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    $trend_data = [];
    foreach ($trend_bulanan as $trend) {
        $trend_data[$trend->bulan] = $trend;
    }
    // Loop untuk semua bulan yang ada data
    for ($i = 1; $i <= 12; $i++) {
        if (isset($trend_data[$i])) {
            echo "labelsTrend.push('" . $namaBulan[$i - 1] . "');\n";
            echo "keramahanTrend.push(" . $trend_data[$i]->rata_keramahan . ");\n";
            echo "kepuasanTrend.push(" . $trend_data[$i]->rata_kepuasan . ");\n";
        }
    }
    ?>

    const chartTrendBulanan = c3.generate({
        bindto: '#chart_trend_bulanan',
        data: {
            x: 'x',
            columns: [
                labelsTrend,
                keramahanTrend,
                kepuasanTrend
            ],
            types: {
                'Keramahan': 'line',
                'Kepuasan': 'line'
            }
        },
        axis: {
            x: {
                type: 'category'
            },
            y: {
                label: 'Rata-rata Skor',
                min: 0,
                max: 5
            }
        },
        color: {
            pattern: ['#1f77b4', '#ff7f0e']
        }
    });

    // Chart Statistik Per Hari
    const labelsHari = ['x'];
    const keramahanHari = ['Keramahan'];
    const kepuasanHari = ['Kepuasan'];

    <?php
    $namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    $hari_data = [];
    foreach ($statistik_hari as $hari) {
        $hari_data[$hari->hari] = $hari;
    }
    for ($i = 1; $i <= 7; $i++) {
        if (isset($hari_data[$i])) {
            echo "labelsHari.push('" . $namaHari[$i - 1] . "');\n";
            echo "keramahanHari.push(" . $hari_data[$i]->rata_keramahan . ");\n";
            echo "kepuasanHari.push(" . $hari_data[$i]->rata_kepuasan . ");\n";
        }
    }
    ?>

    const chartStatistikHari = c3.generate({
        bindto: '#chart_statistik_hari',
        data: {
            x: 'x',
            columns: [
                labelsHari,
                keramahanHari,
                kepuasanHari
            ],
            types: {
                'Keramahan': 'bar',
                'Kepuasan': 'bar'
            }
        },
        bar: {
            width: {
                ratio: 0.6
            }
        },
        axis: {
            x: {
                type: 'category'
            },
            y: {
                label: 'Rata-rata Skor',
                min: 0,
                max: 5
            }
        },
        color: {
            pattern: ['#1f77b4', '#ff7f0e']
        }
    });

    // DataTables
    $(document).ready(function () {
        $('#tabelStatistikPetugas').DataTable({
            responsive: true,
            order: [[4, 'desc']] // Order by rata-rata total DESC
        });
    });

    // Fungsi untuk ganti jenis periode sudah ada di app.js, tidak perlu didefinisikan ulang

    // Datepicker untuk tanggal
    $(document).ready(function () {
        $('#tgl_awal').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD',
            clearButton: true,
            weekStart: 1,
            time: false
        }).on('change', function (e, date) {
            $('#tgl_awal_kirim').val(date.format('YYYY-MM-DD'));
        });

        $('#tgl_akhir').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD',
            clearButton: true,
            weekStart: 1,
            time: false
        }).on('change', function (e, date) {
            $('#tgl_akhir_kirim').val(date.format('YYYY-MM-DD'));
        });
    });
</script>
</body>

</html>

