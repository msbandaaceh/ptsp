<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Monitoring Antrian Sidang - Mahkamah Syar'iyah Banda Aceh</title>
    <meta content="Informasi AKta Cerai" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="assets/img/logo/logo-ms-bna.webp">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

    <!-- Background -->
    <div class="account-pages"></div>

    <!-- Begin page -->
    <div class="wrapper container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="ex-page-content text-center">
                                <h3>Monitoring Antrian Sidang <?= $this->tanggalhelper->convertDayDate(date('Y-m-d')) ?>
                                    (<em>Antrian
                                        direfresh 1
                                        menit sekali, silakan refresh jika tidak ingin menunggu</em>)</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-12 mb-4">
                    <div class="card d-flex align-items-center justify-content-center" style="height: 100%;">
                        <h5 class="p-1">RUANG SIDANG KARTIKA</h5>
                        <div class="card-body">
                            <div class="ex-page-content text-center">
                                <h3 class="text-dark" id="sidang1"></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 mb-4">
                    <div class="card d-flex align-items-center justify-content-center" style="height: 100%;">
                        <h5 class="p-1">RUANG SIDANG CHANDRA</h5>
                        <div class="card-body">
                            <div class="ex-page-content text-center">
                                <h3 class="text-dark" id="sidang2"></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 mb-4">
                    <div class="card d-flex align-items-center justify-content-center" style="height: 100%;">
                        <h5 class="p-1">RUANG SIDANG TIRTA</h5>
                        <div class="card-body">
                            <div class="ex-page-content text-center">
                                <h3 class="text-dark" id="sidang3"></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/waves.min.js"></script>
    <script src="assets/js/antrian.js"></script>

</body>

</html>