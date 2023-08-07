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

    .Belumbayar {
        background: #f2a2a7;
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
                    <div class="col-md-6 mb-3 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <h3 class=" mb-4 info-tunggakan font-weight-bold">Bulan</h3>
                                <h5 class="mb-2">Tunggakan</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <h3 class="mb-4 info-total-tagihan font-weight-bold"></h3>
                                <h5 class=" mb-2">Total tagihan</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="inv-content" class=" border-bg-inv mb-3" hidden>
            <?php foreach ($biodata as $data) : ?>
                <div class="row mx-auto mt-5 mb-4">
                    <div class="col-lg-6 col-md-6 col-12 logo-e">
                        <img src="<?= base_url('assets'); ?>/images/logo_e/logoe.png" class="mr-2" alt="-iuran" style="height: auto;width: 6rem;">
                        <i style="font-size: 36px;font-weight: bold;top: 8px;position: absolute;">iuran</i>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 pt-2">
                        <h4 class="text-inv mb-0" style="font-weight: bold;font-family: sans-serif;">INVOICE | <i class="text-danger">BELUM DIBAYAR</i></h4>
                        <p class="text-inv"></p>
                    </div>
                </div>
                <hr class="ml-3 mr-3 mb-0">
                <div class="row mx-auto">
                    <div class="col-lg-6 col-md-6 col-12 mt-3">
                        <h5>Ditagihkan Ke :</h5>
                        <p class="mb-0"><?= $data->nama; ?> | <?php echo $userdata->no_rumah; ?></p>
                        <p class="mb-0"><?= $data->nm_perum; ?> NO.<?= $data->no_rumah; ?> RT/<?= $data->rt; ?> RW/<?= $data->rw; ?></p>
                        <p class="mb-0"><?= $data->no_hp; ?></p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mt-3">
                        <h5 class=" text-byr">Dibayarkan ke :</h5>
                        <p class="mb-0 text-byr">Pengelola <?= $data->nm_perum; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="row pl-3 pr-3">
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Ringkasan pembayaran</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class=" expandable-table dataTable table" style="width: 100%;display: table;overflow: auto;" aria-describedby="data-perum_info">
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        $count_air = 0;
                                        $count_iuran = 0;
                                        $jumlah = 0;
                                        foreach ($tagihan_air as $data) :
                                            $id_tagihan = $data->id_tagihan;
                                            $ipl = $data->lain_lain;
                                            $no++;
                                            
                                            $count_air += $data->nominal;
                                            $count_iuran += $data->lain_lain;
                                            $jumlah = $data->lain_lain += $data->nominal;
                                            // $total_tagihan = ;
                                        ?>
                                            <tr style="background: #4b49ac;color: white;">
                                                <td class="">Bulan</td>
                                                <td class=""><?= $data->bln_tagihan; ?> / <?= $data->thn_tagihan; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="">IPL <?= $ipl; ?></td>
                                                <td class="">Rp.<?= number_format($ipl, 0, ',', '.'); ?></td>
                                            </tr>
                                            <tr class="rinc-<?= $data->id_tagihan; ?>" hidden>
                                                <td colspan="2" class="text-center" style="background: aquamarine;font-weight: bold;color: cornflowerblue;">Rincian Penggunaan air</td>
                                            </tr>
                                            <tr class="rinc-<?= $data->id_tagihan; ?>" hidden>
                                                <td class="">Awal</td>
                                                <td class=""><?= $data->kubik1; ?></td>
                                            </tr>
                                            <tr class="rinc-<?= $data->id_tagihan; ?>" hidden>
                                                <td class="">Akhir</td>
                                                <td class=""><?= $data->kubik_in; ?></td>
                                            </tr>
                                            <tr class="rinc-<?= $data->id_tagihan; ?>" hidden>
                                                <td class="">Pemakaian</td>
                                                <td class=""><?= $data->hasil_kubik; ?></td>
                                            </tr>
                                            <tr class="rinc-<?= $data->id_tagihan; ?>" hidden>
                                                <td class="">Tarif</td>
                                                <td class="">Rp.<?= number_format($data->perkubik, 0, ',', '.'); ?></td>
                                            </tr>
                                            <tr class="rinc-<?= $data->id_tagihan; ?>" hidden>
                                                <td class="">Abunamen</td>
                                                <td class="">Rp.<?= number_format($data->abunament, 0, ',', '.'); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="">Bayar air</td>
                                                <td class="">Rp.<?= number_format($data->nominal, 0, ',', '.'); ?> | <a href="javascript:void(0)" type="button" class="lihat-rinc" data-id-tagihan="<?= $data->id_tagihan; ?>">Lihat Rincian</a></td>
                                            </tr>
                                            <tr>
                                                <?php
                                                ?>
                                                <td class="">Jumlah</td>
                                                <td class="">
                                                    <div class=" form-check form-check-success m-0">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input cheklis-bayar" data-jumlah="<?= $jumlah; ?>" value="<?= $data->id_tagihan; ?>">
                                                            Rp.<?= number_format($jumlah, 0, ',', '.'); ?> |
                                                            <i class=" input-helper" style="color: #0090ff;cursor: pointer;"> Cheklis untuk bayar</i>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        endforeach
                                        ?>
                                        <tr style="background: aliceblue; font-weight: bold;">
                                            <td>Total bulan dibayar</td>
                                            <td class="total-bulan">0 Bulan</td>
                                        </tr>
                                        <tr style="background:#2196f345; font-weight: bold;">
                                            <td>Total bayar</td>
                                            <td class="total-tagihan">Rp.0</td>
                                        </tr>
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
                <div class="col">
                    <button type="submit" class="btn btn-primary float-right btn-bayar" data-bs-toggle="modal" data-bs-target="#modal-bayar">Bayar</button>
                </div>
            </div>
            <!-- <div class="row pl-3 pr-3">
                <h4>Keterangan :</h4>
                <u class="ml-4">
                    <li></li>
                    <li>1</li>
                    <li>1</li>
                    <li>1</li>
                </u>
            </div> -->
        </div>
        <!-- <div class="row"> -->
        <div class="card p-3 pb-3">
            <ul class="pl-0 mb-0" style="display: flex;list-style: none;">
                <li class="mr-2">
                    <button type="submit" class="btn btn-primary btn-md btn-riwayat-anda">Riwayat transaksi anda</button>
                </li>
                <li>
                    <button type="submit" class="btn btn-light btn-md btn-riwayat-warga">Riwayat transaksi warga</button>
                </li>
            </ul>
            <!-- <div class="card-body"> -->
            <div id="load-data-riwayat"></div>
            <!-- </div> -->
        </div>
        <!-- </div> -->
    </div>
    <div class="modal fade" id="modal-bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bayar tagihan</h5>
                </div>
                <div class="modal-body pt-1 pl-2 pr-2 pb-1">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-8">
                            <div class="input-wrapper">
                                <div class="input-group">
                                    <span class="input-group-text text-body"><i class="ti-calendar"></i></span>
                                    <input type="text" class="form-control" id="tgl-upload" placeholder=" Pilih Range Tanggal" disabled>
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
                    <div class="row mt-3">
                        <div class="input-group col-xs-12">
                            <input type="file" id="file-upload" hidden>
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload bukti bayar">
                            <span class="input-group-append">
                                <button id="btn-upload" class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col"> -->
                    <center>
                        <img id="preview-bukti" src="" class="img-fluid" style="max-width: 50%;">
                    </center>
                    <!-- </div> -->
                </div>
                <hr>
                <div class="row pl-3 pr-3 mb-3">
                    <button type="button" id="btn-kirim" class="btn btn-success col-12 btn-bayar" data-dismiss="modal">Kirim</button>
                </div>
            </div>
        </div>
    </div>
    <!-- date range picker JS -->
    <script src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.btn-bayar').click(function() {
                var total_tagihan = $('.total-tagihan').text();
                var total_bulan = $('.total-bulan').text();
                $('#tagihan-val').val(total_tagihan);
                $('#bulan-val').val(total_bulan);
            });
            $('.info-tunggakan').text('<?= $no; ?> Bulan');
            $('.info-total-tagihan').text('Rp.<?= number_format($count_iuran += $count_air, 0, ',', '.'); ?>');

            if ('<?= $no; ?>' == '0') {
                $('#inv-content').attr('hidden', true);
            } else {
                $('#inv-content').removeAttr('hidden', true);
            }
        });
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
        $('.form-check-input').click(function() {
            if ($(this).is(":checked")) {
                total = parseInt($('#subtotal').val()) + parseInt($(this).data('jumlah'));
            } else {
                total = parseInt($('#subtotal').val()) - parseInt($(this).data('jumlah'));
            }
            $('.total-bulan').text($(":checkbox:checked").length + ' Bulan')
            $('#subtotal').val(total)
            $('.total-tagihan').text('Rp. ' + total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
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

        $(document).on("click", "#btn-upload", function() {
            var file = $(this).parents().find("#file-upload");
            file.trigger("click");
        });
        $('#file-upload').change(function(e) {
            var fileName = e.target.files[0].name;
            $(".file-upload-info").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview-bukti").src = e.target.result;

            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });

        $('#btn-kirim').click(function() {
            const foto_bukti = $('#file-upload').prop('files')[0];
            let formData = new FormData();
            formData.append('id-tagihan', $('#id-tagihan').val());
            formData.append('tgl-upload', $('#tgl-upload').val());
            formData.append('tagihan', $('#tagihan-val').val());
            formData.append('foto-bukti', foto_bukti);
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('Dashboard/upload_bukti'); ?>",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    alert(data);
                    $('#modal-bayar').modal('hide');
                    // $('#inv-content').attr('hidden', true);
                    $('.btn-riwayat-anda').trigger('click')
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
        });
        $('.btn-riwayat-anda').click(function() {
            $('.btn-riwayat-anda').addClass('btn-primary').removeClass('btn-light')
            $('.btn-riwayat-warga').addClass('btn-light').removeClass('btn-primary')
            var action = 'anda';
            get_data_riwayat(action);
        });
        $('.btn-riwayat-warga').click(function() {
            $('.btn-riwayat-warga').addClass('btn-primary').removeClass('btn-light')
            $('.btn-riwayat-anda').addClass('btn-light').removeClass('btn-primary')
            var action = 'warga';
            get_data_riwayat(action);
        });
        var action = 'anda';
        get_data_riwayat(action)

        function get_data_riwayat(action) {
            // alert(action);
            let formData = new FormData();
            formData.append('action', action);

            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('Dashboard/get_data_riwayat'); ?>",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#load-data-riwayat').html(data);

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