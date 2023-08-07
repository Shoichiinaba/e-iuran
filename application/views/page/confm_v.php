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
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <p class="card-title">Data Warga Sudah TF</p>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="data-conf" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <!-- <th>No. Invoice</th> -->
                                                <th>Code Transaksi</th>
                                                <th>Nama || No Rumah</th>
                                                <th>Periode Bayar</th>
                                                <th>Tgl Bayar</th>
                                                <!-- <th> Jml. Bulan</th> -->
                                                <th>Total</th>
                                                <th>Aksi</th>
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


    <!-- Modal confim pembayaran -->
    <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModaledit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModaledit">Approve Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-1 pl-2 pr-2 pb-1">
                    <div class="table-responsive">
                        <table id="data-bayar" class="display expandable-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Code Transaksi</th>
                                    <th>Nama || No Rumah</th>
                                    <th>tgl_Bayar</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                    <form method="post" action="<?php echo base_url('Data_tagihan/approve'); ?>">
                        <input type="text" id="id-warga" class="form-control" name="id_warga" value="" hidden>
                        <div class="form-group mt-2 mb-2 col-lg-12 pl-2 pr-1 text-center">
                            <img id="foto-bukti" src="" class="img-thumbnail" alt="Cinque Terre" width="554"
                                height="386">
                        </div>
                        <div class="modal-footer pr-0">
                            <button type="submit" class="btn btn-primary">Approve</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- akhir Modal confim pembayara -->

    <script>
    function formatRupiah(number) {
        var formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        });

        return formatter.format(number);
    }

    $(document).ready(function() {
        $('.btn-inverse-success').click(function() {
            var idWarga = $(this).data('id-warga');
            var fotoBukti = $(this).data('foto-bukti');

            $('#id-warga').val(idWarga);
            $('#foto-bukti').attr('src', '<?php echo base_url(); ?>assets/images/bukti_tf/' +
                fotoBukti);

            // AJAX request to get transaction details
            $.ajax({
                url: '<?php echo base_url('Data_tagihan/get_trx_approv'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    id_warga: idWarga
                },
                success: function(data) {
                    var tableBody = $('#data-bayar tbody');
                    tableBody.empty();
                    $.each(data, function(index, value) {
                        var roundedAmount = Math.floor(value.jumlah);
                        var row = '<tr>' +
                            '<td>' + value.code_tagihan + '</td>' +
                            '<td>' + value.nama + ' || ' + value.no_rumah +
                            '</td>' +
                            '<td>' + value.tgl_upload + '</td>' +
                            '<td>' + formatRupiah(value.jumlah) + '</td>' +
                            '</tr>';

                        tableBody.append(row);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

    // datatable tagihan
    window.crud = $('#data-conf').DataTable({
        "paging": true,
        "ordering": true,
        "autoWidth": true,
        "responsive": true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?php echo base_url('Data_tagihan/get_bayar') ?>",
            type: "POST"
        },
        columns: [{
                data: 'nomor_urut',
                name: 'nomor_urut'
            },
            // {
            //     data: 'no_invoice',
            //     name: 'no_invoice'
            // },
            {
                data: 'code_tagihan',
                name: 'code_tagihan'
            },
            {
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'periode',
                name: 'periode'
            },
            {
                data: 'tgl_upload',
                name: 'tgl_upload'
            },
            {
                data: 'total',
                name: 'total'
            },
            {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                searchable: false,
                className: 'text-center'
            },
        ],
        "columnDefs": [{
            "targets": 0,
            "className": "text-center",
        }],
    });
    </script>