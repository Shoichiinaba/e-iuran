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

    #data-keuangan td,
    #data-keuangan th {
        border: 1px solid #ddd;
        padding: 5px;
        font-size: 12px;
    }

    #data-keuangan tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #data-keuangan tr:hover {
        background-color: #ddd;
    }

    #data-keuangan th {
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: left;
        background: #4B49AC;
        color: white;
    }

    .title {
        padding-bottom: 1px;
        margin-bottom: 1px;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center title">Laporan Keuangan Hi-care</h2>
        <h4 class="text-center">
            <?php
                if ($filter_bulan && $filter_tahun) {
                    echo "Periode Bulan: " . date('F', mktime(0, 0, 0, $filter_bulan, 10)) . " " . $filter_tahun;
                }
            ?>
        </h4><br>
        <table id="data-keuangan" class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 5%;">No.</th>
                    <th style="width: 18%;">N0. Transaksi</th>
                    <th style="width: 15%;">Tanggal</th>
                    <th style="width: 19%;">Type Transaksi</th>
                    <th style="width: 20%;">Keterangan</th>
                    <th style="width: 18%;">Kredit</th>
                    <th style="width: 18%;">Debit</th>
                    <th style="width: 19%;">Saldo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $total_saldo = 0;

                function format_rupiah($number) {
                    return 'Rp ' . number_format($number, 0, ',', '.');
                }

                foreach ($data_keuangan as $keu):
                    $tanggal = !empty($keu->tanggal) ? date('d-m-Y', strtotime($keu->tanggal)) : '';
                    $credit = is_numeric($keu->credit) ? format_rupiah($keu->credit) : '';
                    $debit = is_numeric($keu->debit) ? format_rupiah($keu->debit) : '';
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $keu->no_transaksi; ?></td>
                    <td><?= $tanggal; ?></td>
                    <td><?= $keu->type_transaksi; ?></td>
                    <td><?= $keu->keterangan; ?></td>
                    <td><?= $credit; ?></td>
                    <td><?= $debit; ?></td>
                    <td><?= format_rupiah($keu->saldo); ?></td>
                </tr>
                <?php
                    $total_saldo = $keu->saldo;
                    endforeach;
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="7" class="text-right">Total Saldo</th>
                    <th><?= format_rupiah($total_saldo); ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>