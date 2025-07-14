/*
 Template Name: Agroxa - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesbrand
 Website: www.themesbrand.com
 File: Main js
 */

!function ($) {
    "use strict";

    var MainApp = function () { };

    MainApp.prototype.initNavbar = function () {

        $('.navbar-toggle').on('click', function (event) {
            $(this).toggleClass('open');
            $('#navigation').slideToggle(400);
        });

        if (document.getElementById('date-format')) {
            $('#date-format').bootstrapMaterialDatePicker({
                locale: 'id', // Setel lokal ke bahasa Indonesia
                format: 'dddd DD MMMM YYYY - HH:mm:ss', // Format lengkap
                time: true, // Aktifkan waktu
                date: true, // Aktifkan tanggal
            });

            // Event listener untuk mengisi input kedua (#date-sql) saat input pertama berubah
            $('#date-format').on('change', function () {
                // Ambil nilai dari input pertama
                let selectedDate = $(this).val();

                // Konversi nilai ke format SQL (YYYY-MM-DD HH:mm:ss)
                let sqlDate = moment(selectedDate, 'dddd DD MMMM YYYY - HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');

                // Isi nilai ke input kedua (#date-sql)
                $('#date-sql').val(sqlDate);
            });
        }

        $('.navigation-menu>li').slice(-2).addClass('last-elements');

        $('.navigation-menu li.has-submenu a[href="#"]').on('click', function (e) {
            if ($(window).width() < 992) {
                e.preventDefault();
                $(this).parent('li').toggleClass('open').find('.submenu:first').toggleClass('open');
            }
        });
    },
        MainApp.prototype.initScrollbar = function () {
            $('.slimscroll').slimScroll({
                height: 'auto',
                position: 'right',
                size: "7px",
                color: '#9ea5ab',
                wheelStep: 5,
                touchScrollStep: 50
            });
        }
    // === fo,llowing js will activate the menu in left side bar based on url ====
    MainApp.prototype.initMenuItem = function () {
        $(".navigation-menu a").each(function () {
            var pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) {
                $(this).parent().addClass("active"); // add active to li of the current link
                $(this).parent().parent().parent().addClass("active"); // add active class to an anchor
                $(this).parent().parent().parent().parent().parent().addClass("active"); // add active class to an anchor
            }
        });
    },
        MainApp.prototype.initComponents = function () {
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="popover"]').popover();
        },

        MainApp.prototype.initHeaderCharts = function () {
            $('#header-chart-1').sparkline([8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12], {
                type: 'bar',
                height: '35',
                barWidth: '5',
                barSpacing: '3',
                barColor: '#35a989'
            });
            $('#header-chart-2').sparkline([8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12], {
                type: 'bar',
                height: '35',
                barWidth: '5',
                barSpacing: '3',
                barColor: '#ffe082'
            });
        },

        MainApp.prototype.init = function () {
            this.initNavbar();
            this.initScrollbar();
            this.initMenuItem();
            this.initComponents();
            this.initHeaderCharts();
            Waves.init();
        },

        //init
        $.MainApp = new MainApp, $.MainApp.Constructor = MainApp
}(window.jQuery),

    //initializing
    function ($) {
        "use strict";
        $.MainApp.init();
    }(window.jQuery);

var result = config.result;
var pesan = config.pesan;
if (result != '-1') {
    if (result == '1') {
        sukses(pesan);
    } else if (result == '2') {
        peringatan(pesan);
    } else {
        gagal(pesan);
    }
}

function sukses(pesan) {
    swal({
        title: "<h4>Sukses<h4>",
        type: "success",
        text: "<h5>" + pesan + "</h5>",
        html: true
    });
}

function peringatan(pesan) {
    swal({
        title: "<h4>Oops...<h4>",
        type: "warning",
        text: "<h5>" + pesan + "</h5>",
        html: true
    });
}

function gagal(pesan) {
    swal({
        title: "<h4>Oops...<h4>",
        type: "error",
        text: "<h5>" + pesan + "</h5>",
        html: true
    });
}

function formatInput(input) {
    // Hapus semua karakter non-digit
    let angka = input.value.replace(/\D/g, '');

    $('#nominal_tf').val(angka);

    // Format angka dengan pemisah ribuan
    input.value = formatAngka(angka);
}

function formatAngka(angka) {
    // Format angka dengan pemisah ribuan menggunakan tanda titik (.)
    let formattedAngka = angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    // Tambahkan 'Rp' di depan angka yang sudah diformat
    return `Rp${formattedAngka}`;
}

function convertSQLToFullDate(sqlDate) {
    return moment(sqlDate, 'YYYY-MM-DD HH:mm:ss').format('dddd DD MMMM YYYY - HH:mm:ss');
}

function BukaModal(id) {
    $.post('modal_users', {
        id: id
    }, function (response) {
        var json = jQuery.parseJSON(response);
        if (json.st == 1) {
            $("#title").html("");
            $("#id_").val('');
            $("#nama_").val('');
            $('#hp_').val('');
            $('#role_').html('');
            $("#username_").val('');
            $("#pass_").val("");
            $("#passKonfirm_").val("");
            $("#status_").html("");

            $("#title").append(json.judul);
            $("#id_").val(json.id);
            $("#nama_").val(json.nama);
            $('#hp_').val(json.hp);
            $('#role_').append(json.role);
            $("#username_").val(json.username);
            $("#pass_").val(json.pass);
            $("#passKonfirm_").val(json.pass);
            $("#status_").append(json.status);

            if (json.id) {
                $("#username_").attr("readonly", true);
            }
        }
    });
}

function BukaModalProsesPanjar(id) {
    $('#form_proses_panjar').hide();
    $('#btnSimpan').show();
    $('#btnReset').show();
    $('#btnEdit').hide();
    $('#btnBatal').hide();
    $('#notif').hide();
    $.post('modal_panjar', {
        id: id, jenis: '1'
    }, function (response) {
        var json = jQuery.parseJSON(response);
        if (json.st == 1) {
            $("#title").html("");
            $("#id_").val('');
            $("#nama_").html('');
            $('#no_perkara_').html('');
            $('#norek_').html('');
            $("#namarek_").html('');
            $("#status_").html("");

            $("#title").append(json.judul);
            $("#id_").val(json.id);
            $("#nama_").append(json.nama_pihak);
            $('#no_perkara_').append(json.no_perkara);
            $('#norek_').append('Nomor Rekening : ' + json.no_rek);
            $("#namarek_").append('Nama Pemilik Rekening : ' + json.nama_rek);
            $("#status_").append(json.status);
        }
    });
}

function BukaModalPanjar(id) {
    $('#form_proses_panjar').hide();
    $('#btnEdit').show();
    $('#btnSimpan').hide();
    $('#btnBatal').hide();
    $('#btnReset').hide();
    $('#notif').hide();
    $.post('modal_panjar', {
        id: id, jenis: '2'
    }, function (response) {
        var json = jQuery.parseJSON(response);
        if (json.st == 1) {
            $("#title").html("");
            $("#id_").val('');
            $("#nama_").html('');
            $('#no_perkara_').html('');
            $('#norek_').html('');
            $("#namarek_").html('');
            $("#status_").html("");

            $("#title").append(json.judul);
            $("#id_").val(json.id);
            $("#nama_").append(json.nama_pihak);
            $('#no_perkara_').append(json.no_perkara);
            $('#norek_').append('Nomor Rekening : ' + json.no_rek);
            $("#namarek_").append('Nama Pemilik Rekening : ' + json.nama_rek);
            $("#status_").append(json.status);

            if ($('#status').val() == 1) {
                $('#date-format').val('');
                $('#date-sql').val('');
                $('#nominal').val('');
                $('#nominal_tf').val('');
                $('#nomor_tf').val('');
                $('#ket_proses').val('');

                $('#date-format').attr('disabled', true);
                $('#nominal').attr('disabled', true);
                $('#nomor_tf').attr('disabled', true);
                $('#ket_proses').attr('disabled', true);

                $('#date-format').val(convertSQLToFullDate(json.tgl_trans));
                $('#date-sql').val(json.tgl_trans);
                $('#nominal').val(formatAngka(json.nominal));
                $('#nominal_tf').val(json.nominal);
                $('#nomor_tf').val(json.no_trans);
                $('#ket_proses').val(json.ket);

                $('#form_proses_panjar').show();
                $('#proses').show();
                $('#tidak_proses').hide();
                $('#jenis_').val('1');
            } else {
                $('#ket').val('');
                $('#ket').attr('disabled', true);
                $('#ket').val(json.ket);

                $('#form_proses_panjar').show();
                $('#proses').hide();
                $('#tidak_proses').show();
                $('#jenis_').val('2');
            }
        }
    });
}

function editProsesPanjar() {
    $('#btnSimpan').show();
    $('#btnEdit').hide();
    $('#btnReset').hide();
    $('#btnBatal').show();

    $('#notif').show();

    if ($('#status').val() == 1) {
        $('#status').removeAttr('disabled');
        $('#date-format').removeAttr('disabled');
        $('#nominal').removeAttr('disabled');
        $('#nomor_tf').removeAttr('disabled');
        $('#ket_proses').removeAttr('disabled');
    } else {
        $('#status').removeAttr('disabled');
        $('#ket').removeAttr('disabled');
    }
}

function batalEditProsesPanjar() {
    $('#btnSimpan').hide();
    $('#btnEdit').show();
    $('#btnReset').hide();
    $('#btnBatal').hide();

    $('#notif').hide();

    if ($('#status').val() == 1) {
        $('#status').attr('disabled', true);
        $('#date-format').attr('disabled', true);
        $('#nominal').attr('disabled', true);
        $('#nomor_tf').attr('disabled', true);
        $('#ket_proses').attr('disabled', true);
    } else {
        $('#status').attr('disabled', true);
        $('#ket').attr('disabled', true);
    }
}

function statusProses() {
    $('#form_proses_panjar').hide();
    var jenis_status = $('#status').val();
    if (jenis_status == '') {
        $('#form_proses_panjar').hide();
        $('#proses').hide();
        $('#tidak_proses').hide();
        $('#jenis_').val('');
    } else if (jenis_status == 1) {
        //console.log(jenis_progres);
        $('#form_proses_panjar').show();
        $('#proses').show();
        $('#tidak_proses').hide();
        $('#jenis_').val('1');
    } else {
        $('#form_proses_panjar').show();
        $('#proses').hide();
        $('#tidak_proses').show();
        $('#jenis_').val('2');
    }
}

function BukaModalProsesEcourt(id) {
    $('#form_proses_panjar').hide();
    $('#btnSimpan').show();
    $('#btnReset').show();
    $('#btnEdit').hide();
    $('#btnBatal').hide();
    $('#notif').hide();
    $.post('modal_ecourt', {
        id: id, jenis: '1'
    }, function (response) {
        var json = jQuery.parseJSON(response);
        if (json.st == 1) {
            $("#title").html("");
            $("#id_").val('');
            $("#jenisPihak_").html('');
            $("#nama_").html('');
            $('#nik_').html('');
            $("#tmp_lahir_").html('');
            $('#tgl_lahir_').html('');
            $("#jk_").html('');
            $('#alamat_').html('');
            $("#agama_").html('');
            $('#kawin_').html('');
            $("#pekerjaan_").html('');
            $('#bank_').html('');
            $('#norek_').html('');
            $("#namarek_").html('');
            $("#telp_").html('');
            $('#no_hp_').html('');
            $("#email_").html('');
            $('#difabel_').html('');
            $("#pendidikan_").html('');
            $('#ktp_').html('');
            $("#status_").html("");

            $("#title").append(json.judul);
            $("#id_").val(json.id);
            $("#jenisPihak_").append(json.jenisPihak);
            $("#nama_").append(json.nama);
            $('#nik_').append(json.nik);
            $("#tmp_lahir_").append(json.tmp_lahir);
            $('#tgl_lahir_').append(json.tgl_lahir);
            if (json.jk == 1) {
                $("#jk_").append('Pria');
            } else {
                $("#jk_").append('Wanita');
            }
            $('#alamat_').append(json.alamat);
            $("#agama_").append(json.agama);
            switch (json.kawin) {
                case "1": $('#kawin_').append('Kawin'); break;
                case "2": $('#kawin_').append('Belum Kawin'); break;
                case "3": $('#kawin_').append('Duda'); break;
                case "4": $('#kawin_').append('Janda'); break;
                default: $('#kawin_').append('-'); break;
            }
            $("#pekerjaan_").append(json.pekerjaan);
            $('#bank_').append(json.bank);
            $('#norek_').append(json.no_rek);
            $("#namarek_").append(json.nama_rek);
            $("#telp_").append(json.telp);
            $('#no_hp_').append(json.no_hp);
            $("#email_").append(json.email);
            if (json.difabel == 1) {
                $('#difabel_').append('Tidak');
            } else {
                $('#difabel_').append('Ya');
            }
            $("#pendidikan_").append(json.pendidikan);
            $('#ktp_').append('<a target="blank_" href="' + json.ktp + '">Download</a>');
            $("#status_").append(json.status);
        }
    });
}

function BukaModalEcourt(id) {
    $('#form_proses_ecourt').hide();
    $('#btnEdit').show();
    $('#btnSimpan').hide();
    $('#btnBatal').hide();
    $('#btnReset').hide();
    $('#notif').hide();
    $.post('modal_ecourt', {
        id: id, jenis: '2'
    }, function (response) {
        var json = jQuery.parseJSON(response);
        if (json.st == 1) {
            $("#title").html("");
            $("#id_").val('');
            $("#jenisPihak_").html('');
            $("#nama_").html('');
            $('#nik_').html('');
            $("#tmp_lahir_").html('');
            $('#tgl_lahir_').html('');
            $("#jk_").html('');
            $('#alamat_').html('');
            $("#agama_").html('');
            $('#kawin_').html('');
            $("#pekerjaan_").html('');
            $('#bank_').html('');
            $('#norek_').html('');
            $("#namarek_").html('');
            $("#telp_").html('');
            $('#no_hp_').html('');
            $("#email_").html('');
            $('#difabel_').html('');
            $("#pendidikan_").html('');
            $('#ktp_').html('');
            $("#status_").html("");

            $("#title").append(json.judul);
            $("#id_").val(json.id);
            $("#jenisPihak_").append(json.jenisPihak);
            $("#nama_").append(json.nama);
            $('#nik_').append(json.nik);
            $("#tmp_lahir_").append(json.tmp_lahir);
            $('#tgl_lahir_').append(json.tgl_lahir);
            if (json.jk == 1) {
                $("#jk_").append('Pria');
            } else {
                $("#jk_").append('Wanita');
            }
            $('#alamat_').append(json.alamat);
            $("#agama_").append(json.agama);
            switch (json.kawin) {
                case "1": $('#kawin_').append('Kawin'); break;
                case "2": $('#kawin_').append('Belum Kawin'); break;
                case "3": $('#kawin_').append('Duda'); break;
                case "4": $('#kawin_').append('Janda'); break;
                default: $('#kawin_').append('-'); break;
            }
            $("#pekerjaan_").append(json.pekerjaan);
            $('#bank_').append(json.bank);
            $('#norek_').append(json.no_rek);
            $("#namarek_").append(json.nama_rek);
            $("#telp_").append(json.telp);
            $('#no_hp_').append(json.no_hp);
            $("#email_").append(json.email);
            if (json.difabel == 1) {
                $('#difabel_').append('Tidak');
            } else {
                $('#difabel_').append('Ya');
            }
            $("#pendidikan_").append(json.pendidikan);
            $('#ktp_').append('<a target="blank_" href="' + json.ktp + '">Download</a>');
            $("#status_").append(json.status);

            if ($('#status').val() == 1) {
                $('#password').val('');
                $('#ket_proses').val('');

                $('#password').attr('disabled', true);
                $('#ket_proses').attr('disabled', true);

                $('#password').val(json.password);
                $('#ket_proses').val(json.ket);

                $('#form_proses_ecourt').show();
                $('#proses').show();
                $('#tidak_proses').hide();
                $('#jenis_').val('1');
            } else {
                $('#ket').val('');
                $('#ket').attr('disabled', true);
                $('#ket').val(json.ket);

                $('#form_proses_ecourt').show();
                $('#proses').hide();
                $('#tidak_proses').show();
                $('#jenis_').val('2');
            }
        }
    });
}

function editProsesEcourt() {
    $('#btnSimpan').show();
    $('#btnEdit').hide();
    $('#btnReset').hide();
    $('#btnBatal').show();

    $('#notif').show();

    if ($('#status').val() == 1) {
        $('#status').removeAttr('disabled');
        $('#password').removeAttr('disabled');
        $('#ket_proses').removeAttr('disabled');
    } else {
        $('#status').removeAttr('disabled');
        $('#ket').removeAttr('disabled');
    }
}

function batalEditProsesEcourt() {
    $('#btnSimpan').hide();
    $('#btnEdit').show();
    $('#btnReset').hide();
    $('#btnBatal').hide();

    $('#notif').hide();

    if ($('#status').val() == 1) {
        $('#status').attr('disabled', true);
        $('#password').attr('disabled', true);
        $('#ket_proses').attr('disabled', true);
    } else {
        $('#status').attr('disabled', true);
        $('#ket').attr('disabled', true);
    }
}