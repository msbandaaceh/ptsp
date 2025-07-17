<!-- page wrapper start -->
<div class="wrapper">
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="page-title">Daftar Petugas Pelayanan</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Manajemen Petugas Layanan PTSP MS Banda Aceh</li>
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
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <div class="mb-3"><button class="btn btn-info"
                                    onclick="BukaModalPetugas('<?php echo base64_encode($this->encrypt->encode(-1)); ?>')"
                                    data-toggle="modal" data-target=".modal-petugas">Tambah</button></div>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Petugas</th>
                                        <th>Jabatan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $no = 1;
                                    foreach ($petugas as $user) { ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $user->nama; ?></td>
                                            <td><?= $user->jabatan; ?></td>
                                            <td><?php
                                            if ($user->aktif == '1') {
                                                echo '<span class="badge badge-pill badge-primary">Aktif</span>';
                                            } else {
                                                echo '<span class="badge badge-pill badge-danger">Tidak Aktif</span>';
                                            }
                                            ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button"
                                                        class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Aksi
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <button type="button" class="dropdown-item btn btn-warning"
                                                            data-toggle="modal" data-target=".modal-petugas"
                                                            onclick="BukaModalPetugas('<?php echo base64_encode($this->encrypt->encode($user->id)); ?>')"><i
                                                                class="mdi mdi-account-edit"></i> Ubah Data</button>
                                                        <button type="button" class="dropdown-item btn btn-danger"
                                                            id="hapus" data-toggle="modal"
                                                            data-id="<?= base64_encode($this->encrypt->encode($user->id)) ?>"
                                                            data-target=".modal-hapus"><i class="mdi mdi-delete"></i>
                                                            Hapus</button>
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

            <div class="modal fade modal-petugas" tabindex="-1" role="dialog" aria-labelledby="modalPetugas"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 id="title" class="modal-title mt-0"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="simpan_petugas" enctype="multipart/form-data">
                                <div class="alert alert-info text-center" role="alert">
                                    Informasi Petugas Layanan
                                </div>
                                <input type="hidden" id="id_" name="id" class="form-control" />
                                <div class="form-group">
                                    <label>Nama <code>*</code></label>
                                    <input type="text" id='nama_' name='nama' autocomplete="off" required
                                        class="form-control" placeholder="Nama Pengguna" />
                                </div>
                                <div class="form-group">
                                    <label>Jabatan <code>*</code></label>
                                    <input type="text" id='jabatan_' name='jabatan' autocomplete="off" required
                                        class="form-control" placeholder="Jabatan Pengguna" />
                                </div>
                                <div class="form-group">
                                    <label>Foto <code>*</code></label>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
                                            <img alt="user-avatar" height="180" width="120" id="uploadedAvatar" />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
                                            <label for="foto" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                <i class="mdi mdi-upload">Upload</i>
                                            </label>

                                            <p class="text-muted mb-0">Hanya boleh PNG. Besar Maksimal 5MB</p>
                                        </div>
                                        <input hidden type="file" id="foto" name="foto" class="account-file-input"
                                            accept="image/png" />
                                    </div>
                                </div>
                                <code>* Wajib diisi</code>
                                <div class="form-group">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success waves-effect waves-light">
                                            Simpan
                                        </button>
                                        <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                            Reset
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <div class="modal fade modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modalPengguna"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0">Hapus Pengguna</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="hapus_user">
                                <div class="alert alert-danger bg-danger text-white text-center" role="alert">
                                    <h6>Peringatan !</h6>
                                </div>
                                <div class="form-group">
                                    <h5>Anda Yakin Akan Menghapus Pengguna Ini ?</h5>
                                </div>
                                <input type="hidden" id="id_hapus" name="id" class="form-control" />
                                <div class="form-group">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-danger waves-effect waves-light">
                                            Hapus
                                        </button>
                                        <button type="button" class="btn btn-secondary waves-effect m-l-5"
                                            data-dismiss="modal">
                                            Batal
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
<script src="assets/vendor/datatables/dataTables.responsive.min.js"></script>

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
        $('#datatable').DataTable({ "responsive": true, "lengthChange": true, "autoWidth": true });
        $('form').parsley();
    });

    $(document).on("click", "#hapus", function () {
        var id = $(this).data('id');
        $('#id_hapus').val(id);
    })

    // Fungsi untuk menampilkan preview gambar
    function previewImage(input, imgElementId) {
        const file = input.files[0];
        const preview = document.getElementById(imgElementId);

        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                preview.src = event.target.result; // Set src ke hasil pembacaan
            }
            reader.readAsDataURL(file); // Baca file sebagai URL data
        }
    }

    // Event listener untuk foto pegawai
    document.getElementById('foto').addEventListener('change', function () {
        previewImage(this, 'uploadedAvatar'); // Menampilkan preview pada gambar pegawai
    });
</script>
</body>

</html>