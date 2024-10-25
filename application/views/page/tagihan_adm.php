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

.btn-custom {
    width: 106px;
    height: 27px;
}

.btn-buka-custom {
    width: 120px;
    height: 27px;
}

.btn-segel {
    width: 93px;
    height: 27px;
}

.btn-print {
    width: 58px;
    height: 40px;
    border-radius: 11px;
}
</style>

<!-- alerts -->
<?php
        $sukses_message = $this->session->flashdata('sukses');
        $gagal_message = $this->session->flashdata('gagal');
    ?>
<?php if ($sukses_message): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Pembayaran!',
    text: '<?php echo $sukses_message; ?>',
});
</script>
<?php endif; ?>

<?php if ($gagal_message): ?>
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
                                <div class="col-xl-8 mb-4 mb-xl-0">
                                    <h4 class="font-weight-bold">Data Tagihan
                                    </h4>
                                </div>
                                <div class="row">
                                    <div class="row mb-2">
                                        <div class="col-lg-2 col-xxl-2 col-md-3 col-sm-3 mb-1">
                                            <div class="input-group input-group-sm filter">
                                                <span class="input-group-text text-body bg-gradient-primary">
                                                    <i class="fa fa-home btn-icon-prepend" style="color:white;"
                                                        aria-hidden="true"></i>
                                                </span>
                                                <select class="form-control pt-1" id="perum_filter">
                                                    <option value="">Pilih !!</option>
                                                    <?php
                                                    foreach ($filter_perum as $data) :
                                                    ?>
                                                    <option value="<?= $data->id_perumahan; ?>">
                                                        <?= $data->nama; ?></option>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-xxl-2 col-md-3 col-sm-3 mb-1">
                                            <div class="input-group input-group-sm filter">
                                                <span class="input-group-text text-body bg-gradient-primary">
                                                    <i class="fa fa-home btn-icon-prepend" style="color:white;"
                                                        aria-hidden="true"></i>
                                                </span>
                                                <select class="form-control pt-1" id="periode_filter">
                                                    <option value=""> &nbsp; Filter Periode</option>
                                                    <option value="2"> &nbsp; Lebih 2 Bln.</option>
                                                    <option value="3"> &nbsp; Lebih 3 Bln.</option>
                                                    <option value="4"> &nbsp; Lebih 4 Bln.</option>
                                                    <option value="5"> &nbsp; Lebih 5 Bln.</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="data-tagihan" class="display expandable-table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Perumahan</th>
                                                    <th>Nama || No Rumah</th>
                                                    <th>Periode</th>
                                                    <th>Bulan</th>
                                                    <th>Total + Tax</th>
                                                    <th>Status </th>
                                                </tr>
                                            </thead>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="5" class="bg-primary text-right text-light"
                                                        style="font-weight: bold;">Total: &nbsp;
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

        table = $('#data-tagihan').DataTable({
            "paging": true,
            "autoWidth": true,
            "search": true,
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?=site_url('Data_tagihan_adm/get_tagihan')?>",
                "type": "POST",
                "data": function(d) {
                    d.filter_perum = $('#perum_filter').val();
                    d.filter_periode = $('#periode_filter').val();
                }
            },

            "lengthMenu": [
                [10, 25, 50, 75, 100, -1],
                [10, 25, 50, 75, 100, "All"]
            ],

            "columnDefs": [{
                "targets": [1, 2, 3, 4],
                "className": 'text-right'
            }],

            "pageLength": -1,
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                // Total Nominal
                var totalNominal = api.column(5, {
                        page: 'current'
                    }).data()
                    .reduce(function(a, b) {
                        return a + parseFloat(b.replace(/[^\d.-]/g, ''));
                    }, 0);

                // Ambil totalNominal dari objek output
                var totalNominalObj = api.ajax.json().totalNominal;

                $(api.column(5, {
                    page: 'current'
                }).footer()).html(totalNominalObj);
            }
        })
        $('#perum_filter, #periode_filter').on('change', function() {
            // debugging apakah nilai select muncul
            console.log('Nilai select: ' + $(this).val());
            table.draw();
        });
    });
    </script>