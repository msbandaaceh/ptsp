<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>PTSP - Dashboard Admin PTSP Online</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="assets/img/logo/logo-ms-bna.webp">

    <link rel="stylesheet" href="assets/vendor/morris/morris.css">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">

    <!-- Sweet Alert -->
    <link href="assets/vendor/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

    <!-- DataTables -->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/vendor/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <link href="assets/vendor/bootstrap-md-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
</head>

<body>

    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main">
            <div class="container-fluid">

                <!-- Logo container-->
                <div class="logo">

                    <a href="<?= base_url() ?>" class="logo">
                        <div class="text-white">
                            <img src="assets/img/logo/logo-ms-bna.webp" alt="" class="logo-small">
                            <img src="assets/img/logo/logo-ms-bna.webp" alt="" class="logo-large">
                            PTSP ONLINE - DASHBOARD ADMIN
                        </div>
                    </a>

                </div>

                <!-- End Logo container-->


                <div class="menu-extras topbar-custom">
                    <ul class="navbar-right d-flex list-inline float-right mb-0">
                        <li class="dropdown notification-list">
                            <div class="dropdown notification-list">
                                <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user waves-light"
                                    data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                    aria-expanded="false">
                                    <img src="assets/img/logo/logo-ms-bna.webp" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5"></i>
                                        Profil</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="keluar"><i
                                            class="mdi mdi-power text-danger"></i> Logout</a>
                                </div>
                            </div>
                        </li>

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
                <!-- end menu-extras -->

                <div class="clearfix"></div>

            </div> <!-- end container -->
        </div>
        <!-- end topbar-main -->

        <!-- MENU Start -->
        <div class="navbar-custom">
            <div class="container-fluid">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
                        <li class="has-submenu">
                            <a href="admin"><i class="mdi mdi-home"></i>Dashboard</a>
                        </li>
                        <?php if ($this->session->userdata('role') != '0') {
                            if (in_array($this->session->userdata('role'), ['1', '2'])) { ?>
                                <li class="has-submenu">
                                    <a href="val_produk"><i class="mdi mdi-buffer"></i>Produk Pengadilan</a>
                                </li>
                            <?php }
                            if (in_array($this->session->userdata('role'), ['1', '3'])) { ?>
                                <li class="has-submenu">
                                    <a href="val_psp"><i class="mdi mdi-black-mesa"></i>Sisa Panjar</a>
                                </li>
                            <?php }
                            if (in_array($this->session->userdata('role'), ['1', '4'])) { ?>
                                <li class="has-submenu">
                                    <a href="val_ecourt"><i class="mdi mdi-account-card-details"></i>Pendaftaran User Ecourt</a>
                                </li>
                            <?php }
                        } else { ?>
                            <li class="has-submenu">
                                <a href="manage_users"><i class="mdi mdi-clipboard"></i>Manajemen User</a>
                            </li>
                        <?php } ?>
                    </ul>
                    <!-- End navigation menu -->
                </div> <!-- end #navigation -->
            </div> <!-- end container -->
        </div> <!-- end navbar-custom -->
    </header>
    <!-- End Navigation Bar-->