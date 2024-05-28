<!DOCTYPE html>
<html>

<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title>Create PDF from View in CodeIgniter Example</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css"
        rel="stylesheet" />
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
    }

    .sup {
        font-size: 100%;
        vertical-align: super;
    }
    </style>
</head>

<body>
    <?php
    foreach ($data_tarik as $bukti) :
        $Rp_dpp     = 'Rp. ' . number_format($bukti->dpp, 0, ',', '.');
        $Rp_akhir     = 'Rp. ' . number_format($bukti->saldo, 0, ',', '.');
        $tanggal_formatted = date('d/m/Y', strtotime($bukti->tanggal));
    ?>
    <div style="margin-right: 6rem;">
        <div class="row">
            <div class="col-xs-6 logo-e">
                <img class="mt-2rem" src="<?= base_url('assets'); ?>/images/logo_e/hicare.png"
                    style="height: auto;width: 20rem;">
            </div>
            <div class="col-xs-6 pt-2">
                <h3 class="text-right"
                    style="font-weight: bold;font-family: sans-serif; top: 27px; position: relative;">Bukti | <i
                        class="text-danger status-inv">Penarikan Saldo</i></h3>
                <br>
            </div>
        </div>
    </div>
    <hr class="mr-3 mb-0">
    <div style="margin-right: 6rem;">
        <div class="row mx-auto">
            <div class="col-xs-6 mt-3">
                <h5 class="mb-2">Penarikan :</h5>
                <p class="mb-0">No. Bukti. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: <?= $bukti->code_tranfer; ?></p>
                <p class="mb-0">Tanggal &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <?= $tanggal_formatted; ?></p>
                <p class="mb-0"> Tarik Saldo Ke &nbsp; : <?= $bukti->nama; ?></p>
            </div>
        </div>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Saldo Segel</th>
                    <th>Nominal + Segel</th>
                    <th>Fee</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $Rp_dpp; ?></td>
                    <td><?= $bukti->fee; ?> %</td>
                    <td><?= $Rp_akhir;?></td>
                </tr>
            </tbody>
        </table>
    </div><br>
    <div style="margin-right: 5rem;">
        <div class="row mx-auto">
            <div class="col-xs-6 mt-6">
                <p class="mb-5"> Pengelola : <?= $bukti->nama; ?></p><br>
                <p class="mt-5"> (........................................)</p>
            </div>
        </div>
    </div>
    <?php
    endforeach;
    ?>
</body>

</html>