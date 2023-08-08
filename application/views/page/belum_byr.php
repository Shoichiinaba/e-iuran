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
                            <p class="card-title">Data Transaksi Warga</p>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="data-blm" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No. Invoice</th>
                                                <th>Nama || No Rumah</th>
                                                <th>Bulan</th>
                                                <th>Tahun</th>
                                                <th>Nominal</th>
                                                <th>Tagihan Lain</th>
                                                <th>Total</th>
                                                <th>Status</th>
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


    <script>
    $(document).ready(function() {

        window.crud = $('#data-blm').DataTable({
            "paging": true,
            "ordering": true,
            "autoWidth": true,
            "responsive": true,
            "searching": true,
            "processing": true,
            "serverSide": true,
            ajax: {
                url: "<?php echo base_url('Data_tagihan/get_belumbyr') ?>",
                type: "POST"
            },
            columns: [{
                    data: 'nomor_urut',
                    name: 'nomor_urut'
                },
                {
                    data: 'no_invoice',
                    name: 'no_invoice'
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
                    data: 'nominal',
                    name: 'nominal'
                },
                {
                    data: 'lain_lain',
                    name: 'lain_lain'
                },
                {
                    data: 'total',
                    name: 'total'
                },
                {
                    data: 'status',
                    name: 'status',
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
    })
    </script>