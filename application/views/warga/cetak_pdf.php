<!DOCTYPE html>
<html>

<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title><?= $_tittle; ?></title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <style>
        .float-right {
            float: right;
        }

        .float-left {
            float: left;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .mt-2rem {
            margin-top: 2rem;
        }

        .pb-3rem {
            padding-bottom: 3rem !important;
        }

        .table>thead>tr>th {
            border: 2px solid;
            border-top: 2px solid !important;
            background: #3F51B5;
            color: white;
            letter-spacing: 2px;
        }

        .table>tbody>tr>td {
            border: 1px solid !important;
            border-top: 1px solid !important;
            /* background: #3F51B5; */
            /* color: white; */
            /* letter-spacing: 2px; */
        }

        .sup {
            font-size: 100%;
            vertical-align: super;
        }

        /* .table>tbody>tr>td {
            border: 1px solid;
            border-top: 1px solid !important;
        } */

        /* .table.dataTable {
            border-spacing: 1px !important;
        } */

        /* .text-left {
            text-align: right;
            margin-bottom: 0;
        } */
    </style>
</head>

<body>
    <?php
    // $jumlah = 0;
    foreach ($data_invoice as $data) :
    ?>
        <div style="margin-right: 6rem;">
            <div class="row">
                <div class="col-xs-6 logo-e">
                    <img class="mt-2rem" src="<?= base_url('assets'); ?>/images/logo_e/hicare.png" style="height: auto;width: 20rem;">
                    <!-- <i style="font-size: 36px;font-weight: bold;top: 8px;position: absolute;"></i> -->
                </div>
                <div class="col-xs-6 pt-2">
                    <h3 class="text-right" style="font-weight: bold;font-family: sans-serif; top: 27px; position: relative;">INVOICE | <i class="text-danger status-inv">LUNAS</i></h3>
                    <br>
                    <p class="text-right" style="font-weight: bold;">#<?= $data->no_invoice; ?></p>
                </div>
            </div>
        </div>
        <hr class="mr-3 mb-0">
        <div style="margin-right: 6rem;">
            <div class="row mx-auto">
                <div class="col-xs-6 mt-3">
                    <h5 class="mb-0">Ditagihkan Ke :</h5>
                    <p class="mb-0"> <?= $data->nm_warga; ?> | <?= $data->no_rumah; ?></p>
                    <p class="mb-0">Perum. <?= $data->perum; ?>, RT<?= $data->rt; ?> / RW<?= $data->rw; ?></p>
                    <p class="mb-0"><?= $data->no_hp; ?></p>
                    <p class="mb-0"><?= $data->bln_tagihan; ?> <?= $data->thn_tagihan; ?></p>
                </div>
                <div class="col-xs-6">
                    <h5 class="text-right mb-0">Dibayarkan ke :</h5>
                    <p class="text-right mb-0">Pengelola <?= $data->perum; ?></p>
                    <p class="text-right mb-0"><?= $data->code_tagihan; ?></p>
                    <p class="text-right mb-0"><?= $data->foto_bukti; ?></p>
                    <p class="text-right mb-0"><?= $data->tgl_byr; ?></p>
                </div>
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr style="background: #4b49ac;color: white;">
                        <td class="">Bulan</td>
                        <td class=""><?= $data->bln_tagihan; ?> / <?= $data->thn_tagihan; ?></td>
                    </tr>
                    <tr class="rinc-<?= $data->id_tagihan; ?>" hidden>
                        <td colspan="2" class="text-center" style="background: aquamarine;font-weight: bold;color: cornflowerblue;">Rincian Penggunaan air</td>
                    </tr>
                    <tr>
                        <td class="">Awal</td>
                        <td class=""><?= $data->kubik1; ?></td>
                    </tr>
                    <tr>
                        <td class="">Akhir</td>
                        <td class=""><?= $data->kubik_in; ?></td>
                    </tr>
                    <tr>
                        <td class="">Pemakaian</td>
                        <td class=""><?= $data->hasil_kubik; ?></td>
                    </tr>
                    <tr>
                        <td class="">Tarif</td>
                        <td class="">Rp.<?= number_format($data->perkubik, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td class="">Abunamen</td>
                        <td class="">Rp.<?= number_format($data->abunament, 0, ',', '.'); ?></td>
                    </tr>
                    <tr style="background: tomato; font-weight: bold;">
                        <td class="">Bayar air</td>
                        <td class="">Rp.<?= number_format($data->nominal, 0, ',', '.'); ?></td>
                    </tr>
                    <tr style="background: coral; font-weight: bold;">
                        <td class="">IPL</td>
                        <td class="">Rp.<?= number_format($data->lain_lain, 0, ',', '.'); ?></td>
                    </tr>
                    <tr style="background: #ff7f50a3; font-weight: bold;">
                        <td class="">Biaya VA</td>
                        <td class="">Rp.<?= number_format($data->taxs, 0, ',', '.'); ?></td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td>Total bayar</td>
                        <td>Rp.<?= number_format($data->lain_lain += $data->nominal += $data->taxs, 0, ',', '.'); ?></td>
                    </tr>
                </tbody>

            </table>
        </div>
    <?php
    endforeach;
    ?>
</body>

</html>