$(function () {

    $('#tglLahir').bootstrapMaterialDatePicker({
        locale: 'id', // Setel lokal ke bahasa Indonesia
        format: 'DD MMMM YYYY', // Format lengkap
        time: false, // Aktifkan waktu
        date: true, // Aktifkan tanggal
    });

    // Event listener untuk mengisi input kedua (#date-sql) saat input pertama berubah
    $('#tglLahir').on('change', function () {
        // Ambil nilai dari input pertama
        let selectedDate = $(this).val();

        // Konversi nilai ke format SQL (YYYY-MM-DD HH:mm:ss)
        let sqlDate = moment(selectedDate, 'DD MMMM YYYY').format('YYYY-MM-DD');

        // Isi nilai ke input kedua (#date-sql)
        $('#tglLahir_').val(sqlDate);
    });

    $('#tglAkta').bootstrapMaterialDatePicker({
        locale: 'id', // Setel lokal ke bahasa Indonesia
        format: 'DD MMMM YYYY', // Format lengkap
        time: false, // Aktifkan waktu
        date: true, // Aktifkan tanggal
    });

    // Event listener untuk mengisi input kedua (#date-sql) saat input pertama berubah
    $('#tglAkta').on('change', function () {
        // Ambil nilai dari input pertama
        let selectedDate = $(this).val();

        // Konversi nilai ke format SQL (YYYY-MM-DD HH:mm:ss)
        let sqlDate = moment(selectedDate, 'DD MMMM YYYY').format('YYYY-MM-DD');

        // Isi nilai ke input kedua (#date-sql)
        $('#tglAkta_').val(sqlDate);
    });

    $('#tglSK').bootstrapMaterialDatePicker({
        locale: 'id', // Setel lokal ke bahasa Indonesia
        format: 'DD MMMM YYYY', // Format lengkap
        time: false, // Aktifkan waktu
        date: true, // Aktifkan tanggal
    });

    // Event listener untuk mengisi input kedua (#date-sql) saat input pertama berubah
    $('#tglSK').on('change', function () {
        // Ambil nilai dari input pertama
        let selectedDate = $(this).val();

        // Konversi nilai ke format SQL (YYYY-MM-DD HH:mm:ss)
        let sqlDate = moment(selectedDate, 'DD MMMM YYYY').format('YYYY-MM-DD');

        // Isi nilai ke input kedua (#date-sql)
        $('#tglSK_').val(sqlDate);
    });
});

function gantiJenisPihak() {
    var jenis_pihak = $('#cbJenisPihak').val();
    switch (jenis_pihak) {
        case '1':
            $('#jenisPihak_1').val(jenis_pihak);
            $('#userPerorangan').show();
            $('#userPemerintah').hide();
            $('#userBadanHukum').hide();
            $('#userKuasaInsidentil').hide();
            break;

        case '2':
            $('#jenisPihak_2').val(jenis_pihak);
            $('#userPerorangan').hide();
            $('#userPemerintah').show();
            $('#userBadanHukum').hide();
            $('#userKuasaInsidentil').hide();
            break;

        case '3':
            $('#jenisPihak_3').val(jenis_pihak);
            $('#userPerorangan').hide();
            $('#userPemerintah').hide();
            $('#userBadanHukum').show();
            $('#userKuasaInsidentil').hide();
            break;

        case '4':
            $('#jenisPihak_4').val(jenis_pihak);
            $('#userPerorangan').hide();
            $('#userPemerintah').hide();
            $('#userBadanHukum').hide();
            $('#userKuasaInsidentil').show();
            break;

        default:
            $('#jenisPihak_').val('');
            $('#userPerorangan').hide();
            $('#userPemerintah').hide();
            $('#userBadanHukum').hide();
            $('#userKuasaInsidentil').hide();
            break;
    }
}