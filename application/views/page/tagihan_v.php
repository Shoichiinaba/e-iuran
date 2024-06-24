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
<?php if ($userdata->role == 'RT') : ?>
<div class="main-panel">
    <div class="content-wrapper">
        <form id="buat-tagihan">
            <div class="row">
                <div class="col-lg-3 grid-margin stretch-card mb-2 pt-2">
                    <div class="card">
                        <div class="form-group mt-3 col-lg-12 col-md-12 col-sm-12 col-xs-12 mr-0">
                            <label class="label-select2">Pilih Warga</label>
                            <select class="js-example-basic-single w-100" id="id_warga" name="id_warga" required>
                                <option value="">....</option>
                                <?php foreach ($warga as $data) { ?>
                                <option value="<?= $data['id']; ?>" data-badge="<?= $data['badge']; ?>"
                                    data-no-rumah="<?= $data['no_rumah']; ?>"
                                    data-kapling-gabungan="<?= $data['kapling_gabungan']; ?>">
                                    <?= $data['text']; ?>
                                </option>
                                <?php } ?>
                            </select>

                        </div>
                    </div>
                </div>
                <div class="col-lg-9 grid-margin stretch-card mb-2 pt-2">
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
                                            <option value="2024">2024</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- data di hiden -->
                                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 p-0" hidden>
                                    <div class="input-wrapper">
                                        <label class="label-in">invoice</label>
                                        <input type="text" id="invoice" class="col-lg-12">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 p-0" hidden>
                                    <div class="input-wrapper">
                                        <label class="label-in">rtrw</label>
                                        <input type="text" id="id-rtrw" value="<?php echo $userdata->id_rtrw; ?>"
                                            class="col-lg-12">
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12  mt-1 mb-2 p-0" hidden>
                                    <div class="input-wrapper">
                                        <input type="text" id="kapling-gabungan" class="col-lg-12" value="">
                                    </div>
                                </div>

                                <?php foreach ($ifas as $data) { ?>
                                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12  mt-1 mb-2 p-0" hidden>
                                    <div class="input-wrapper">
                                        <input type="text" id="lain-lain" class="col-lg-12"
                                            value="<?= $data->nominal; ?>">
                                    </div>
                                </div>
                                <?php } ?>

                                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12  mt-1 mb-2 p-0" hidden>
                                    <div class="input-wrapper">
                                        <input type="text" id="hasil-ipl" class="col-lg-12">
                                    </div>
                                </div>

                                <?php foreach ($tax as $data) { ?>
                                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12  mt-1 mb-2 p-0" hidden>
                                    <div class="input-wrapper">
                                        <input type="text" id="taxs" class="col-lg-12"
                                            value="<?= $data->tax_amaunt; ?>">
                                    </div>
                                </div>
                                <?php } ?>

                                <?php foreach ($iuran as $data) { ?>
                                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12  mt-1 mb-2 p-0" hidden>
                                    <div class="input-wrapper">
                                        <label class="label-select">Iuran</label>
                                        <select type="text" id="id_iuran" class="col-lg-12" required>
                                            <option value="<?= $data->id_iuran; ?>"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12  mt-1 mb-2 p-0" hidden>
                                    <div class="input-wrapper">
                                        <input type="text" id="harga" class="col-lg-12" value="<?= $data->nominal; ?>">
                                        <input type="text" id="harga1" class="col-lg-12"
                                            value="<?= $data->nominal1; ?>">
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
                                        <input type="text" id="abunamen" class="col-lg-12"
                                            value="<?= $data->abunament; ?>">
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 p-0" hidden>
                                    <div class="input-wrapper">
                                        <label class="label-in">abo1</label>
                                        <input type="number" id="abo1" class="col-lg-12">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 p-0" hidden>
                                    <div class="input-wrapper">
                                        <label class="label-in">perku</label>
                                        <input type="number" id="perkubik" class="col-lg-12">
                                    </div>
                                </div>
                                <!-- akhir data hidden -->
                                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 p-0">
                                    <div class="input-wrapper">
                                        <label class="label-in">Kubik 1</label>
                                        <input type="number" id="kubik-1" class="col-lg-12">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12  mt-1 mb-2 p-0">
                                    <div class="input-wrapper">
                                        <input type="number" id="kubik-in" class="col-lg-12" required>
                                        <label class="label-in">Kubik 2</label>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12  mt-1 mb-2 p-0">
                                    <div class="input-wrapper">
                                        <input type="text" id="kubik-2" class="col-lg-12" readonly>
                                        <label class="label-in">Kubik hasil</label>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12  mt-1 mb-2 p-0">
                                    <div class="input-wrapper">
                                        <input type="text" id="nominal" class="col-lg-12" readonly>
                                        <label class="label-in">Nominal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="demo">
                                <button type="submit" class="btn btn-outline-success btn-icon-text" id="btn-buat">
                                    <i class="ti-archive" id="icon-buat"> </i>
                                    <span id="btn-text-buat">Buat</span>
                                    <span id="loading-icon-buat" class="loading"
                                        style="display: inline-block; float: left; display:none;">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"
                                            preserveAspectRatio="xMidYMid" width="24" height="24" style="shape-rendering: auto; display: block; background: rgb(255, 255, 255, 0);
" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g>
                                                <g transform="translate(50 50)">
                                                    <g transform="scale(0.7)">
                                                        <g transform="translate(-50 -50)">
                                                            <g>
                                                                <animateTransform dur="0.7575757575757576s"
                                                                    keyTimes="0;1" values="0 50 50;360 50 50"
                                                                    repeatCount="indefinite" type="rotate"
                                                                    attributeName="transform"></animateTransform>
                                                                <path d="M50 50L50 0A50 50 0 0 1 100 50Z" fill="#e15b64"
                                                                    fill-opacity="0.8"></path>
                                                            </g>
                                                            <g>
                                                                <animateTransform dur="1.0101010101010102s"
                                                                    keyTimes="0;1" values="0 50 50;360 50 50"
                                                                    repeatCount="indefinite" type="rotate"
                                                                    attributeName="transform"></animateTransform>
                                                                <path transform="rotate(90 50 50)"
                                                                    d="M50 50L50 0A50 50 0 0 1 100 50Z" fill="#f47e60"
                                                                    fill-opacity="0.8"></path>
                                                            </g>
                                                            <g>
                                                                <animateTransform dur="1.5151515151515151s"
                                                                    keyTimes="0;1" values="0 50 50;360 50 50"
                                                                    repeatCount="indefinite" type="rotate"
                                                                    attributeName="transform"></animateTransform>
                                                                <path transform="rotate(180 50 50)"
                                                                    d="M50 50L50 0A50 50 0 0 1 100 50Z" fill="#f8b26a"
                                                                    fill-opacity="0.8"></path>
                                                            </g>
                                                            <g>
                                                                <animateTransform dur="3.0303030303030303s"
                                                                    keyTimes="0;1" values="0 50 50;360 50 50"
                                                                    repeatCount="indefinite" type="rotate"
                                                                    attributeName="transform"></animateTransform>
                                                                <path transform="rotate(270 50 50)"
                                                                    d="M50 50L50 0A50 50 0 0 1 100 50Z" fill="#abbd81"
                                                                    fill-opacity="0.8"></path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                                <g></g>
                                            </g>
                                        </svg>
                                    </span>
                                    <span style="display: inline-block; float: right; display:none;"
                                        class="pt-1 pl-1 loading-text">Loading...</span>
                                </button>

                            </div>
                        </div>
        </form>
    </div>
</div>
<div class="row mr-0 pr-0">
    <div class="col-md-12 col-lg-12 grid-margin stretch-card mr-0 pr-0">
        <div class="card">
            <div class="card-body pt-1 mt-1">
                <div class="row mb-1 pb-1">
                    <div class="col-md-12 grid-margin mb-0 pb-0">
                        <div class="row">
                            <div class="col-xl-8 mb-4 mb-xl-0 mb-1 pb-1">
                                <h4 class="font-weight-bold">Data Tagihan
                                </h4>
                            </div>
                            <div class="input-group pb-0">
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 p-2">
                                    <label class="label-select">Bulan</label>
                                    <select type="text" id="bln_filter" class="col-lg-12 mt-1 pt-1">
                                        <option value="">Pilih !!</option>
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
                                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 p-2">
                                    <label class="label-select">Tahun</label>
                                    <select type="text" id="thn_filter" class="col-lg-12 mt-1 pt-1">
                                        <option value="">Pilih !!</option>
                                        <?php
                                            foreach ($filter as $data) :
                                        ?>
                                        <option value="<?= $data->thn_tagihan; ?>"> &nbsp;
                                            <?= $data->thn_tagihan; ?></option>
                                        <?php
                                            endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 p-2">
                                    <label class="label-select">Status</label>
                                    <select type="text" id="status_filter" class="col-lg-12 mt-1 pt-1">
                                        <option value="">Pilih !!</option>
                                        <option value="0">Belum Bayar</option>
                                        <option value="2">Lunas</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pr-0 mr-0">
                        <div class="col-12 pr-0 mr-0">
                            <div class="table-responsive">
                                <table id="data-tagihan" class="display expandable-table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No. Invoice</th>
                                            <th>Nama || No Rumah</th>
                                            <th>Bulan</th>
                                            <th>Tahun</th>
                                            <th>Nominal</th>
                                            <th>Tagihan Lain</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php endif; ?>
<?php if ($userdata->role == 'Admin') : ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body pt-1 mt-1">
                        <div class="row mb-1 pb-1">
                            <div class="col-md-12 grid-margin mb-0 pb-0">
                                <div class="row">
                                    <div class="col-xl-8 mb-4 mb-xl-0 mb-1 pb-1">
                                        <h4 class="font-weight-bold">Data Tagihan
                                        </h4>
                                    </div>
                                    <div class="input-group pb-0">
                                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 p-2">
                                            <label class="label-select">Bulan</label>
                                            <select type="text" id="bln_filter" class="col-lg-12 mt-1 pt-1">
                                                <option value="">Pilih !!</option>
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
                                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 p-2">
                                            <label class="label-select">Tahun</label>
                                            <select type="text" id="thn_filter" class="col-lg-12 mt-1 pt-1">
                                                <option value="">Pilih !!</option>
                                                <?php
                                            foreach ($filter as $data) :
                                        ?>
                                                <option value="<?= $data->thn_tagihan; ?>"> &nbsp;
                                                    <?= $data->thn_tagihan; ?></option>
                                                <?php
                                            endforeach;
                                        ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 p-2">
                                            <label class="label-select">Status</label>
                                            <select type="text" id="status_filter" class="col-lg-12 mt-1 pt-1">
                                                <option value="">Pilih !!</option>
                                                <option value="0">Belum Bayar</option>
                                                <option value="2">Lunas</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="data-tagihan" class="display expandable-table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No. Invoice</th>
                                                    <th>Nama || No Rumah</th>
                                                    <th>Bulan</th>
                                                    <th>Tahun</th>
                                                    <th>Nominal</th>
                                                    <th>Tagihan Lain</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            </tbody>
                                            <tfoot>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php endif; ?>

<!-- kode javascript untuk manipulasi data -->
<script>
$(document).ready(function() {
    setInterval(function() {
        $.ajax({
            url: '<?php echo base_url('Data_tagihan/no_invoice') ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#invoice').val(response
                    .nomer);
            }
        });
    }, 5000);
});

$(document).ready(function() {
    $('.js-example-basic-single').select2({
        matcher: function(params, data) {
            var term = $.trim(params.term);
            if (term === '') {
                return data;
            }

            var badge = data.element.dataset.badge;
            if (data.text && badge) {
                if (data.text.toLowerCase().indexOf(term.toLowerCase()) > -1 ||
                    badge.toLowerCase().indexOf(term.toLowerCase()) > -1) {
                    return data;
                }
            }
            return null;
        },
        templateResult: function(data) {
            if (!data.id) {
                return data.text;
            }

            var badge = data.element.dataset.badge;
            if (badge) {
                var $result = $('<span><div class="badge badge-info">' + badge + '</div> ' +
                    data.text + '</span>');
                return $result;
            }

            return data.text;
        },
        templateSelection: function(data) {
            if (!data.id) {
                return data.text;
            }

            var badge = data.element.dataset.badge;
            if (badge) {
                var $result = $('<span><div class="badge badge-info">' + badge + '</div> ' +
                    data.text + '</span>');
                return $result;
            }

            return data.text;
        }
    });

    $('#id_warga').on('change', function() {
        var selectedOption = $(this).find('option:selected');
        var kaplingGabungan = selectedOption.data('kapling-gabungan');
        $('#kapling-gabungan').val(kaplingGabungan);

        calculateHasilIpl();
    });

    $('#kapling-gabungan').on('input', function() {
        calculateHasilIpl();
    });

    function calculateHasilIpl() {
        var kaplingGabungan = parseInt($('#kapling-gabungan').val());
        var lainLain = parseInt($('#lain-lain').val());
        var hasilIpl = 0;

        if (kaplingGabungan === 1) {
            hasilIpl = lainLain - 25000;
        } else if (kaplingGabungan === 0) {
            hasilIpl = lainLain;
        }

        $('#hasil-ipl').val(hasilIpl);
    }



    // Fungsi untuk mengambil data kubik dari server
    function getKubikData(id_warga) {
        $.ajax({
            type: 'GET',
            url: 'Data_tagihan/get_meter',
            data: {
                id_warga: id_warga
            },
            dataType: 'json',
            success: function(response) {
                $('#kubik-1').val(response.join(', '));
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    // akhir Fungsi untuk mengambil data kubik dari server

    $('.js-example-basic-single').on('change', function() {
        var selectedId = $(this).val();
        if (selectedId) {
            getKubikData(
                selectedId
            );
        } else {
            $('#kubik-1').val('');
        }
    });
    // kode ajax untuk membuat tagihan
    $('#buat-tagihan').submit(function(event) {
        event.preventDefault();

        $('#btn-text-buat').hide();
        $('#icon-buat').hide();
        $('#loading-icon-buat').show();
        $('.loading-text').show();
        $('#btn-buat').attr('disabled', true);

        var id_rtrw = $('#id-rtrw').val();
        var id_warga = $('#id_warga').val();
        var id_iuran = $('#id_iuran').val();
        var no_invoice = $('#invoice').val();
        var bln_tagihan = $('#bln_tagihan').val();
        var thn_tagihan = $('#thn_tagihan').val();
        var kubik1 = $('#kubik-1').val();
        var kubik_in = $('#kubik-in').val();
        var hasil_kubik = $('#kubik-2').val();
        var abunament = $('#abo1').val();
        var perkubik = $('#perkubik').val();
        var lain_lain = $('#hasil-ipl').val();
        var taxs = $('#taxs').val();
        var nominal = $('#nominal').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('Data_tagihan/buat_tagihan') ?>',
            data: {
                id_rtrw: id_rtrw,
                id_warga: id_warga,
                id_iuran: id_iuran,
                no_invoice: no_invoice,
                thn_tagihan: thn_tagihan,
                bln_tagihan: bln_tagihan,
                kubik1: kubik1,
                kubik_in: kubik_in,
                hasil_kubik: hasil_kubik,
                abunament: abunament,
                perkubik: perkubik,
                lain_lain: lain_lain,
                taxs: taxs,
                nominal: nominal,

            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    console.log(response);

                    Swal.fire({
                        position: "top-center",
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Tagihan Berhasil Dibuat.',
                    });

                    $('#btn-text-buat').show();
                    $('#icon-buat').show();
                    $('#loading-icon-buat').hide();
                    $('.loading-text').hide();
                    $('#btn-buat').attr('disabled', false);

                    // Bersihkan nilai input secara manual
                    $('#id_warga').val('');
                    $('#kubik-1').val('');
                    $('#kubik-in').val('');
                    $('#kubik-2').val('');
                    $('#nominal').val('');
                    // Bersihkan input lainnya sesuai kebutuhan
                    var table = $('#data-tagihan').DataTable();
                    table.ajax.reload(null, false);

                } else {
                    // console.error('Terjadi kesalahan saat validasi data di server.');

                    Swal.fire({
                        icon: 'warning',
                        title: 'Gagal!',
                        text: 'Data sudah Di Buat Tagihan Bulan ini.',
                    });

                    $('#btn-text-buat').show();
                    $('#icon-buat').show();
                    $('#loading-icon-buat').hide();
                    $('.loading-text').hide();
                    $('#btn-buat').attr('disabled', false);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $('#btn-text-buat').hide();
                $('#icon-buat').hide();
                $('#loading-icon-buat').show();
                $('.loading-text').show();
                $('#btn-buat').attr('disabled', false);

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat mengirim data ke server.',
                });
            }
        });
    });

    // datatable tagihan

});
</script>
<script>
$(document).ready(function() {
    var table;

    table = $('#data-tagihan').DataTable({
        "paging": true,
        "autoWidth": true,
        "search": true,
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?=site_url('Data_tagihan/get_trx')?>",
            "type": "POST",
            "data": function(d) {
                d.bln_filter = $('#bln_filter').val();
                d.status_filter = $('#status_filter').val();
                d.thn_filter = $('#thn_filter').val();
            }
        },

        "columnDefs": [{
                "targets": [1, 3, 4, 5, 8],
                "className": 'text-right'
            },
            {
                "targets": [2],
                "className": 'text-left'
            },
            {
                "targets": [0],
                "className": 'text-center'
            },
            {
                "targets": [4, 5, 6, 7, 8],
                "orderable": false
            },
        ]
    })
    $('#bln_filter, #status_filter, #thn_filter').on('change', function() {
        // debugging apakah nilai select muncul
        // console.log('Nilai select: ' + $(this).val());
        table.draw();
    });

})
</script>
<!-- akhirkode javascript untuk manipulasi data -->


<!-- kode javascrip untuk perhitungan iuran -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
//kode javascrip mengambil bulan dan tanggal hari ini
const selectBulan = document.getElementById('bln_tagihan');
const selectBln = document.getElementById('bln_filter');
const selectTahun = document.getElementById('thn_tagihan');
const selectThn = document.getElementById('thn_filter');

// Buat objek Date untuk mendapatkan bulan & tahun saat ini
const tanggalSekarang = new Date();
const tahunSekarang = new Date().getFullYear();

const indeksBulanSekarang = tanggalSekarang.getMonth();

const namaBulan = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];

// Set nilai default select sesuai dengan indeks bulan saat ini
selectBulan.selectedIndex = indeksBulanSekarang;
selectBln.value = namaBulan[indeksBulanSekarang];

// memilih tahun saat ini
for (let i = 0; i < selectTahun.options.length; i++) {
    if (parseInt(selectTahun.options[i].value) === tahunSekarang) {
        selectTahun.options[i].selected = true;
        break;
    }
}
for (let i = 0; i < selectThn.options.length; i++) {
    if (parseInt(selectThn.options[i].value) === tahunSekarang) {
        selectThn.options[i].selected = true;
        break;
    }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//  kode javascript untuk disable input jka ada isinya
function checkInputStatus() {
    var inputElement = document.getElementById('kubik-1');
    var inputWrapper = document.querySelector('.input-wrapper');

    if (inputElement.value.trim().length === 4) {
        inputElement.disabled = true;
        inputWrapper.classList.add(
            'disabled');
    } else {
        inputElement.disabled = false;
        inputWrapper.classList.remove('disabled');
    }
}

// Panggil fungsi checkInputStatus() saat halaman dimuat dan saat nilai input berubah
document.addEventListener('DOMContentLoaded', checkInputStatus);
document.getElementById('kubik-1').addEventListener('input', checkInputStatus);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

// kode untuk rumus menghitung biaya air.....
const kubik1Input = document.getElementById('kubik-1');
const kubikInInput = document.getElementById('kubik-in');
const kubik2Input = document.getElementById('kubik-2');
const hargaInput = document.getElementById('harga');
const harga1Input = document.getElementById('harga1');
const perawatanInput = document.getElementById('perawatan');
const abunamenInput = document.getElementById('abunamen');
const ab1Input = document.getElementById('abo1');
const nominalInput = document.getElementById('nominal');
const perkubikInput = document.getElementById('perkubik');
const taxInput = document.getElementById('taxs');

// Fungsi untuk menghitung dan menampilkan hasilnya di kubik-2 dan nominal
function hitungSelisih() {
    const kubik1Value = parseFloat(kubik1Input.value);
    const kubikInValue = parseFloat(kubikInInput.value);
    const hargaValue = parseFloat(hargaInput.value);
    const harga1Value = parseFloat(harga1Input.value);
    const perawatanValue = parseFloat(perawatanInput.value);
    const abunamenValue = parseFloat(abunamenInput.value);
    const abo1 = parseFloat(ab1Input.value);
    const perkubik = parseFloat(perkubikInput.value);

    // Cek apakah input valid (berupa angka)
    if (!isNaN(kubik1Value) && !isNaN(kubikInValue) && !isNaN(hargaValue) && !isNaN(perawatanValue)) {
        const hasilKubik = kubikInValue - kubik1Value;

        kubik2Input.value = hasilKubik;

        let hargaHasil;

        if (hasilKubik <= 10) {
            hargaHasil = hasilKubik * hargaValue;
        } else {
            hargaHasil = hasilKubik * harga1Value;
        }

        const hargafix = hargaHasil + perawatanValue;

        if (hasilKubik <= 1) {
            ab1Input.value = abunamenValue;
            nominalInput.value = abunamenValue;
            perkubikInput.value = '';
        } else {
            ab1Input.value = perawatanValue;
            nominalInput.value = hargafix;
            if (hasilKubik <= 10) {
                perkubikInput.value = hargaValue;

            } else {
                perkubikInput.value = harga1Value;
            }
        }
    }
}

// Pasang event handler untuk memanggil fungsi hitungSelisih saat input berubah
kubik1Input.addEventListener('input', hitungSelisih);
kubikInInput.addEventListener('input', hitungSelisih);
hargaInput.addEventListener('input', hitungSelisih);
// akhir kode untuk rumus menghitung biaya air.....
</script>