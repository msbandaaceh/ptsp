<!-- page wrapper start -->
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
            <div class="row">
                <div class="col-6">
                    <div class="card m-b-20">
                        <div class="card-body">
                            COMING SOON
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card m-b-20">
                        <div class="card-body">
                            COMING SOON
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

<!-- Peity JS -->
<script src="assets/vendor/peity/jquery.peity.min.js"></script>
<!-- Sweet-Alert  -->
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script>

<script src="assets/vendor/raphael/raphael-min.js"></script>
<script src="assets/plugins/c3/c3.min.js"></script>

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