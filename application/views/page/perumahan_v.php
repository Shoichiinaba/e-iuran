<style>
.btn-icon {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 20px;
    height: 20px;
    margin-right: 5px;
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
            <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <p class="card-title">Data Perumahan</p>
                            <button type="button"
                                class="btn btn-social-icon-text btn-twitter btn-sm ml-auto mb-2 text-center"
                                data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                    class=" ti-support mr-1"></i>Tambah
                                Baru</button>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="data-perum" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No <?php echo $userdata->id_perum; ?></th>
                                                <th>Nama Perumahan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no= 0; foreach ($perum as $data ): $no++;?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $data->nama; ?></td>
                                                <td>
                                                    <a type="button" data-toggle="modal"
                                                        data-target="#modal-edit<?=$data->id_perumahan;?>"
                                                        class="btn btn-inverse-success btn-icon" data-placement="top"
                                                        title="Edit"><i class="ti-pencil-alt"></i></a>

                                                    <a href="#" onclick="confirmDelete(<?=$data->id_perumahan;?>);"
                                                        class="btn btn-inverse-danger btn-icon" title="Hapus"><i
                                                            class="ti-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php endforeach;?>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Perumahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-1 pl-2 pr-2 pb-1">
                    <form method="post" action="<?php echo base_url('perumahan/simpan_data'); ?>">
                        <div id="repeaterContainer">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="nama[]" required placeholder="Perumahan"
                                    aria-label="Masukan Nama Perumahan" aria-describedby="button-addon2">
                                <button class="btn btn-outline-success" type="button" id="addButton"><i
                                        class="ti-support"></i></button>
                            </div>
                        </div>
                        <div class="modal-footer pr-0">
                            <button type="submit" class="btn btn-primary" id="selesaiButton">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- akhir Modal tambah data -->

    <!-- Modal edit perum -->
    <?php $no=  0; foreach($perum as $g  ): $no++;?>
    <div class="modal fade" id="modal-edit<?=$g->id_perumahan;?>" tabindex="-1" aria-labelledby="exampleModaledit"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModaledit">Edit Perumahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-1 pl-2 pr-2 pb-1">
                    <form method="post" action="<?php echo base_url('perumahan/edit_perum'); ?>">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="id_perumahan" value="<?=$g->id_perumahan;?>"
                                required placeholder="Perumahan" aria-label="Masukan Nama Perumahan"
                                aria-describedby="button-addon2" hidden>
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-warning" type="button" id="button-addon1"><b
                                    class="ti-home"></b></button>
                            <input type="text" class="form-control" name="nama" value="<?=$g->nama;?>" required
                                placeholder="Perumahan" aria-label="Masukan Nama Perumahan"
                                aria-describedby="button-addon2">
                        </div>
                        <div class="modal-footer pr-0">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach;?>
    <!-- akhir Modal edit perum -->

    <!-- datatable perumahan -->
    <script>
    $(document).ready(function() {
        window.crud = $('#data-perum').DataTable({
            "paging": true,
            "ordering": true,
            "autoWidth": true,
            "responsive": true,
        });
    });
    </script>
    <!-- datatable perumahan -->

    <!-- SweetAlert2 -->
    <script>
    // Fungsi untuk menampilkan konfirmasi hapus menggunakan SweetAlert2
    function confirmDelete(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna menekan tombol "Ya", maka lakukan aksi hapus data
                window.location.href = '<?php echo site_url('Perumahan/hapus/'); ?>' + id;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Jika pengguna menekan tombol "Batal", tampilkan pesan batal menggunakan SweetAlert2
                Swal.fire(
                    'Dibatalkan',
                    'Data Anda tetap aman :)',
                    'error'
                )
            }
        });
    }
    </script>
    <!-- akhir SweetAlert2 -->

    <script>
    // Fungsi untuk menambahkan field baru ke dalam repeater
    function tambahField() {
        var container = document.getElementById("repeaterContainer");
        var newField = document.createElement("div");
        newField.innerHTML = `
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="nama[]" required
                    placeholder="Perumahan" aria-label="Masukan Nama Perumahan"
                    aria-describedby="button-addon2">
                <button class="btn btn-outline-danger" type="button" onclick="hapusField(this)"><i
                        class="ti-eraser"></i></button>
            </div>
        `;
        container.appendChild(newField);
    }

    // Fungsi untuk menghapus field dari repeater
    function hapusField(button) {
        var divToRemove = button.parentElement;
        divToRemove.remove();
    }

    // Tangkap tombol "Tambah" dan tambahkan field baru ketika diklik
    document.getElementById("addButton").addEventListener("click", function() {
        tambahField();
    });
    </script>