<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-Iuran Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url('assets'); ?>/images/logo_e/hi.png" />
</head>
<style>
.log {
    background-color: white;
    border-bottom: none;
}

.form-group {
    position: relative;
    width: 100%;
}

.form-control {
    width: 100%;
    padding-right: 40px;
}

.toggle-password {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    z-index: 2;
}

.card .row {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.background-icon {
    display: flex;
    justify-content: center;
    align-items: center;
}

.text-center .social-icon {
    margin-bottom: 20px;
}

.judul {
    position: relative;
    z-index: 2;
    margin-top: -15px;
}

.green-icon {
    color: #25D366;
    transition: color 0.3s ease;
}

.green-icon:hover {
    color: #ffffff;
}

.login-card {
    border-radius: 15px;
}
</style>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0 pt-0 mt-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5 login-card shadow">
                            <div class="card-header text-center pt-0 mt-0 log">
                                <img src="<?= base_url(); ?>assets/images/logo_e/HI-CARE-logo.png" alt="Logo" width="80"
                                    height="80">
                            </div>
                            <h6 class="font-weight-light text-center">Sign in to continue.</h6>
                            <form action="<?= site_url('Auth/client_login') ?>" method="post">
                                <!-- Alert -->
                                <?php if (validation_errors() || $this->session->flashdata('result_login')) { ?>
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

                                <?php $data = $this->session->flashdata('sukses'); if ($data != "") { ?>
                                <div class="alert alert-success"><strong>Sukses! </strong> <?= $data; ?></div>
                                <?php } ?>
                                <!-- akhir alert -->
                                <div class="form-group">
                                    <input class="form-control form-control-lg rounded" type="text" name="username"
                                        id="username" required="" autocomplete="off"
                                        placeholder="Enter no rumah Anda...">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg rounded" name="password"
                                        id="password" placeholder="Password" autocomplete="current-password">
                                    <i class="toggle-password fa fa-eye"
                                        onclick="togglePasswordVisibility('password')"></i>
                                </div>
                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"><i
                                            class="fa fa-sign-in btn-icon-prepend"></i> SIGN
                                        IN</button>
                                </div>

                            </form>
                        </div>
                        <div class="col-md-12 col-sm-12 stretch-card grid-margin grid-margin-md-0 mt-3 pt-2 pl-0 pr-0">
                            <div class="card data-icon-card-primary shadow">
                                <div class="card-body">
                                    <p class="text-white judul">Informasi & Pengaduan Bisa Hubungi Customer
                                        Care!!</p>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <a href="https://wa.me/6282333507931?text=Hallo%20Hi-care%20..."
                                                target="_blank" class="social-icon">
                                                <i class="fa fa-whatsapp green-icon" style="font-size:40px;"></i>
                                            </a>
                                        </div>
                                        <div class="col-12 background-icon">
                                        </div>
                                    </div>
                                </div>
                            </div>
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

    <script>
    // show password
    function togglePasswordVisibility(inputId) {
        var passwordInput = document.getElementById(inputId);
        var icon = document.querySelector('.toggle-password');
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    </script>
</body>

</html>