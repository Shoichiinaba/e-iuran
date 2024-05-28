<style>
.border-bg-inv {
    background: white;
    border: 2px solid #0000001c;
    border-radius: 15px;
    padding: 3rem;
}

.text-inv,
.text-byr {
    text-align: right;
}


.table.dataTable {
    border-spacing: 1px !important;
}

.remove-p-l {
    padding: 0px 10px 0px 0px;
}

.remove-p-r {
    padding: 0px 0px 0px 10px;
}

@media all and (orientation: portrait) {
    .border-bg-inv {
        padding: 2px;
    }

    .logo-e {
        left: 15%;
        right: auto;
    }

    .text-byr {
        text-align: left;
    }

    .text-inv {
        text-align: center;
    }

    .content-wrapper {
        padding: 48px 11px !important;
    }

    .remove-p-l,
    .remove-p-r {
        padding: 0;
    }
}

@media only screen and (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {}

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

div:where(.swal2-icon) {
    top: 32px;
}

#btn-loader {
    background-color: none;
    border: none;
    color: white;
    padding: 12px 24px;
    font-size: 16px;
}

.bg-active-tr {
    background: navajowhite;
}

.tr-ceklis-bayar {
    background: linear-gradient(45deg, #89ff00, transparent);
    font-weight: bold;
}
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome <i class="text-info"><?php echo $userdata->nama; ?></i>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="transparent">
                <div class="row">
                    <div id="btn-tunggakan" class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-2 font-weight-bold">Tagihan Belum Dibayar</p>
                                <p class="fs-30 mb-2 info-total-tagihan"></p>
                                <p class="info-tunggakan">2 Bulan</p>
                            </div>
                        </div>
                    </div>
                    <div id="btn-konf-byr" class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-2 font-weight-bold">Menunggu Pembayaran </p>
                                <p class="fs-30 mb-2 info-total-konf-byr">Rp.0</p>
                                <p class="info-konf-byr">0 Bulan</p>
                                <div class="row">
                                    <div class="col">
                                        <span class="count-tgl">Berakhir : <div class="float-right" id="countdown">
                                            </div></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="load-info"></div>
        </div>
        <div id="inv-content" class=" border-bg-inv mb-3">
            <?php foreach ($biodata as $data) {
                $nm_perum = $data->nm_perum;
            ?>
            <div class="row mx-auto mt-5 mb-4">
                <div class="col-lg-6 col-md-6 col-12 logo-e">
                    <img src="<?= base_url('assets'); ?>/images/logo_e/hicare.png" class="mr-2" alt="-iuran"
                        style="height: auto;width: 10rem;">
                    <i style="font-size: 36px;font-weight: bold;top: 8px;position: absolute;"></i>
                </div>
                <div class="col-lg-6 col-md-6 col-12 pt-2">
                    <h4 class="text-inv mb-0"
                        style="font-weight: bold;font-family: sans-serif; top: 27px; position: relative;">STATUS | <i
                            class="text-danger status-inv"></i></h4>
                    <p class="text-inv"></p>
                </div>
            </div>
            <hr class="ml-3 mr-3 mb-0">
            <div class="row mx-auto">
                <div class="col-lg-6 col-md-6 col-12 mt-3">
                    <h5>Ditagihkan Ke :</h5>
                    <p class="mb-0"><?= $data->nama; ?> | <?php echo $data->no_rumah; ?></p>
                    <p class="mb-0"><?= $data->nm_perum; ?> NO.<?= $data->no_rumah; ?>
                        RT/<?= $data->rt; ?>RW/<?= $data->rw; ?></p>
                    <p class="mb-0"><?= $data->no_hp; ?></p>
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-3">
                    <h5 class=" text-byr">Dibayarkan ke :</h5>
                    <p class="mb-0 text-byr">Pengelola <?= $data->nm_perum; ?></p>
                </div>
                <input type="hidden" id="id-warga" value="<?= $data->id_warga; ?>">
                <input type="hidden" id="status-segel" value="<?= $data->status_segel; ?>">
            </div>
            <?php }; ?>
            <div class="row pl-3 pr-3">
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Ringkasan pembayaran</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class=" expandable-table dataTable table"
                                    style="width: 100%;display: table;overflow: auto;"
                                    aria-describedby="data-perum_info">
                                    <tbody id="load-data">

                                    </tbody>
                                </table>
                            </div>

                            <input type="text" id="id-tagihan" value="" hidden>
                            <input type="text" id="subtotal" value="0" hidden>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pl-3 pr-3">
                <div id="col-btn-byr" class="col" hidden>
                    <button type="submit" class="btn btn-danger float-right col-12 btn-batal-byr">Batalkan
                        pembayaran</button>
                </div>
                <div class="col mt-2 mb-2">
                    <button type="submit" class="btn btn-primary float-right btn-bayar col-12">Buat pembayaran</button>
                    <?php
                    if ($transaksi) {
                        $url = $transaksi[0]->url_payment;
                    ?>
                    <a href="<?php echo $url; ?>">
                        <button class="btn btn-warning float-right col-12">Lanjutkan Pembayaran</button>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="modal-bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bayar tagihan</h5>
                </div>
                <?php if ($userdata->role == 'Warga'): ?>
                <div class="modal-body pt-1 pl-2 pr-2 pb-1">
                    <div class="row" hidden>
                        <div class="col-lg-7 col-md-7 col-12">
                            <div class="input-wrapper">
                                <div class="input-group">
                                    <span class="input-group-text text-body"><i class="ti-calendar"></i></span>
                                    <input type="text" class="form-control" id="tgl-upload" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="input-wrapper">
                                <label class="label-in">Bulan</label>
                                <input type="text" id="bulan-val" class="col-lg-12" value="" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-wrapper">
                                <label class="label-in">Total</label>
                                <input type="text" id="tagihan-val" class="col-lg-12" value="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 upload-bukti">
                        <div class="input-group col-xs-12">
                            <input type="file" id="file-upload" hidden>
                            <input type="text" class="form-control file-upload-info" disabled=""
                                placeholder="Upload bukti bayar">
                            <span class="input-group-append">
                                <button id="btn-upload" class="file-upload-browse btn btn-primary"
                                    type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row ">
                </div>
                <?php elseif ($userdata->role == 'Finance'): ?>
                <div class="modal-body pt-1 pl-2 pr-2 pb-1">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="input-wrapper">
                                <div class="input-group">
                                    <span class="input-group-text text-body"><i class="ti-calendar"></i></span>
                                    <input type="date" class="form-control" id="tgl-byr">
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php foreach ($biodata as $data) {

                    ?>

                    <input type="hidden" id="id-warga" class="col-lg-12" value="<?= $data->id_warga; ?>">
                    <input type="hidden" id="id-rtrw" class="col-lg-12" value="<?= $data->id_rtrw; ?>">
                    <input type="hidden" id="id-perum" class="col-lg-12" value="<?= $data->id_perum; ?>">
                    <input type="hidden" id="no-rumah" class="col-lg-12" value="<?= $data->no_rumah; ?>">

                    <?php }; ?>

                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="input-wrapper">
                                <label class="label-in">Bulan</label>
                                <input type="text" id="bulan-val" class="col-lg-12" value="" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-wrapper">
                                <label class="label-in">Total</label>
                                <input type="text" id="tagihan-val" class="col-lg-12" value="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 upload-bukti">
                        <div class="input-group col-xs-12">
                            <input type="file" id="file-upload" hidden>
                            <input type="text" class="form-control file-upload-info" disabled=""
                                placeholder="Upload bukti bayar">
                            <span class="input-group-append">
                                <button id="btn-upload" class="file-upload-browse btn btn-primary"
                                    type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <hr>
                <div class="row pl-3 pr-3 mb-3">
                    <button type="button" id="btn-kirim" class="btn btn-success col-12" data-dismiss="modal"
                        value="buat">
                        <span id="btn-text">Submit</span>
                        <span id="btn-loader" class="d-none">
                            <span class="spinner-border spinner-border-sm btn-loader" role="status"
                                aria-hidden="true"></span>
                            Loading...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- date range picker JS -->
    <script src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
    $(document).ready(function() {
        load_info();

        $('.btn-bayar').click(function() {
            if ($('.btn-bayar').val() == "disabled") {
                $(function() {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Selesaikan pembayaran terlebih dahulu atau batalkan pembayaran jika ingin membuat tagihan baru..",
                    }).then(function() {
                        window.location = "<?= base_url('Dashboard'); ?>";
                    });

                });
            }
            $('#modal-bayar').modal('hide');

            var total_tagihan = $('.total-tagihan').text();
            var total_bulan = $('.total-bulan').text();
            $('#tagihan-val').val(total_tagihan);
            $('#bulan-val').val(total_bulan);
        });

        $(document).on("click", "#btn-upload", function() {
            var file = $(this).parents().find("#file-upload");
            file.trigger("click");
        });
        $('#file-upload').change(function(e) {
            var fileName = e.target.files[0].name;
            $(".file-upload-info").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("preview-bukti").src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        });

        $('#btn-kirim').click(function() {
            var $btn = $(this);
            var originalText = $btn.find('#btn-text').text();
            var role = "<?php echo $this->session->userdata('userdata')->role; ?>";
            var url = '';

            $btn.find('#btn-text').addClass('d-none');
            $btn.find('#btn-loader').removeClass('d-none');
            $btn.prop('disabled', true); // Disable button to prevent multiple clicks

            if ($btn.val() == 'buat') {
                let formData = new FormData();

                formData.append('id-tagihan', $('#id-tagihan').val());
                formData.append('tagihan', $('#tagihan-val').val());
                formData.append('periode', $('#bulan-val').val());

                if (role === 'Warga') {
                    url = "<?php echo site_url('Dashboard/buat_pembayaran'); ?>";
                } else if (role === 'Finance') {
                    formData.append('tgl_byr', $('#tgl-byr').val());
                    formData.append('id_warga', $('#id-warga').val());
                    formData.append('id_rtrw', $('#id-rtrw').val());
                    formData.append('id_perum', $('#id-perum').val());
                    formData.append('no_rumah', $('#no-rumah').val());
                    url = "<?php echo site_url('Dashboard/pembayaran_cash'); ?>";
                }

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var isJSON = false;
                        try {
                            var parsedResponse = JSON.parse(response);
                            isJSON = true;
                        } catch (e) {
                            isJSON = false;
                        }

                        if (isJSON) {
                            response = parsedResponse;
                            if (response.status) {
                                if (role === 'Warga') {
                                    $('.btn-bayar').show();
                                    window.location.href = response.detail.redirect_url;
                                } else if (role === 'Finance') {
                                    Swal.fire({
                                        position: "top-center",
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Pembayaran CASH Berhasil',
                                        timer: 1400
                                    });
                                }
                                load_info();
                                $('#modal-bayar').modal('hide');
                            } else {
                                alert("Terjadi kesalahan pada data yang diterima.");
                            }
                        } else {

                            if (role === 'Warga') {
                                $('.btn-bayar').show();
                                window.location.href = response.detail.redirect_url;

                            } else {
                                alert("Response tidak valid untuk peran Finance.");
                            }
                            load_info();
                            $('#modal-bayar').modal('hide');
                        }
                    },
                    error: function() {
                        $('#btn-tunggakan').trigger('click');
                        alert("Data Gagal Diupload");
                    },
                    complete: function() {
                        $btn.find('#btn-text').removeClass('d-none');
                        $btn.find('#btn-loader').addClass('d-none');
                        $btn.prop('disabled', false);
                    }
                });
            } else if ($btn.val() == 'konfirmasi') {
                const foto_bukti = $('#file-upload').prop('files')[0];
                let formData = new FormData();
                formData.append('code-tagihan', $('#code-tagihan').val());
                formData.append('foto-bukti', foto_bukti);

                $.ajax({
                    type: 'POST',
                    url: "<?php echo site_url('Dashboard/upload_bukti'); ?>",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        load_info();
                        $('#modal-bayar').modal('hide');
                    },
                    error: function() {
                        alert("Data Gagal Diupload");
                    },
                    complete: function() {
                        $btn.find('#btn-text').removeClass('d-none');
                        $btn.find('#btn-loader').addClass('d-none');
                        $btn.prop('disabled', false);
                    }
                });
            }
        });

    });

    $('.upload-bukti').hide();
    $('#btn-tunggakan').click(function() {
        if ($(".info-konf-byr").text() == "0 Bulan") {} else {
            $(".btn-bayar").removeAttr("data-bs-toggle", "modal").removeAttr("data-bs-target", "#modal-bayar")
                .val("disabled");
        }
        tunggakan();
    });
    $('#btn-konf-byr').click(function() {
        if ($('.info-konf-byr').text() == '0 Bulan') {
            // alert('yaa')
        } else {
            konf_byr();
            $(".btn-bayar").attr("data-bs-toggle", "modal").attr("data-bs-target", "#modal-bayar").val("");

        }

    });

    $('.btn-batal-byr').click(function() {
        var el = this;
        var confirmalert = confirm("Are you sure?");
        if (confirmalert == true) {
            delete_tagihan();
        }
    });

    function delete_tagihan() {
        let formData = new FormData();
        formData.append('code-tagihan', $('#code-tagihan').val());
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('Dashboard/batal_byr'); ?>",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                // alert(data);
                window.location.replace("<?= base_url('Dashboard'); ?>");
                // tunggakan();
                // $('#inv-content').attr('hidden', true);
                // $('.btn-riwayat-anda').trigger('click')
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    }

    function tunggakan() {

        var action = 'tunggakan'
        var status = '0';
        if ($('.info-total-tagihan').text() === 'Rp. 0') {
            $(".status-inv").text("Tidak Ada Tagihan");
            $('.btn-bayar').text('Buat pembayaran').removeClass('btn-warning').addClass('btn-primary').hide();
        } else {

            $('.status-inv').text('BELUM BAYAR');
            $('.btn-bayar').text('Buat pembayaran').removeClass('btn-warning').addClass('btn-primary');
        }
        $('#col-btn-byr').attr('hidden', true);
        $('.upload-bukti').hide();
        $('#btn-kirim').val('buat')
        load_data(action, status);

    };

    function konf_byr() {
        var action = 'konf-byr';
        var status = '1';
        // $('.count-tgl').removeAttr('hidden', true);
        $('.btn-bayar').hide();
        $('#col-btn-byr').removeAttr('hidden', true);
        $('.upload-bukti').show();
        $('.status-inv').text('MENUNGGU PEMBAYARAN');
        $('.btn-bayar').text('Konfirmasi pembayaran').removeClass('btn-primary').addClass('btn-warning');
        $('#btn-kirim').val('konfirmasi')
        load_data(action, status);

    }

    function load_data(action, status) {
        let formData = new FormData();
        formData.append('action', action);
        formData.append('status', status);

        var id_warga = $('#id-warga').val();
        var status_segel = $('#status-segel').val();
        formData.append('id_warga', id_warga);
        formData.append('status_segel', status_segel);

        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('Dashboard/get_data_blm_bayar'); ?>",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                // alert(data);
                $('#load-data').html(data);
                $('.lihat-rinc').click(function() {
                    // alert($(this).text())
                    if ($(this).text() == 'Lihat Rincian') {
                        $('.rinc-' + $(this).data('id-tagihan')).removeAttr('hidden', true)
                            .addClass('open-' + $(this).data('id-tagihan'))
                            .removeClass('rinc-' + $(this).data('id-tagihan'), true);
                        $(this).text('Tutup rincian').addClass('text-danger');
                        $('.tr-bg-' + $(this).data('id-tagihan')).addClass('bg-active-tr');
                    } else {
                        $('.open-' + $(this).data('id-tagihan')).attr('hidden', true)
                            .removeClass('open-' + $(this).data('id-tagihan'))
                            .addClass('rinc-' + $(this).data('id-tagihan'), true);
                        $(this).text('Lihat Rincian').removeClass('text-danger');
                        $('.tr-bg-' + $(this).data('id-tagihan')).removeClass('bg-active-tr')
                    }
                });
                // $('#subtotal').val('0')
                // $('#id-tagihan').val('')
                $('.form-check-input').click(function() {
                    if ($(this).is(":checked")) {
                        $(".btn-bayar").attr("data-bs-toggle", "modal").attr("data-bs-target",
                            "#modal-bayar").val("");
                        total = parseInt($('#subtotal').val()) + parseInt($(this).data('jumlah'));
                    } else {
                        total = parseInt($('#subtotal').val()) - parseInt($(this).data('jumlah'));
                        if (total == '0') {
                            // alert('yaa');
                            $(".btn-bayar").removeAttr("data-bs-toggle", "modal").removeAttr(
                                "data-bs-target", "#modal-bayar").val("");
                        }
                    }
                    $('.total-bulan').text($(":checkbox:checked").length + ' Bulan')
                    // $('#subtotal').val(parseInt(total) * parseInt('5') / 100 + parseInt(total))
                    $('#subtotal').val(total);
                    $('.total-tagihan').text('Rp. ' + total.toString().replace(
                        /\B(?=(\d{3})+(?!\d))/g, '.'));
                    $('#id-tagihan').val($('.form-check-input:checked').val())
                    var checkboxes = $('.form-check-input');
                    var result = "";
                    for (var i = 0; i < checkboxes.length; i++) {
                        if (checkboxes[i].checked) {
                            result += checkboxes[i].value + ",";
                        }
                    }
                    $('#id-tagihan').val(result)
                    // document.write("<p> You have selected : " +
                    //     result + "</p>");
                });
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    }

    function load_info() {
        var id_warga = $('#id-warga').val();

        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('Dashboard/info'); ?>",
            data: {
                id_warga: id_warga
            },
            cache: false,
            success: function(data) {
                $('#load-info').html(data);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    }
    </script>