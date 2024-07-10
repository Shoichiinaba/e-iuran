<style>
/* Mengatur tata letak elemen form secara horizontal */
.template-demo {
    display: flex;
    flex-wrap: wrap;
}

.input-wrapper {
    position: relative;
    line-height: 14px;
    margin: -15px 5px;
    display: block;
}

.dataTables_wrapper select {
    width: 140px;
    height: 30px;
}

.input-wrapper select {
    width: 100px;
    height: 32px;
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
<?php if ($sukses_message) : ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Pembayaran!',
    text: '<?php echo $sukses_message; ?>',
});
</script>
<?php endif; ?>

<?php if ($gagal_message) : ?>
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
            <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body pt-1 mt-1">
                        <div class="row mb-1 pb-1">
                            <div class="col-md-12 grid-margin mb-0 pb-0">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h4 class="font-weight-bold">Data Transaksi
                                    </h4>
                                </div>
                                <div class="row">
                                    <div class="input-group pb-0 col-12">
                                        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 mt-1 mb-2 p-2">
                                            <label class="label-select">Status Pembayaran</label>
                                            <select type="text" id="status" class="col-lg-12 mt-1 pt-1">
                                                <option value="">Pilih !!</option>
                                                <option value="1">Menunggu Pembayaran</option>
                                                <option value="2">Lunas</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 mt-1 mb-2 p-2">
                                            <label class="label-select">Jenis Pembayaran</label>
                                            <select type="text" id="jenis-pembayaran" class="col-lg-12 mt-1 pt-1">
                                                <option value="">Pilih !!</option>
                                                <?php
                                                foreach ($bank as $data) :
                                                ?>
                                                <option value="<?= $data->foto_bukti; ?>"> &nbsp;
                                                    <?= $data->foto_bukti; ?></option>
                                                <?php
                                                endforeach;
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 mt-1 mb-2 p-2">
                                            <label class="label-select">Status Saldo</label>
                                            <select type="text" id="status-saldo" class="col-lg-12 mt-1 pt-1">
                                                <option value="">Pilih !!</option>
                                                <option value="1">Belum Ditarik</option>
                                                <option value="2">Sudah Ditarik</option>
                                            </select>
                                        </div>

                                        <?php if ($userdata->role == 'Admin') : ?>
                                        <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 p-2">
                                            <label class="label-select">Perumahan</label>
                                            <select type="text" id="perum_filter" class="col-lg-12 mt-1 pt-1">
                                                <option value="">Pilih !!</option>
                                                <?php
                                                    foreach ($filter_perum as $data) :
                                                    ?>
                                                <option value="<?= $data->nama; ?>">
                                                    <?= $data->nama; ?></option>
                                                <?php
                                                    endforeach;
                                                    ?>
                                            </select>
                                        </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="data-trx" class="display expandable-table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No. Invoice</th>
                                                    <th>No. Pembayaran</th>

                                                    <?php if ($userdata->role == 'Admin') : ?>
                                                    <th>Perumahan</th>
                                                    <?php endif; ?>

                                                    <th>Nama || No Rumah</th>
                                                    <th>Bank</th>
                                                    <th>Tgl. Buat Pembayaran</th>
                                                    <th>Tgl. Bayar</th>
                                                    <th>Periode</th>
                                                    <th>Status </th>
                                                    <th>Total + Tax</th>
                                                </tr>
                                            </thead>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="9" class="bg-primary text-right text-light"
                                                        style="font-weight: bold;">Total Nominal: &nbsp;
                                                    </th>
                                                    <th></th>
                                                </tr>
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

    <script>
    $(document).ready(function() {
        var table;

        table = $('#data-trx').DataTable({
            "paging": true,
            "autoWidth": true,
            "search": true,
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Data_tagihan/get_datapay') ?>",
                "type": "POST",
                "data": function(d) {
                    d.status = $('#status').val();
                    d.jenis_pem = $('#jenis-pembayaran').val();
                    d.perum_filter = $('#perum_filter').val();
                    d.saldoStat_filter = $('#status-saldo').val();
                }
            },

            "lengthMenu": [
                [10, 25, 50, 75, 100, -1],
                [10, 25, 50, 75, 100, "All"]
            ],

            "pageLength": -1,
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                var totalNominal = api.column(9, {
                        page: 'current'
                    }).data()
                    .reduce(function(a, b) {
                        return a + parseFloat(b.replace(/[^\d.-]/g, ''));
                    }, 0);

                var totalNominalObj = api.ajax.json().totalNominal;

                $(api.column(9, {
                    page: 'current'
                }).footer()).html(totalNominalObj);
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
        $('#status, #jenis-pembayaran, #perum_filter, #status-saldo').on('change', function() {
            // debugging apakah nilai select muncul
            // console.log('Nilai select: ' + $(this).val());
            table.draw();
        });
    });
    </script>