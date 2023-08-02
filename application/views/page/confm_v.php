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
                                    <table id="data-bayar" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <!-- <th>No. Invoice</th> -->
                                                <th>Code Transaksi</th>
                                                <th>Nama || No Rumah</th>
                                                <th>Bulan</th>
                                                <th>Tahun</th>
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
                    <form method="post" action="<?php echo base_url('Data_tagihan/approve'); ?>">
                        <input type="text" id="id-warga" class="form-control" name="id_warga" value="" hidden>
                        <div class="form-group mt-2 mb-2 col-lg-12 pl-2 pr-1 text-center">
                            <img id="bukti-upload" src="" class="img-thumbnail" alt="Cinque Terre" width="554"
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
    $(document).ready(function() {
        $('.btn-inverse-success').click(function() {
            $('#id-warga').val($(this).data('id-warga'));
            $('#bukti-upload').attr('src', '<?php echo base_url(); ?>assets/images/bukti_tf/' + $(this)
                .data('bukti-upload'));
        })

    });

    // datatable tagihan
    window.crud = $('#data-bayar').DataTable({
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
                data: 'bln_tagihan',
                name: 'bln_tagihan'
            },
            {
                data: 'thn_tagihan',
                name: 'thn_tagihan'
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