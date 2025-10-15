<div class="alert alert-info text-center" role="alert">
    DATA UMUM
</div>

<form method="POST" action="simpan_ecourt" enctype="multipart/form-data">
    <input class="form-control" type="hidden" id="jenisPihak_1" name="jenisPihak">
    <div class="form-group">
        <label for="nama">Nama Lengkap <code>*</code></label>
        <input class="form-control" type="text" id="nama" name="nama" required placeholder="Masukkan Nama"
            autocomplete="off">
        Penulisan nama tidak diperbolehkan ada tanda petik ('), karena akan bermasalah pada
        tahap ePayment
    </div>
    <div class="form-group">
        <label for="ni">NIK <code>*</code></label>
        <input class="form-control" data-parsley-type="digits" data-parsley-min="16" data-parsley-maxlength="16"
            type="text" id="ni" name="ni" autocomplete="off" placeholder="Masukkan Nomor Induk Kependudukan" required>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label for="tmptLahir">Tempat Lahir
                    <code>*</code></label>
                <input class="form-control" type="text" id="tmptLahir" name="tmptLahir" autocomplete="off"
                    placeholder="Masukkan Tempat Lahir" required>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label for="tglLahir">Tanggal Lahir
                    <code>*</code></label>
                <input class="form-control floating-label" type="text" id="tglLahir" placeholder="Pilih"
                    autocomplete="off">
                <input class="form-control" type="hidden" id="tglLahir_" name="tglLahir" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label for="cbJenisKelamin">Jenis Kelamin
                    <code>*</code></label>
                <select class="form-control" id="cbJenisKelamin" name="jenisKelamin" required>
                    <option>Pilih</option>
                    <option value="1">Laki - laki</option>
                    <option value="2">Perempuan</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label for="cbAgama">Agama
                    <code>*</code></label>
                <select class="form-control" id="cbAgama" name="agama" required>
                    <option>Pilih</option>
                    <option value="Islam">Islam</option>
                    <option value="Protestan">Protestan</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Budha">Budha</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Kong Hu Cu">Kong Hu Cu</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="alamat">Alamat <code>*</code></label>
        <textarea class="form-control" id="alamat" name="alamat" rows="2" required
            placeholder="Masukkan Alamat Lengkap Anda" autocomplete="off"></textarea>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label for="cbKawin">Status Kawin
                    <code>*</code></label>
                <select class="form-control" id="cbKawin" name="kawin" required>
                    <option>Pilih</option>
                    <option value="1">Kawin</option>
                    <option value="2">Belum Kawin</option>
                    <option value="3">Duda</option>
                    <option value="4">Janda</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label for="pekerjaan">Pekerjaan
                    <code>*</code></label>
                <input class="form-control" type="text" id="pekerjaan" name="pekerjaan" required
                    placeholder="Masukkan Pekerjaan Anda" autocomplete="off">
            </div>
        </div>
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
        <label for="email">Alamat E-Mail
            <code>*</code></label>
        <input class="form-control" type="text" id="email" name="email" required
            placeholder="Masukkan Alamat Email Anda" parsley-type="email" autocomplete="off">
        Pastikan Email belum pernah digunakan untuk mendaftar akun E-Court
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label for="difabel">Berkebutuhan Khusus
                    <code>*</code></label>
                <select class="form-control" required id="difabel" name="difabel">
                    <option>Pilih</option>
                    <option value="1">Tidak</option>
                    <option value="2">Ya</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label for="pendidikan">Pendidikan
                    <code>*</code></label>
                <select required class="form-control" id="pendidikan" name="pendidikan">
                    <option>Pilih</option>
                    <option value="Tidak Ada">Tidak Ada</option>
                    <option value="Tidak Ada">Belum Sekolah</option>
                    <option value="TK">TK</option>
                    <option value="SD">SD</option>
                    <option value="SLTP">SLTP</option>
                    <option value="SMA">SMA</option>
                    <option value="D1">D1</option>
                    <option value="D2">D2</option>
                    <option value="D3">D3</option>
                    <option value="D4">D4</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>File KTP/Passport/Surat Keterangan Pengganti KTP (maks 5Mb <em>ekstensi
                jpg/png/pdf</em>) <code>*</code></label>
        <input type="file" required class="filestyle" id="file" accept=".pdf, .png, .jpg"
            data-buttonname="btn-secondary" name="dokumen">
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
    });
</script>