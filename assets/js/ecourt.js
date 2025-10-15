$(function () {


});

function gantiJenisPihak() {
    var jenis_pihak = $('#cbJenisPihak').val();

    if (jenis_pihak !== '') {
        // tampilkan indikator loading
        $('#formEcourt').html('<div class="text-center p-3"><i class="fa fa-spinner fa-spin"></i> Memuat formulir...</div>');

        $.ajax({
            url: 'ecourt/halamanutama/get_form_pihak/' + jenis_pihak,
            type: 'GET',
            success: function (response) {
                // tampilkan form hasil AJAX
                $('#formEcourt').html(response);

                // set nilai jenis pihak ke input hidden jika ada
                $('#jenisPihak_1').val(jenis_pihak);

                // Tunggu sampai elemen #captcha benar-benar ada di DOM
                setTimeout(function () {
                    const captchaEl = document.getElementById('captcha');
                    if (captchaEl) {
                        try {
                            // Bersihkan isi sebelumnya kalau ada
                            $('#captcha').empty();

                            // Render ulang captcha
                            grecaptcha.render(captchaEl, {
                                'sitekey': '6LcDRnMrAAAAAPYZEykwgzWgbffAe4LsO56EMHPV'
                            });
                        } catch (err) {
                            console.error('Gagal render captcha:', err);
                        }
                    } else {
                        console.error('Elemen #captcha belum ditemukan dalam response HTML.');
                    }
                }, 300); // delay 0.3 detik supaya DOM sudah siap

                // Reinitialize filestyle plugin
                if ($.fn.filestyle) {
                    $(":file").filestyle({
                        buttonName: "btn-secondary"
                    });
                }
            },
            error: function () {
                $('#formEcourt').html('<div class="alert alert-danger">Gagal memuat form.</div>');
            }
        });
    } else {
        $('#formEcourt').empty();
    }
}