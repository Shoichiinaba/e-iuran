<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
    #table {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #data-segel td,
    #data-segel th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #data-segel tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #data-segel tr:hover {
        background-color: #ddd;
    }

    #data-segel th {
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: left;
        background: #4B49AC;
        color: white;
    }

    .badge-success {
        background: #00B569;
    }

    .badge-warning {
        background: #FFC100;
        color: black;
    }

    .badge-danger {
        background: #FF4747;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Laporan Data Meteran Di Segel</h2><br><br>
        <table id="data-segel" class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>No. Pembayaran</th>
                    <th>Nama || No rumah</th>
                    <th>Periode</th>
                    <th>Tgl. Bayar</th>
                    <th>Pembayaran</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $no = 1;
                $total_saldo = 0;

                function format_rupiah($number) {
                    return 'Rp ' . number_format($number, 0, ',', '.');
                }

                foreach ($filteredData as $csh):
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $csh->code_tagihan; ?></td>
                    <td><?= $csh->nama;?> || <?= $csh->no_rumah;?></td>
                    <td><?= $csh->periode;?> Bulan</td>
                    <td><?= $csh->tgl_upload; ?></td>
                    <td><?= $csh->foto_bukti; ?></td>
                    <td><?= format_rupiah($csh->jumlah); ?></td>
                </tr>
                <?php
                    $total_saldo += $csh->jumlah;
                    endforeach;
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6" class="text-right">Total</th>
                    <th><?= format_rupiah($total_saldo); ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>