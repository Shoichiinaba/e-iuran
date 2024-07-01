<style>
.btn.cetak {
    background-color: #28a745;
    color: #4B49AC;
    font-size: medium;
    padding: 10px 20px;
    border: none;
    border-radius: 10px;
    transition: background-color 0.3s ease, color 0.3s ease;
    cursor: pointer;
}

.btn.cetak:hover {
    background-color: #4B49AC !important;
    color: white !important;
}
</style>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body pt-1 mt-1">
                        <div class="row mb-1 pb-1">
                            <div class="col-md-12 grid-margin mb-0 pb-0">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h4 class="font-weight-bold">Data Hutang
                                    </h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="col-lg-2 col-xxl-2 col-md-3 mb-3">
                                        <a id="print" target="_blank">
                                            <button type="button" class="btn bg-gradient-success cetak">
                                                <i class="fa fa-print" style="font-size:small;">&nbsp; Cetak</i>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="data-hutang" class="display expandable-table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No. Transaksi</th>
                                                    <th>Tanggal</th>
                                                    <th>Keterangan</th>
                                                    <th>Hutang</th>
                                                    <th>Pembayaran</th>
                                                    <th>Hutang</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="6" class="bg-primary text-right text-light"
                                                        style="font-weight: bold;">Total Hutang: &nbsp;
                                                    </th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
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

    <script>
    $(document).ready(function() {
        var table;

        table = $('#data-hutang').DataTable({
            "paging": true,
            "autoWidth": true,
            "search": true,
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?=site_url('Data_hutang/get_datahutang')?>",
                "type": "POST",
            },

            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                // Total Nominal
                var totalNominal = api.column(6, {
                        page: 'current'
                    }).data()
                    .reduce(function(a, b) {
                        return a + parseFloat(b.replace(/[^\d.-]/g, ''));
                    }, 0);

                // Ambil totalNominal dari objek output
                var totalNominalObj = api.ajax.json().totalNominal;

                $(api.column(6, {
                    page: 'current'
                }).footer()).html(totalNominalObj);
            }
        })

    });

    // kode untuk print pdf
    $('#print').on('click', function() {
        printFilteredData();
    });

    function printFilteredData() {

        var printUrl = "<?php echo site_url('Lap_segel/lap_hutang'); ?>";
        window.open(printUrl, '_blank');
    }
    </script>