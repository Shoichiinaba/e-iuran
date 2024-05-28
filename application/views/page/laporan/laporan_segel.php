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
                    <th>Nama || No rumah</th>
                    <th>Periode</th>
                    <th>Status Pembayaran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($filteredData as $seg): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $seg->nama;?> || <?= $seg->no_rumah;?></td>
                    <td><?= isset($periode[$seg->id_warga]) ? $periode[$seg->id_warga] : ''; ?> Bulan</td>
                    <td>
                        <?php
                            switch ($seg->status) {
                                case 0:
                                    echo '<div class="badge badge-danger">Belum Bayar</div>';
                                    break;
                                case 2:
                                    echo '<div class="badge badge-success">Lunas</div>';
                                    break;
                                default:
                                    echo "Status tidak valid";
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            switch ($seg->status_segel) {
                                case 0:
                                    echo '<div class="badge badge-warning">Harus Disegel</div>';
                                    break;
                                case 1:
                                    echo '<span class="badge badge-danger">Tersegel</span>';
                                    break;
                                case 2:
                                    echo '<div class="badge badge-success">Buka Segel</div>';
                                    break;
                                default:
                                    echo "Status tidak valid";
                            }
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</body>

</html>