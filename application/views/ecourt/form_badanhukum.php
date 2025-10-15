<div class="alert alert-info text-center" role="alert">
    DATA UMUM
</div>

<form method="POST" action="simpan_ecourt" enctype="multipart/form-data">
    <input class="form-control" type="hidden" id="jenisPihak_1" name="jenisPihak">

    <div class="form-group">
        <label for="nama_badan">Nama Perusahaan/Organisasi <code>*</code></label>
        <input class="form-control" type="text" id="nama_badan" name="nama_badan" required
            placeholder="Masukkan Nama Perusahaan/Organisasi" autocomplete="off">
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label for="tglLahir">Tanggal Akta Pendirian
                    <code>*</code></label>
                <input class="form-control floating-label" type="text" id="tglAkta" placeholder="Pilih"
                    autocomplete="off">
                <input class="form-control" type="hidden" id="tglAkta_" name="tglAkta" required>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label for="tmptLahir">Nomor Akta Pendirian
                    <code>*</code></label>
                <input class="form-control" type="text" id="noAkta" name="noAkta" autocomplete="off"
                    placeholder="Masukkan Nomor Akta Pendirian" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label for="tglLahir">Tanggal SK Menteri Hukum dan HAM
                    <code>*</code></label>
                <input class="form-control floating-label" type="text" id="tglSK" placeholder="Pilih"
                    autocomplete="off">
                <input class="form-control" type="hidden" id="tglSK_" name="tglSK" required>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label for="tmptLahir">Nomor SK Menteri Hukum dan HAM
                    <code>*</code></label>
                <input class="form-control" type="text" id="noSK" name="noSK" autocomplete="off"
                    placeholder="Masukkan Nomor SK" required>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="alamat_badan">Alamat Badan Hukum <code>*</code></label>
        <input class="form-control" type="text" id="alamat_badan" name="alamat_badan" required
            placeholder="Masukkan Alamat Badan Hukum" autocomplete="off">
    </div>

    <div class="form-group">
        <label for="email_badan">Email Badan Hukum <code>*</code></label>
        <input class="form-control" type="text" id="email_badan" name="email_badan" required
            placeholder="Masukkan Alamat Badan Hukum" autocomplete="off">
    </div>

    <div class="form-group">
        <label for="nama_kuasa">Nama Yang Mewakili / Yang Dikuasakan <code>*</code></label>
        <input class="form-control" type="text" id="nama_kuasa" name="nama_kuasa" required
            placeholder="Masukkan Nama Yang Mewakili / Yang Dikuasakan" autocomplete="off">
        Penulisan nama tidak diperbolehkan ada tanda petik ('), karena akan bermasalah pada
        tahap ePayment
    </div>

    <div class="form-group">
        <label for="ni">NIK Yang Mewakili / Yang Dikuasakan <code>*</code></label>
        <input class="form-control" data-parsley-type="digits" data-parsley-min="16" data-parsley-maxlength="16"
            type="text" id="ni" name="ni" autocomplete="off" placeholder="Masukkan Nomor Induk Pegawai" required>
    </div>

    <div class="form-group">
        <label for="email_kuasa">Alamat E-Mail Yang Mewakili / Yang Dikuasakan
            <code>*</code></label>
        <input class="form-control" type="text" id="email_kuasa" name="email_kuasa" required
            placeholder="Masukkan Alamat Yang Mewakili / Yang Dikuasakan" parsley-type="email" autocomplete="off">
        Pastikan Email belum pernah digunakan untuk mendaftar akun E-Court
    </div>

    <div class="form-group">
        <label for="alamat_kuasa">Alamat Yang Mewakili / Yang Dikuasakan<code>*</code></label>
        <textarea class="form-control" id="alamat_kuasa" name="alamat_kuasa" rows="2" required
            placeholder="Masukkan Alamat Alamat Yang Mewakili / Yang Dikuasakan" autocomplete="off"></textarea>
    </div>

    <div class="alert alert-info text-center" role="alert">
        DATA KHUSUS
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label for="bank">Bank <code>*</code></label>
                <select class="form-control" id="bank" name="bank" required>
                    <option value="">Pilih</option>
                    <option value="BSI">BSI</option>
                    <option value="BPD ACEH">BPD ACEH</option>
                    <option value="B C A">B C A</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label for="no_rek">Nomor Rekening
                    <code>*</code></label>
                <input class="form-control" data-parsley-type="digits" data-parsley-maxlength="15" type="text"
                    id="no_rek" name="no_rek" required placeholder="Masukkan Nomor Rekening Anda" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="nama_rek">Nama Pemilik Rekening
            <code>*</code></label>
        <input class="form-control" type="text" id="nama_rek" name="nama_rek" required
            placeholder="Masukkan Nama Pemilik Rekening" autocomplete="off">
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label for="no_telp">Nomor Telepon</label>
                <input class="form-control" data-parsley-type="digits" data-parsley-maxlength="15" type="text"
                    id="no_telp" name="no_telp" placeholder="Masukkan Nomor Telepon Anda" autocomplete="off">
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label for="no_hp">Nomor Handphone
                    <code>*</code></label>
                <input class="form-control" data-parsley-type="digits" data-parsley-maxlength="15" type="text"
                    id="no_hp" name="no_hp" required placeholder="Masukkan Nomor Handphone Anda" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="file">File KTP/Passport/Surat Keterangan Pengganti KTP (maks 5Mb <em>ekstensi
                jpg/png/pdf</em>) <code>*</code></label>
        <input type="file" required class="filestyle" id="file" accept=".pdf, .png, .jpg"
            data-buttonname="btn-secondary" name="dokumen">
    </div>

    <div class="form-group">
        <label for="file2">File Kartu Pegawai/Kartu Tanda Anggota dan Surat Kuasa/Surat Tugas (Dijadikan 1 dokumen, maks
            5Mb <em>ekstensi
                jpg/png/pdf</em>) <code>*</code></label>
        <input type="file" required class="filestyle" id="file2" accept=".pdf, .png, .jpg"
            data-buttonname="btn-secondary" name="dokumen2">
    </div>

    <span class="badge badge-pill badge-danger mb-3">* Wajib diisi</span>

    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input required type="checkbox" class="custom-control-input" id="customControlInline">
            <label class="custom-control-label" for="customControlInline">Saya telah membaca
                dan memahami <a class="text-warning" href="#" data-toggle="modal" data-target=".modal-sk">Syarat dan
                    Ketentuan</a>.</label>
        </div>
    </div>

    <div class="form-group">
        <div class="text-center" id="captcha">
        </div>
    </div>

    <div class="form-group">
        <div class="text-center">
            <button type="submit" id="btnSimpan" class="btn btn-success waves-effect waves-light">
                Simpan
            </button>
            <button type="reset" id="btnReset" class="btn btn-secondary waves-effect m-l-5">
                Reset
            </button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('form').parsley();
    });

    $(function () {
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
</script>