<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img
                src="<?= base_url('assets'); ?>/images/logo_e/HI-CARE.png" class="mr-2" alt="-iuran" /></a>
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
                <div class="input-group">
                    <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                        <span class="input-group-text" id="search">
                            <i class="icon-search"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now"
                        aria-label="search" aria-describedby="search">
                </div>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                    data-toggle="dropdown">
                    <i class="icon-bell mx-0 "></i>
                    <?php if ($userdata->role == 'RT') : ?>
                    <span class="badge badge-warning navbar-badge"><?=$menunggu; ?></span>
                    <?php endif; ?>

                    <?php if ($userdata->role == 'Warga') : ?>
                    <span class="badge badge-danger navbar-badge"></span>
                    <?php endif; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="notificationDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                    <a class="dropdown-item preview-item">
                        <?php if ($userdata->role == 'RT') : ?>
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-primary">
                                <i class="ti-info-alt mx-0"></i>
                            </div>
                        </div>

                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal">Bayar Tagihan</h6>
                            <p class="font-weight-light small-text mb-0 text-muted">
                                Atas nama
                            </p>
                        </div>

                        <?php endif; ?>
                        <?php if ($userdata->role == 'Warga') : ?>
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-success">
                                <i class="ti-info-alt mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal">Tagihan Bulan ini</h6>
                            <p class="font-weight-light small-text mb-0 text-muted">
                                Total: <?php echo isset($tagihan_air->nominal) ? $tagihan_air->nominal : 0; ?>
                            </p>
                        </div>
                        <?php endif; ?>
                    </a>
                </div>
            </li>
            <?php if ($userdata->role == 'Admin' || $userdata->role == 'RT') : ?>
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <img src="<?php echo base_url(); ?>assets/images/user/<?php echo $userdata->foto; ?> "
                        alt="profile" />
                </a>

                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="<?php echo site_url('Profile_adm'); ?> ">
                        <i class="ti-settings text-primary"></i>
                        Settings
                    </a>
                    <a class="dropdown-item" href="<?php echo site_url('Auth/logadm'); ?> ">
                        <i class="ti-power-off text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>
            <?php endif; ?>
            <?php if ($userdata->role == 'Warga') : ?>
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <img src="<?php echo base_url(); ?>assets/images/user/<?php echo $userdata->foto; ?> "
                        alt="profile" />
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="<?php echo site_url('Auth/logout'); ?> ">
                        <i class="ti-power-off text-primary"></i>
                        Logout
                    </a>
                </div>

            </li>
            <?php endif; ?>
        </ul>

        <?php if ($userdata->role == 'Admin') : ?>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
        <?php endif; ?>

        <?php if ($userdata->role == 'RT') : ?>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
        <?php endif; ?>

        <?php if ($userdata->role == 'Warga') : ?>
        <div class="d-md-block d-none">
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
        </div>
        <?php endif; ?>
    </div>
</nav>


<!-- settings-panel -->
<div class="container-fluid page-body-wrapper">
    <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
            <i class="settings-close ti-close"></i>
            <p class="settings-heading">SIDEBAR SKINS</p>
            <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
            </div>
            <div class="sidebar-bg-options" id="sidebar-dark-theme">
                <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
            </div>
            <p class="settings-heading mt-2">HEADER SKINS</p>
            <div class="color-tiles mx-0 px-4">
                <div class="tiles success"></div>
                <div class="tiles warning"></div>
                <div class="tiles danger"></div>
                <div class="tiles info"></div>
                <div class="tiles dark"></div>
                <div class="tiles default"></div>
            </div>
        </div>
    </div>
    <!-- end panel setting -->