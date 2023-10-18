<style>
.tab-content {
    border: none;
}

.card-profil {
    height: 200px;
}
</style>

<!-- alerts -->
<?php
        $sukses_message = $this->session->flashdata('sukses');
        $gagal_message = $this->session->flashdata('gagal');
        $pas_beda = $this->session->flashdata('pas');
    ?>

<?php if ($sukses_message): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Profil',
    text: '<?php echo $sukses_message; ?>',
});
</script>
<?php endif; ?>

<?php if ($pas_beda): ?>
<script>
Swal.fire({
    icon: 'warning',
    title: 'PASSWORD!!',
    text: '<?php echo $pas_beda; ?>',
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
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card card-profil">
                    <div class="card-body">
                        <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                            <img src="<?php echo base_url(); ?>assets/images/user/<?php echo $userdata->foto; ?> "
                                class="img-lg rounded" alt="profile" />
                            <div class="ms-sm-3 ms-md-0 ms-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                <h6 class="mb-0"><?php echo $userdata->nama; ?></h6>
                                <p>
                                <h2 class="mb-0 text-success font-weight-bold text-center">
                                    <?php echo $userdata->no_rumah; ?></h2>
                                </p>
                            </div>
                        </div>
                        <div class="border-top mt-2">
                            <div class="row mt-3 mb-0">
                                <div class=" col-6">
                                    <h6>Username :</h6>
                                </div>
                                <div class="col-2">
                                </div>
                                <div class="col-4">
                                    <h6 class="text-info font-weight-bold"><?php echo $userdata->no_rumah; ?></h6>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-md-9 stretch-card grid-margin">
                <div class="card pb-0 mb-0">
                    <div class="card-body pt-0 mt-0 pb-1 mb-1">
                        <div class="nav-tabs-custom pb-0 mb-0">
                            <ul class="nav nav-tabs mt-0 pb-1 pt-0">
                                <div class="template-demo">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-outline-info" href="#settings"
                                            data-toggle="tab">
                                            <i class="ti-unlink"> Settings</i>
                                        </button>
                                        <button type="button" class="btn btn-outline-success">
                                            <i class="ti-layout-grid2-thumb" href="#password" data-toggle="tab"> Ubah
                                                Password</i>
                                        </button>
                                    </div>
                                </div>
                            </ul>
                            <div class="tab-content pb-0 mb-0 mt-1 pt-2">
                                <div class="active tab-pane" id="settings">
                                    <form class="form-horizontal" action="<?php echo base_url('Profile/update') ?>"
                                        method="POST" enctype="multipart/form-data">
                                        <div class="form-group row pb-0 mb-0">
                                            <label for="exampleInputUsername2"
                                                class="col-sm-3 col-form-label">Username</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Username"
                                                    name="no_rumah" value="<?php echo $userdata->no_rumah; ?>" disabled>
                                                <input type="text" class="form-control" placeholder="Username"
                                                    name="no_rumah" value="<?php echo $userdata->no_rumah; ?>" hidden>
                                            </div>
                                        </div>

                                        <div class="form-group row pb-0 mb-0">
                                            <label for="exampleInputUsername1"
                                                class="col-sm-3 col-form-label">Nama</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="exampleInputUsername1"
                                                    placeholder="Username" name="nama"
                                                    value="<?php echo $userdata->nama; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row pb-0 mb-0">
                                            <label for="exampleInputUsername1" class="col-sm-3 col-form-label">No
                                                Telephone</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="exampleInputUsername1"
                                                    placeholder="Username" name="no_hp"
                                                    value="<?php echo $userdata->no_hp; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row pb-0 mb-0">
                                            <label for="exampleInputUsername3" class="col-lg-3 col-form-label">File
                                                upload</label>
                                            <input type="file" name="foto" class="file-upload-default">
                                            <div class="input-group col-xs-12 col-sm-5 col-lg-9">
                                                <input type="text" class="form-control file-upload-info" disabled
                                                    placeholder="Upload Image">
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-primary"
                                                        type="button">Upload</button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group pb-0 mb-0 mt-2">
                                            <div class="col-sm-offset-2 col-sm-10 ml-0 pl-0">
                                                <button type="submit" class="btn btn-warning mr-2 ti-thumb-up">
                                                    Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="password">
                                    <form class="forms-sample" action="<?php echo base_url('Profile/ubah_password') ?>"
                                        method="POST">
                                        <div class="form-group row pb-0 mb-0">
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="username"
                                                    style="display: none;" autocomplete="username">
                                            </div>
                                        </div>
                                        <div class="form-group row pb-0 mb-0">
                                            <label class="col-sm-3 col-form-label">Password
                                                Lama</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" placeholder="Password Lama"
                                                    name="passLama" autocomplete="current-password">
                                            </div>
                                        </div>
                                        <div class="form-group row pb-0 mb-0">
                                            <label class="col-sm-3 col-form-label">Password
                                                Baru</label>
                                            <div class="col-sm-9">
                                                <input type="password" name="passBaru" class="form-control"
                                                    placeholder="Password Baru" autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="form-group row pb-0 mb-0">
                                            <label class="col-sm-3 col-form-label">Password
                                                Konfirmasi</label>
                                            <div class="col-sm-9">
                                                <input type="password" name="passKonf" class="form-control"
                                                    placeholder="Password Konfirmasi" autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="form-group pb-0 mb-0 mt-2">
                                            <div class="col-sm-offset-2 col-sm-10 ml-0 pl-0">
                                                <button type="submit" class="btn btn-warning mr-2 ti-thumb-up">
                                                    Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>