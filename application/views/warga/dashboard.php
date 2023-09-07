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
        padding: 15px 11px !important;
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
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome <i class="text-info"><?php echo $userdata->nama; ?></i>
                        </h3>
                        <!-- <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6> -->
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
                                <p class="mb-2 font-weight-bold">Tunggakan</p>
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
                            class="text-danger status-inv">BELUM DIBAYAR</i></h4>
                    <p class="text-inv"></p>
                </div>
            </div>
            <hr class="ml-3 mr-3 mb-0">
            <div class="row mx-auto">
                <div class="col-lg-6 col-md-6 col-12 mt-3">
                    <h5>Ditagihkan Ke :</h5>
                    <p class="mb-0"><?= $data->nama; ?> | <?php echo $userdata->no_rumah; ?></p>
                    <p class="mb-0"><?= $data->nm_perum; ?> NO.<?= $data->no_rumah; ?> RT/<?= $data->rt; ?>
                        RW/<?= $data->rw; ?></p>
                    <p class="mb-0"><?= $data->no_hp; ?></p>
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-3">
                    <h5 class=" text-byr">Dibayarkan ke :</h5>
                    <p class="mb-0 text-byr">Pengelola <?= $data->nm_perum; ?></p>
                </div>
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
                <div class="col">
                    <button type="submit" class="btn btn-primary float-right btn-bayar col-12">Buat pembayaran</button>
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
                <div class="modal-body pt-1 pl-2 pr-2 pb-1">
                    <div class="row">
                        <div class="col-lg-7 col-md-7 col-12">
                            <div class="input-wrapper">
                                <div class="input-group">
                                    <span class="input-group-text text-body"><i class="ti-calendar"></i></span>
                                    <input type="text" class="form-control" id="tgl-upload"
                                        placeholder=" Pilih Range Tanggal" disabled>
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
                    <!-- <div class="col"> -->
                    <center>
                        <img id="preview-bukti" src="" class="img-fluid" style="max-width: 50%;">
                    </center>
                    <!-- </div> -->
                </div>
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
                        // footer: "<a href="#">Why do I have this issue?</a>"
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
            // alert($(this).val());
            var $btn = $(this);
            var originalText = $btn.find('#btn-text').text();

            $btn.find('#btn-text').addClass('d-none');
            $btn.find('#btn-loader').removeClass('d-none');

            if ($(this).val() == 'buat') {
                let formData = new FormData();
                formData.append('id-tagihan', $('#id-tagihan').val());
                formData.append('tgl-upload', $('#tgl-upload').val());
                formData.append('tagihan', $('#tagihan-val').val());

                $.ajax({
                    type: 'POST',
                    url: "<?php echo site_url('Dashboard/buat_pembayaran'); ?>",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // if (data.status) {
                        //     window.location.href = data.detail.redirect_url;
                        //     load_info();
                        //     $('#modal-bayar').modal('hide');
                        // }

                        if (data.status) {
                            window.open(data.detail.redirect_url);
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
            } else if ($(this).val() == 'konfirmasi') {
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
        // $('.count-tgl').attr('hidden', true);
        $('#col-btn-byr').attr('hidden', true);
        $('.upload-bukti').hide();
        $('.status-inv').text('BELUM BAYAR');
        $('.btn-bayar').text('Buat pembayaran').removeClass('btn-warning').addClass('btn-primary');
        $('#btn-kirim').val('buat')
        load_data(action, status);
    };

    function konf_byr() {
        var action = 'konf-byr';
        var status = '1';
        // $('.count-tgl').removeAttr('hidden', true);
        $('#col-btn-byr').removeAttr('hidden', true);
        $('.upload-bukti').show();
        $('.status-inv').text('MENUNGGU PEMBAYARAN');
        $('.btn-bayar').text('Konfirmasi pembayaran').removeClass('btn-primary').addClass('btn-warning')
        $('#btn-kirim').val('konfirmasi')
        load_data(action, status);

    }

    function load_data(action, status) {
        let formData = new FormData();
        formData.append('action', action);
        formData.append('status', status);
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
                    } else {
                        $('.open-' + $(this).data('id-tagihan')).attr('hidden', true)
                            .removeClass('open-' + $(this).data('id-tagihan'))
                            .addClass('rinc-' + $(this).data('id-tagihan'), true);
                        $(this).text('Lihat Rincian').removeClass('text-danger');
                    }
                });
                $('#subtotal').val('0')
                $('#id-tagihan').val('')
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
                    $('#subtotal').val(total)
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
        $.ajax({
            // type: 'POST',
            url: "<?php echo site_url('Dashboard/info'); ?>",
            // data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                // alert(data);
                $('#load-info').html(data);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    }
    $(function() {
        $('#tgl-upload').daterangepicker({
            "setDate": new Date(),
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            locale: {
                format: 'DD-MM-YYYY'
            }

        });
    });
    </script>