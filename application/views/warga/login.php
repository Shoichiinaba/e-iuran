<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-Iuran Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url('assets'); ?>/images/auth/logo1.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="card-header text-center pt-4">
                                <img src="<?= base_url(); ?>assets/images/auth/logo1.png" alt="Logo" width="50"
                                    height="50">
                            </div>
                            <h4 class="text-center">E-iuran</h4>
                            <h6 class="font-weight-light text-center">Sign in to continue.</h6>
                            <form action="<?= site_url('Auth/client_login') ?>" method="post">
                                <!-- Alert -->
                                <?php
                                        if (validation_errors() || $this->session->flashdata('result_login')) {
                                        ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <span class="alert-icon"><i class="fa fa-warning"></i></span>
                                    <strong>Warning!</strong>
                                    <?php echo validation_errors(); ?>
                                    <?php echo $this->session->flashdata('result_login'); ?>
                                    <?php echo $this->session->flashdata('Habis'); ?>
                                </div>
                                <?php } ?>

                                <?php
                                        $data = $this->session->flashdata('sukses');
                                        if ($data != "") { ?>
                                <div class="alert alert-success"><strong>Sukses! </strong> <?= $data; ?></div>
                                <?php } ?>
                                <!-- akhir alert -->
                                <div class="form-group">
                                    <input class="form-control form-control-lg" type="text" name="username"
                                        id="username" required="" autocomplete="off"
                                        placeholder="Enter no rumah Anda...">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="password"
                                        id="password" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN
                                        IN</button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input">
                                            Keep me signed in
                                        </label>
                                    </div>
                                    <a href="#" class="auth-link text-black">Forgot password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= base_url('assets'); ?>/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url('assets'); ?>/js/off-canvas.js"></script>
    <script src="<?= base_url('assets'); ?>/js/hoverable-collapse.js"></script>
    <script src="<?= base_url('assets'); ?>/js/template.js"></script>
    <script src="<?= base_url('assets'); ?>/js/settings.js"></script>
    <script src="<?= base_url('assets'); ?>/js/todolist.js"></script>
    <!-- endinject -->
</body>

</html>