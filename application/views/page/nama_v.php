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

.label-select2 {
    color: #4B49AC;
    font-size: 8px;
    text-transform: uppercase;
    position: absolute;
    z-index: 2;
    left: 40px;
    top: 14px;
    padding: 0 2px;
    pointer-events: none;
    background: #fff;
    -webkit-transform: translateY(-25px);
}



select {
    font-size: 13px;
    color: #555;
    outline: none;
    border: 1px solid #bbb;
    padding: 15px 20px 10px;
    border-radius: 10px;
    position: relative;
}

select:invalid+label {
    -webkit-transform: translateY(0);
    -moz-transform: translateY(0);
    -o-transform: translateY(0);
    -ms-transform: translateY(0);
    transform: translateY(0);
}

select:focus {
    border-color: #2b96f1;
}

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
                            <p class="card-title">Data Iuran</p>
                            <button type="button"
                                class="btn btn-social-icon-text btn-twitter btn-sm ml-auto mb-2 text-center"
                                data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                    class=" ti-support mr-1"></i>Tambah Baru
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="data-nama" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Iuran</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no= 0; foreach ($nama_iuran as $data ): $no++;?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $data->nama; ?></td>
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
                    <form method="post" action="<?php echo base_url('Data_iuran/simpan_nama'); ?>">
                        <div id="repeaterContainer" class="row">
                            <div class="input-group mb-3">
                                <div class="col-lg-10 pr-0 pl-2">
                                    <div class="input-group">
                                        <span class="input-group-text">Iuran</span>
                                        <input type="text" name="nama[]" class="form-control" aria-label="Nama" required
                                            placeholder="" aria-describedby="button-addon2">
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

    <!-- Modal edit iuran -->
    <?php $no=  0; foreach($nama_iuran as $g  ): $no++;?>
    <div class="modal fade" id="modal-edit<?=$g->id_iuran;?>" tabindex="-1" aria-labelledby="exampleModaledit"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModaledit">Edit Nama Iuran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-1 pl-2 pr-2 pb-1">
                    <form method="post" action="<?php echo base_url('Data_iuran/edit_nama'); ?>">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="id_iuran" value="<?=$g->id_iuran;?>"
                                aria-describedby="button-addon2" hidden>
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-primary" type="button" id="button-addon1"><b
                                    class="ti-agenda"></b></button>
                            <input type="text" class="form-control" name="nama" value="<?=$g->nama;?>"
                                aria-label="Masukan Nama Perumahan" aria-describedby="button-addon2">
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
    <!-- akhir Modal edit iuran -->

    <!-- datatable iuran -->
    <script>
    $(document).ready(function() {
        window.crud = $('#data-nama').DataTable({
            "paging": true,
            "ordering": true,
            "autoWidth": true,
            "responsive": true,
        });
    });
    </script>
    <!-- datatable iuran -->

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
                window.location.href = '<?php echo site_url('Data_iuran/hapus_nama_iuran/'); ?>' + id;
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
    function tambahField() {
        var container = document.getElementById("repeaterContainer");
        var newField = document.createElement("div");

        newField.innerHTML = `
            <div id="repeaterContainer" class="row">
                <div class="input-group mb-3">
                    <div class="col-lg-9 pr-0 pl-2">
                        <div class="input-group">
                            <span class="input-group-text">Iuran</span>
                            <input type="text" name="nama[]" class="form-control" aria-label="Amount"
                                            placeholder="" aria-describedby="button-addon2">
                        </div>
                    </div>
                    <button class="btn btn-outline-danger btn-sm-custom col-sm-2 pl-0 pr-0 remove-right-radius" type="button" onclick="hapusField(this)">
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