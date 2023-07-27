<!-- alerts -->
<?php
        $sukses_message = $this->session->flashdata('sukses');
        $gagal_message = $this->session->flashdata('gagal');
    ?>
<?php if ($sukses_message): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
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
            <div class="col-md-12 col-lg-12 grid-margin stretch-card mt-0 mb-1">
                <div id="form-add-warga" class="card " hidden>
                    <div class="card-body pb-2">
                        <div class="d-flex align-items-center">
                            <p class="card-title"> Tambah Data Warga</p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <p class="card-title">Data Warga</p>
                            <button type="button"
                                class="btn btn-social-icon-text btn-twitter btn-sm ml-auto mb-2 text-center"
                                data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                    class=" ti-support mr-1"></i>Tambah
                                Baru</button>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="data-warga" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>N0</th>
                                                <th>Perumahan</th>
                                                <th>Nama</th>
                                                <th>No. Rumah</th>
                                                <th>No. HP</th>
                                                <th>RT</th>
                                                <th>RW</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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

    <!-- Modal tambah data -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Warga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-1 pl-2 pr-2 pb-1">
                    <form method="post" action="<?php echo base_url('Warga/simpan'); ?>">
                        <div class="input-group pb-1">
                            <?php if ($userdata->role=='RT' ):?>
                            <div class="form-group">
                                <div class="input-group col-lg-0 col-md-0 col-sm-0">
                                    <input type="text" class="form-control" name="id_perum[]"
                                        value="<?php echo $userdata->id_perum; ?>" hidden>
                                </div>
                            </div>
                            <?php endif ;?>
                            <?php if ($userdata->role=='Admin' ):?>
                            <div class="form-group col-lg-2 pr-2">
                                <select class="form-control" id="exampleSelectGender" name="id_perum[]">
                                    <option selected>Pilih Perumahan</option>
                                    <?php foreach ($perum as $data) { ?>
                                    <option value="<?= $data->id_perumahan; ?>"><?= $data->nama; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php endif ;?>
                            <div class="form-group col-lg-2">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nama[]" placeholder="Nama"
                                        aria-label="Nama">
                                </div>
                            </div>
                            <div class="form-group col-lg-2">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="no_rumah[]" placeholder="No. Rumah"
                                        aria-label="no. Rumah">
                                </div>
                            </div>
                            <div class="form-group col-lg-2">
                                <div class="input-group">
                                    <input type="text" name="no_hp[]" class="form-control" placeholder="No. HP"
                                        aria-label="no. HP">
                                </div>
                            </div>
                            <?php if ($userdata->role=='RT' ):?>
                            <div class="form-group">
                                <div class="input-group col-lg-2 col-md-2 col-sm-0">
                                    <input type="text" class="form-control" name="id_rtrw[]"
                                        value="<?php echo $userdata->id_rtrw; ?>" hidden>
                                </div>
                            </div>
                            <?php endif ;?>
                            <?php if ($userdata->role=='Admin' ):?>
                            <div class="form-group col-lg-2 pr-2">
                                <select class="form-control" id="exampleSelectGender" name="id_rtrw[]">
                                    <option selected>Pilih RT / RW</option>
                                    <?php foreach ($rtrw as $data) { ?>
                                    <option value="<?= $data->id_rtrw; ?>">RT: <?= $data->rt; ?> | RW: <?= $data->rw; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php endif ;?>
                            <div class="form-group col-lg-3 pr-2 mb-1">
                                <input class="form-control" name="keterangan[]" placeholder="Keterangan"></input>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- akhir Modal tambah data -->

    <!-- Modal edit warga -->
    <!-- <?php $no=  0; foreach($warga as $wargas  ): $no++;?> -->
    <div class="modal fade" id="modal-edit<?=$wargas->id_warga;?>" tabindex="-1" aria-labelledby="exampleModaledit"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModaledit">Edit Warga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-1 pl-2 pr-2 pb-1">
                    <form method="post" action="<?php echo base_url('Warga/edit_warga'); ?>">
                        <div class="input-group pb-1">
                            <div class="form-group" hidden>
                                <input type="text" name="id_warga" class="form-control" value="<?=$wargas->id_warga;?>"
                                    placeholder="Masukan Nama">
                            </div>
                            <?php if ($userdata->role=='RT' ):?>
                            <div class="form-group mr-3 ml-1 col-lg-5 col-sm-4" hidden>
                                <label for="exampleInputUsername1">Perumahan</label>
                                <select class="form-control" name="id_perum">
                                    <option value="<?= $wargas->id_perum; ?>"> <?= $wargas->perum; ?> </option>
                                    <?php foreach ($perum as $data) { ?>
                                    <option value="<?= $data->id_perumahan; ?>"> <?= $data->nama; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group mr-3 ml-3 col-lg-5 col-sm-4" hidden>
                                <label for="exampleInputUsername1">RT / RW</label>
                                <select class="form-control" name="id_rtrw">
                                    <option value="<?= $wargas->id_rtrw; ?>"> RT: <?= $wargas->rt; ?> | RW:
                                        <?= $wargas->rw; ?></option>
                                    <?php foreach ($rtrw as $data) { ?>
                                    <option value="<?= $data->id_rtrw; ?>"> RT: <?= $data->rt; ?> | RW:
                                        <?= $data->rw; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php endif ;?>
                            <?php if ($userdata->role=='Admin' ):?>
                            <div class="form-group mr-3 ml-1 col-lg-5 col-sm-4">
                                <label for="exampleInputUsername1">Perumahan</label>
                                <select class="form-control" id="exampleSelectGender" name="id_perum">
                                    <option value="<?= $wargas->id_perum; ?>"> <?= $wargas->perum; ?> </option>
                                    <?php foreach ($perum as $data) { ?>
                                    <option value="<?= $data->id_perumahan; ?>"> <?= $data->nama; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group mr-3 ml-3 col-lg-5 col-sm-4">
                                <label for="exampleInputUsername1">RT / RW</label>
                                <select class="form-control" id="exampleSelectGender" name="id_rtrw">
                                    <option value="<?= $wargas->id_rtrw; ?>"> RT: <?= $wargas->rt; ?> | RW:
                                        <?= $wargas->rw; ?></option>
                                    <?php foreach ($rtrw as $data) { ?>
                                    <option value="<?= $data->id_rtrw; ?>"> RT: <?= $data->rt; ?> | RW:
                                        <?= $data->rw; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php endif ;?>
                            <div class="form-group mr-3 ml-3">
                                <label for="exampleInputUsername1">Nama</label>
                                <input type="text" name="nama" class="form-control" value="<?=$wargas->nama;?>"
                                    placeholder="Masukan Nama">
                            </div>
                            <div class="form-group mr-3 ml-3">
                                <label for="exampleInputEmail1">No. Rumah</label>
                                <input type="text" name="no_rumah" class="form-control" value="<?=$wargas->no_rumah;?>"
                                    placeholder="Masukkan No. Rumah">
                            </div>
                            <div class="form-group mr-3 ml-3">
                                <label for="exampleInputUsername1">No. HP</label>
                                <input type="text" name="no_hp" class="form-control" value="<?=$wargas->no_hp;?>"
                                    placeholder="Masukksn No. HP">
                            </div>
                            <div class="form-group mr-3 ml-3">
                                <label for="exampleInputEmail1">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan"
                                    value="<?=$wargas->keterangan;?>" placeholder="Masukkan Keterangan">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- <?php endforeach;?> -->
    <!-- akhir Modal edit warga -->

    <!-- data warga -->
    <script>
    $(document).ready(function() {
        window.crud = $('#data-warga').DataTable({
            "paging": true,
            "ordering": true,
            "autoWidth": true,
            "responsive": true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo base_url('Warga/get_warga') ?>",
                type: "POST"
            },
            columns: [{
                    data: 'nomor_urut',
                    name: 'nomor_urut'
                },
                {
                    data: 'perum',
                    name: 'perum'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'no_rumah',
                    name: 'no_rumah'
                },
                {
                    data: 'no_hp',
                    name: 'no_hp'
                },
                {
                    data: 'rt',
                    name: 'rt'
                },
                {
                    data: 'rw',
                    name: 'rw'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
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
    });

    function hapusData(id) {
        console.log(id);
        // alert(id)
        if (confirm("Anda yakin ingin menghapus data ini?")) {
            $.ajax({
                url: "<?php echo base_url('Warga/hapus_data') ?>",
                type: "POST",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        window.crud.ajax.reload();
                    } else {
                        alert('Terjadi kesalahan saat menghapus data.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    }
    </script>