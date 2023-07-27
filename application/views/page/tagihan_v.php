<style>
.demo {
    display: flex;
    justify-content: center;
    align-items: flex-end;
    flex-direction: column;
    margin-top: 10px;
    margin-bottom: 2px;
}

.btn-icon-text {
    padding-top: 8px;
    padding-bottom: 8px;
    padding-right: 13px;
    padding-left: 13px;
}

.input-wrapper {
    position: relative;
    line-height: 14px;
    margin: 0 5px;
    display: grid;
}

.label-select {
    color: #bbb;
    font-size: 11px;
    text-transform: uppercase;
    position: absolute;
    z-index: 2;
    left: 20px;
    top: 14px;
    padding: 0 2px;
    pointer-events: none;
    background: #fff;
    -webkit-transition: -webkit-transform 100ms ease;
    -moz-transition: -moz-transform 100ms ease;
    -o-transition: -o-transform 100ms ease;
    -ms-transition: -ms-transform 100ms ease;
    transition: transform 100ms ease;
    -webkit-transform: translateY(-20px);
    -moz-transform: translateY(-20px);
    -o-transform: translateY(-20px);
    -ms-transform: translateY(-20px);
    transform: translateY(-20px);
}

.label-select2 {
    color: #4B49AC;
    font-size: 8px;
    text-transform: uppercase;
    position: absolute;
    z-index: 2;
    left: 63px;
    top: 14px;
    padding: 0 2px;
    pointer-events: none;
    background: #fff;
    -webkit-transform: translateY(-25px);
}

.label-select {
    color: #4B49AC;
    font-size: 11px;
    text-transform: uppercase;
    position: absolute;
    z-index: 2;
    left: 20px;
    top: 14px;
    padding: 0 2px;
    pointer-events: none;
    background: #fff;
    -webkit-transition: -webkit-transform 100ms ease;
    -moz-transition: -moz-transform 100ms ease;
    -o-transition: -o-transform 100ms ease;
    -ms-transition: -ms-transform 100ms ease;
    transition: transform 100ms ease;
    -webkit-transform: translateY(-20px);
    -moz-transform: translateY(-20px);
    -o-transform: translateY(-20px);
    -ms-transform: translateY(-20px);
    transform: translateY(-20px);
}

.label-in {
    color: #bbb;
    font-size: 11px;
    text-transform: uppercase;
    position: absolute;
    z-index: 2;
    left: 20px;
    top: 14px;
    padding: 0 2px;
    pointer-events: none;
    background: #fff;
    -webkit-transition: -webkit-transform 100ms ease;
    -moz-transition: -moz-transform 100ms ease;
    -o-transition: -o-transform 100ms ease;
    -ms-transition: -ms-transform 100ms ease;
    transition: transform 100ms ease;
    -webkit-transform: translateY(-20px);
    -moz-transform: translateY(-20px);
    -o-transform: translateY(-20px);
    -ms-transform: translateY(-20px);
    transform: translateY(-20px);
}

input,
select {
    font-size: 13px;
    color: #555;
    outline: none;
    border: 1px solid #bbb;
    padding: 15px 20px 10px;
    border-radius: 10px;
    position: relative;
}

input:invalid+label,
select:invalid+label {
    -webkit-transform: translateY(0);
    -moz-transform: translateY(0);
    -o-transform: translateY(0);
    -ms-transform: translateY(0);
    transform: translateY(0);
}

input:focus,
select:focus {
    border-color: #2b96f1;
}

input:focus+label,
select:focus+label {
    color: #2b96f1;
    -webkit-transform: translateY(-20px);
    -moz-transform: translateY(-20px);
    -o-transform: translateY(-20px);
    -ms-transform: translateY(-20px);
    transform: translateY(-20px);
}
</style>

<!-- alerts -->
<?php
        $sukses_message = $this->session->flashdata('sukses');
        $gagal_message = $this->session->flashdata('gagal');
    ?>
<?php if ($sukses_message): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '<?php echo $sukses_message; ?>',
});
</script>
<?php endif; ?>

<?php if ($gagal_message): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal!',
    text: '<?php echo $gagal_message; ?>',
});
</script>
<?php endif; ?>
<!-- akhir alerts -->

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-9 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body pb-2 pr-2">
                        <h4 class="card-title">Buat Tagihan</h4>
                        <div class="input-group pb-0">
                            <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 p-0">
                                <div class="input-wrapper">
                                    <label class="label-select">Bulan</label>
                                    <select type="text" id="bln_tagihan" required class="col-lg-12">
                                        <option value="Januari">Januari</option>
                                        <option value="Februari">Februari</option>
                                        <option value="Maret">Maret</option>
                                        <option value="April">April</option>
                                        <option value="Mei">Mei</option>
                                        <option value="Juni">Juni</option>
                                        <option value="Juli">Juli</option>
                                        <option value="Agustus">Agustus</option>
                                        <option value="September">September</option>
                                        <option value="Oktober">Oktober</option>
                                        <option value="November">November</option>
                                        <option value="Desember">Desember</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 p-0">
                                <div class="input-wrapper">
                                    <label class="label-select">Tahun</label>
                                    <select type="text" id="thn_tagihan" required>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                    </select>
                                </div>
                            </div>
                            <!-- data di hiden -->
                            <?php foreach ($iuran as $data) { ?>
                            <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12  mt-1 mb-2 p-0" hidden>
                                <div class="input-wrapper">
                                    <label class="label-select">Iuran</label>
                                    <select type="text" id="id_iuran" class="col-lg-12" required>
                                        <option value="<?= $data->id_iuran; ?>"><?= $data->nama_iuran; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12  mt-1 mb-2 p-0" hidden>
                                <div class="input-wrapper">
                                    <input type="text" id="harga" class="col-lg-12" value="<?= $data->nominal; ?>">
                                    <label class="label-in">harga / kubik</label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12  mt-1 mb-2 p-0" hidden>
                                <div class="input-wrapper">
                                    <input type="text" id="perawatan" class="col-lg-12"
                                        value="<?= $data->perawatan; ?>">
                                    <label class="label-in">perawatan</label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12  mt-1 mb-2 p-0" hidden>
                                <div class="input-wrapper">
                                    <input type="text" id="abunamen" class="col-lg-12" value="<?= $data->abunament; ?>">
                                    <label class="label-in">Abunament</label>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- akhir data hidden -->

                            <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12  mt-1 mb-2 p-0">
                                <div class="input-wrapper">
                                    <label class="label-in">Kubik 1</label>
                                    <?php foreach ($kubik as $data) { ?>
                                    <input type="text" id="kubik-1" class="col-lg-12" value="<?= $data->kubik_in; ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12  mt-1 mb-2 p-0">
                                <div class="input-wrapper">
                                    <input type="text" id="kubik-in" class="col-lg-12" required>
                                    <label class="label-in">Kubik 2</label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12  mt-1 mb-2 p-0">
                                <div class="input-wrapper">
                                    <input type="text" id="kubik-2" class="col-lg-12" required>
                                    <label class="label-in">Kubik hasil</label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12  mt-1 mb-2 p-0">
                                <div class="input-wrapper">
                                    <input type="text" id="nominal" class="col-lg-12" required>
                                    <label class="label-in">Nominal</label>
                                </div>
                            </div>
                        </div>
                        <div class="demo">
                            <button type="button" class="btn btn-outline-success btn-icon-text">
                                <i class="ti-archive"> </i>
                                Buat
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 grid-margin stretch-card">
                <div class="card">
                    <div class="form-group mt-3 col-lg-12 col-md-12 col-sm-12 col-xs-12 mr-0">
                        <label class="label-select2">Pilih Warga</label>
                        <select class="js-example-basic-single w-100">
                            <option value="">....</option>
                            <?php foreach ($warga as $data) { ?>
                            <option value="<?= $data['id']; ?>" data-badge="<?= $data['badge']; ?>">
                                <?= $data['text']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            templateResult: function(data) {
                if (!data.id) {
                    return data.text;
                }

                var badge = data.element.dataset.badge;
                var $result = $('<span><div class="badge badge-info">' + badge + '</div> ' +
                    data
                    .text + '</span>');
                return $result;
            },
            templateSelection: function(data) {
                if (!data.id) {
                    return data.text;
                }

                var badge = data.element.dataset.badge;
                var $result = $('<span><div class="badge badge-info">' + badge + '</div> ' +
                    data
                    .text + '</span>');
                return $result;
            }
        });
    });
    </script>

    <!-- kode javascrip mengambil bulan dan tanggal hari ini -->
    <script>
    const selectBulan = document.getElementById('bln_tagihan');
    const selectTahun = document.getElementById('thn_tagihan');

    // Buat objek Date untuk mendapatkan bulan & tahun saat ini
    const tanggalSekarang = new Date();
    const tahunSekarang = new Date().getFullYear();

    const indeksBulanSekarang = tanggalSekarang.getMonth();

    // Set nilai default select sesuai dengan indeks bulan saat ini
    selectBulan.selectedIndex = indeksBulanSekarang;

    // memilih tahun saat ini
    for (let i = 0; i < selectTahun.options.length; i++) {
        // Jika nilai opsi sama dengan tahun saat ini, set opsi tersebut menjadi default (selected)
        if (parseInt(selectTahun.options[i].value) === tahunSekarang) {
            selectTahun.options[i].selected = true;
            break;
        }
    }
    </script>

    <!-- kode javascript untuk disable input jka ada isinya -->
    <script>
    function checkInputStatus() {
        var inputElement = document.getElementById('kubik-1');
        var inputWrapper = document.querySelector('.input-wrapper');

        if (inputElement.value.trim() !== '') {
            inputElement.disabled = true; // Nonaktifkan input jika memiliki nilai
            inputWrapper.classList.add(
                'disabled');
        } else {
            inputElement.disabled = false; // Aktifkan input jika tidak ada nilai
            inputWrapper.classList.remove('disabled');
        }
    }

    // Panggil fungsi checkInputStatus() saat halaman dimuat dan saat nilai input berubah
    document.addEventListener('DOMContentLoaded', checkInputStatus);
    document.getElementById('kubik-1').addEventListener('input', checkInputStatus);
    </script>

    <!-- kode untuk rumus menghitung biaya air -->
    <script>
    const kubik1Input = document.getElementById('kubik-1');
    const kubikInInput = document.getElementById('kubik-in');
    const kubik2Input = document.getElementById('kubik-2');
    const hargaInput = document.getElementById('harga');
    const perawatanInput = document.getElementById('perawatan');
    // const abunamenInput = document.getElementById('abunamen');
    const nominalInput = document.getElementById('nominal');

    // Fungsi untuk menghitung dan menampilkan hasilnya di kubik-2 dan nominal
    function hitungSelisih() {
        const kubik1Value = parseFloat(kubik1Input.value);
        const kubikInValue = parseFloat(kubikInInput.value);
        const hargaValue = parseFloat(hargaInput.value);
        const perawatanValue = parseFloat(perawatanInput.value);
        // const abunamenValue = parseFloat(abunamenInput.value);

        // Cek apakah input valid (berupa angka)
        if (!isNaN(kubik1Value) && !isNaN(kubikInValue) && !isNaN(hargaValue) && !isNaN(perawatanValue)) {
            const hasilKubik = kubikInValue - kubik1Value;
            const hargaHasil = hasilKubik * hargaValue;
            const hargafix = hargaHasil + perawatanValue;

            kubik2Input.value = hasilKubik;
            nominalInput.value = hargafix;
        }
    }

    // Pasang event handler untuk memanggil fungsi hitungSelisih saat input berubah
    kubik1Input.addEventListener('input', hitungSelisih);
    kubikInInput.addEventListener('input', hitungSelisih);
    hargaInput.addEventListener('input', hitungSelisih);
    perawatanInput.addEventListener('input', hitungSelisih);
    </script>