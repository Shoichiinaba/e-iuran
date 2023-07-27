<style>
.btn-icon {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 20px;
    height: 20px;
    margin-right: 5px;
}

.btn-sm-custom {
    height: 45px;

}

.remove-left-radius .btn {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
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
                                                <th>No</th>
                                                <th>Nama Iuran</th>
                                                <th>Nominal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no= 0; foreach ($iuran as $data ): $no++;?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $data->nama_iuran; ?></td>
                                                <td>
                                                    <?php
                                                        if ($data->id_iuran == 3) {
                                                            echo '<p>Rp. ' . number_format($data->nominal, 0, ',', '.') . ' / M3</p>';
                                                            echo '<p> Perawatan : Rp. ' . number_format($data->perawatan, 0, ',', '.') . '</p>';
                                                            echo '<p> Abunament : Rp. ' . number_format($data->abunament, 0, ',', '.') . '</p>';
                                                        } else {
                                                            echo '<p>Rp. ' . number_format($data->nominal, 0, ',', '.') . '</p>';
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a type="button" data-toggle="modal"
                                                        data-target="#modal-edit<?=$data->id_iuran;?>"
                                                        class="btn btn-inverse-success btn-icon" data-placement="top"
                                                        title="Edit"><i class="ti-pencil-alt"></i></a>

                                                    <a href="#" onclick="confirmDelete(<?=$data->id_iuran;?>);"
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Iuran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-1 pl-2 pr-2 pb-1">
                    <form method="post" action="<?php echo base_url('Data_iuran/simpan_iuran'); ?>">
                        <div id="repeaterContainer" class="row">
                            <div class="input-group mb-3">
                                <div class="col-lg-0 pl-0 pr-0">
                                    <input type="text" class="form-control" name="id_rtrw[]"
                                        value="<?php echo $userdata->id_rtrw; ?>" hidden>
                                </div>
                                <div class="col-lg-5 pl-2 pr-1">
                                    <input type="text" class="form-control" name="nama_iuran[]" required
                                        placeholder="Nama Iuran" aria-describedby="button-addon2">
                                </div>
                                <div class="col-lg-5 pr-0 pl-2">
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" name="nominal[]" class="form-control" aria-label="Amount"
                                            placeholder="Nominal" aria-describedby="button-addon2">
                                    </div>
                                </div>
                                <div class="col-lg-2 pl-0 pr-0 remove-left-radius">
                                    <button class="btn btn-outline-success" type="button" id="addButton"><i
                                            class="ti-support"></i></button>
                                </div>
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

    <!-- Modal edit rtrw -->
    <?php $no=  0; foreach($iuran as $g  ): $no++;?>
    <div class="modal fade" id="modal-edit<?=$g->id_iuran;?>" tabindex="-1" aria-labelledby="exampleModaledit"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModaledit">Edit Iuran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-1 pl-2 pr-2 pb-1">
                    <form method="post" action="<?php echo base_url('Data_iuran/edit_iuran'); ?>">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="id_iuran" value="<?=$g->id_iuran;?>"
                                aria-describedby="button-addon2" hidden>
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-primary" type="button" id="button-addon1"><b
                                    class="ti-agenda"></b></button>
                            <input type="text" class="form-control" name="nama_iuran" value="<?=$g->nama_iuran;?>"
                                required aria-label="Masukan Nama Perumahan" aria-describedby="button-addon2">
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-primary" type="button" id="button-addon1"><b
                                    class="ti-wallet"></b></button>
                            <input type="text" class="form-control" name="nominal" value="<?=$g->nominal;?>" required
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
                window.location.href = '<?php echo site_url('Data_iuran/hapus_iuran/'); ?>' + id;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
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
    <?php
        $id_rtrw_value = isset($userdata->id_rtrw) ? $userdata->id_rtrw : '';
    ?>

    <script>
    // Fungsi untuk menambahkan field baru ke dalam repeater
    function tambahField() {
        var container = document.getElementById("repeaterContainer");
        var newField = document.createElement("div");
        var idRtrw = "<?php echo $id_rtrw_value; ?>";

        newField.innerHTML = `
            <div id="repeaterContainer" class="row">
                <div class="input-group mb-3">
                    <div class="col-lg-0 pl-0 pr-0">
                        <input type="text" class="form-control text-left" name="id_rtrw[]" value="${idRtrw}" hidden>
                    </div>
                    <div class="col-lg-5 pl-2 pr-1">
                        <input type="text" class="form-control" name="nama_iuran[]" required
                                        placeholder="Nama Iuran" aria-describedby="button-addon2">
                    </div>
                    <div class="col-lg-5 pr-0 pl-2">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" name="nominal[]" class="form-control" aria-label="Amount"
                                            placeholder="Nominal" aria-describedby="button-addon2">
                        </div>
                    </div>
                    <button class="btn btn-outline-danger btn-sm-custom col-lg-2 pl-0 pr-2" type="button" onclick="hapusField(this)">
                        <i class="ti-eraser"></i>
                    </button>
                </div>
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