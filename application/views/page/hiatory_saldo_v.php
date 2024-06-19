<div class="main-panel">
    <div class="content-wrapper">


        <div class="row pt-2">
            <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body pt-1 mt-1">
                        <div class="row mb-1 pb-1">
                            <div class="col-md-12 grid-margin mb-0 pb-0">
                                <div class="row">
                                    <div class="col-xl-8 mb-4 mb-xl-0">
                                        <h4 class="font-weight-bold">Data Tarik Saldo
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="data-trxsal" class="display expandable-table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No. Penarikan</th>
                                                    <th>Nama perumahan</th>
                                                    <th>Tanggal</th>
                                                    <th>Nominal</th>
                                                    <th>Fee</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
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
</div>
</div>

<!-- kode javascript untuk manipulasi data -->
<script>
$(document).ready(function() {

    var table;

    table = $('#data-trxsal').DataTable({
        "paging": true,
        "autoWidth": true,
        "search": true,
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?=site_url('Histori_tarik/get_data_history')?>",
            "type": "POST",
        },

        "columnDefs": [{
                "targets": [6],
                "className": 'text-right'
            },
            {
                "targets": [1, 2, 3, 4],
                "className": 'text-left'
            },
            {
                "targets": [0],
                "className": 'text-center'
            },
            {
                "targets": [1, 3, 4, 6, 7],
                "orderable": false
            },
        ]
    })
});
</script>