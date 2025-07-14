<!-- page wrapper start -->
<div class="wrapper">
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="page-title">Permohonan Pengguna E-Court</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Daftar Permohonan Pengguna E-Court</li>
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
                                <h6 class="text-uppercase verti-label text-white-50">E-Court</h6>
                                <div class="text-white">
                                    <h6 class="text-uppercase mt-0 text-white-50">Seluruh Permohonan</h6>
                                    <h3 class="mb-3 mt-0"><?= $allEcourt ?> Permohonan</h3>
                                    <div class="">
                                        <span class="ml-2">Jumlah Seluruh Permohonan E-Court</span>
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
                    <div class="card bg-success mini-stat position-relative">
                        <div class="card-body">
                            <div class="mini-stat-desc">
                                <h6 class="text-uppercase verti-label text-white-50">E-Court</h6>
                                <div class="text-white">
                                    <h6 class="text-uppercase mt-0 text-white-50">Permohonan Selesai</h6>
                                    <h3 class="mb-3 mt-0"><?= $EcourtDone ?> Permohonan</h3>
                                    <div class="">
                                        <span class="ml-2">Jumlah Permohonan E-Court Selesai</span>
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
                    <div class="card bg-warning mini-stat position-relative">
                        <div class="card-body">
                            <div class="mini-stat-desc">
                                <h6 class="text-uppercase verti-label text-white-50">E-Court</h6>
                                <div class="text-white">
                                    <h6 class="text-uppercase mt-0 text-white-50">Permohonan Menunggu</h6>
                                    <h3 class="mb-3 mt-0"><?= $EcourtWait ?> Permohonan</h3>
                                    <div class="">
                                        <span class="ml-2">Jumlah Permohonan E-Court Menunggu Diproses</span>
                                    </div>
                                </div>
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-buffer display-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pemohon</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $no = 1;
                                    foreach ($ecourt as $item) { ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $item->nama; ?></td>
                                            <td class="text-center"><?php
                                            if ($item->status > 0) {
                                                echo '<span class="badge badge-pill badge-primary">Selesai</span>';
                                            } else {
                                                echo '<span class="badge badge-pill badge-warning">Menunggu</span>';
                                            }
                                            ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button"
                                                        class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Aksi
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <?php if ($item->status > 0) {
                                                            ?>
                                                            <button type="button" class="dropdown-item btn btn-warning"
                                                                data-toggle="modal" data-target=".modal-proses"
                                                                onclick="BukaModalEcourt('<?= base64_encode($this->encrypt->encode($item->id)); ?>')"><i
                                                                    class="mdi mdi-eye"></i> Lihat Data</button>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <button type="button" class="dropdown-item btn btn-warning"
                                                                data-toggle="modal" data-target=".modal-proses"
                                                                onclick="BukaModalProsesEcourt('<?= base64_encode($this->encrypt->encode($item->id)); ?>')"><i
                                                                    class="mdi mdi-bookmark-check"></i> Proses</button>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $no++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="modal fade modal-proses" tabindex="-1" role="dialog" aria-labelledby="modalPanjar"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 id="title" class="modal-title mt-0"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-info text-center" role="alert">
                                Informasi Pemohon
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6>Jenis Pihak</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <h6>:</h6>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6 id="jenisPihak_"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6>Nama Pihak</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <h6>:</h6>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6 id="nama_"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6>Tempat Lahir</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <h6>:</h6>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6 id="tmp_lahir_"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6>Tanggal Lahir</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <h6>:</h6>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6 id="tgl_lahir_"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6>NIK Pihak</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <h6>:</h6>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6 id="nik_"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6>Nama Bank</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <h6>:</h6>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6 id="bank_"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6>Nomor Rekening</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <h6>:</h6>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6 id="norek_"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6>Nama Pemilik Rekening</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <h6>:</h6>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6 id="namarek_"></h6>
                                </div>
                            </div><div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6>Nomor Telepon</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <h6>:</h6>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6 id="no_telp_"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6>Nomor Handphone</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <h6>:</h6>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6 id="no_hp_"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6>Email</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <h6>:</h6>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6 id="email_"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6>Alamat</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <h6>:</h6>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6 id="alamat_"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6>Jenis Kelamin</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <h6>:</h6>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6 id="jk_"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6>Agama</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <h6>:</h6>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6 id="agama_"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6>Pekerjaan</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <h6>:</h6>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6 id="pekerjaan_"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6>Berkebutuhan Khusus</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <h6>:</h6>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6 id="difabel_"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6>Status Perkawinan</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <h6>:</h6>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6 id="kawin_"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6>Pendidikan</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <h6>:</h6>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6 id="pendidikan_"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6>File</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <h6>:</h6>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                    <h6 id="ktp_"></h6>
                                </div>
                            </div>
                            <div class="alert alert-info text-center" role="alert">
                                Proses Permohonan
                            </div>
                            <div class="form-group">
                                <label>Status Permohonan <code>*</code></label>
                                <div id="status_">
                                </div>
                            </div>
                            <form method="POST" id="form_proses_ecourt" action="proses_ecourt">
                                <input type="hidden" id="jenis_" name="jenis" class="form-control" />
                                <input type="hidden" id="id_" name="id" class="form-control" />
                                <div style="display: none" id="proses">
                                    <div>
                                        <label>Password</label><code> *</code>
                                        <input type="text" id="password" class="form-control floating-label"
                                            name="password" autocomplete="off"
                                            placeholder="Masukkan Password Yang Diperoleh dari Website Ecourt">
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <div>
                                            <textarea name="ket_proses" id="ket_proses" class="form-control"
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: none" id="tidak_proses">
                                    <div class="form-group">
                                        <label>Keterangan</label><code> *</code>
                                        <div>
                                            <textarea name="ket" id="ket" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" id="notif">
                                    <div class="row">
                                        <div class="col-10 text-right">Kirim Notifikasi Kepada Pemohon?</div>
                                        <div class="col-2">
                                            <input type="checkbox" id="switch3" name="notif" switch="bool" checked="">
                                            <label for="switch3" data-on-label="Ya" data-off-label="Tidak"></label>
                                        </div>

                                    </div>
                                </div>

                                <code>* Wajib diisi</code>
                                <div class="form-group">
                                    <div class="text-center">
                                        <button type="submit" id="btnSimpan"
                                            class="btn btn-success waves-effect waves-light">
                                            Simpan
                                        </button>
                                        <button type="button" id="btnEdit" onclick="editProsesEcourt()"
                                            class="btn btn-warning waves-effect waves-light">
                                            Ubah Data
                                        </button>
                                        <button type="button" id="btnBatal" onclick="batalEditProsesEcourt()"
                                            class="btn btn-danger waves-effect waves-light">
                                            Batal
                                        </button>
                                        <button type="reset" id="btnReset" class="btn btn-secondary waves-effect m-l-5">
                                            Reset
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
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

<script src="assets/vendor/bootstrap-md-datetimepicker/js/moment-with-locales.min.js"></script>
<script src="assets/vendor/bootstrap-md-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<!-- Peity JS -->
<script src="assets/vendor/peity/jquery.peity.min.js"></script>
<!-- Sweet-Alert  -->
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script>

<script src="assets/vendor/raphael/raphael-min.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>
<script src="assets/js/parsley.js"></script>

<script>
    $(document).ready(function () {
        $('#datatable').DataTable();
        $('form').parsley();
    });
</script>
</body>

</html>