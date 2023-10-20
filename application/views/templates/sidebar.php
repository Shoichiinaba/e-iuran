<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('Dashboard'); ?> ">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <?php if ($userdata->role == 'RT') : ?>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tagihan" aria-expanded="false" aria-controls="ui-basic">
                <i class="ti-write menu-icon"></i>
                <span class="menu-title">Kelola Tagihan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tagihan">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?php echo site_url('Data_tagihan'); ?> ">Data
                            Tagihan</a>
                    </li>
                </ul>
                <!-- <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="<?php echo site_url('Data_tagihan/confm_tagihan'); ?>">Konfirmasi Tagihan</a>
                    </li>
                </ul> -->
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="<?php echo site_url('Data_tagihan/data_transaksi'); ?>">Data Transaksi</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#warga" aria-expanded="false" aria-controls="warga">
                <i class="ti-comments-smiley menu-icon"></i>
                <span class="menu-title">Kelola Warga</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="warga">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="<?php echo site_url('Warga'); ?> ">Data Warga</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#iuran" aria-expanded="false" aria-controls="charts">
                <i class="ti-agenda menu-icon"></i>
                <span class="menu-title">Kelola Iuran</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="iuran">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?php echo site_url('Data_iuran'); ?> ">Data
                            Iuran</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#saldo" aria-expanded="false" aria-controls="charts">
                <i class="ti-money menu-icon"></i>
                <span class="menu-title">Saldo Keluar</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="saldo">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?php echo site_url('Histori_tarik'); ?> ">History
                            Saldo </a>
                    </li>
                </ul>
            </div>
        </li>
        <?php endif; ?>

        <!-- MENU ADMIN -->
        <?php if ($userdata->role == 'Admin') : ?>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tagihan" aria-expanded="false" aria-controls="ui-basic">
                <i class="ti-write menu-icon"></i>
                <span class="menu-title">Kelola Tagihan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tagihan">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?php echo site_url('Data_tagihan'); ?> ">Data
                            Tagihan</a>
                    </li>
                </ul>
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="<?php echo site_url('Data_tagihan/data_transaksi'); ?>">Data Transaksi</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#iuran" aria-expanded="false" aria-controls="charts">
                <i class="ti-agenda menu-icon"></i>
                <span class="menu-title">Kelola Iuran</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="iuran">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?php echo site_url('Data_iuran'); ?> ">Data
                            Iuran</a>
                    </li>
                </ul>
            </div>
            <div class="collapse" id="iuran">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="<?php echo site_url('Data_iuran/nama_iuran'); ?> ">Nama
                            Iuran</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#perum" aria-expanded="false" aria-controls="tables">
                <i class="ti-home menu-icon"></i>
                <span class="menu-title">Perumahan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="perum">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?php echo site_url('Perumahan'); ?>">Data
                            Perumahan</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="<?php echo site_url('Perumahan/rtrw'); ?> ">Data RT
                            RW</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#warga" aria-expanded="false" aria-controls="warga">
                <i class="ti-comments-smiley menu-icon"></i>
                <span class="menu-title">Kelola Warga</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="warga">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="<?php echo site_url('Warga'); ?> ">Data Warga</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#saldo" aria-expanded="false" aria-controls="charts">
                <i class="ti-money menu-icon"></i>
                <span class="menu-title">Saldo Keluar</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="saldo">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?php echo site_url('Tarik_saldo'); ?> ">Tarik
                            Saldo </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#setting" aria-expanded="false" aria-controls="tables">
                <i class="ti-settings menu-icon"></i>
                <span class="menu-title">Pengaturan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="setting">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?php echo site_url('Setting_xendit'); ?> ">API
                            Xendit</a>
                    </li>
                </ul>
            </div>
        </li>
        <?php endif; ?>

        <?php if ($userdata->role == 'Warga') : ?>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('Profile'); ?> ">
                <i class="ti-user menu-icon"></i>
                <span class="menu-title">Profil saya</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('Riwayat_transaksi'); ?> ">
                <i class="ti-receipt menu-icon"></i>
                <span class="menu-title">Riwayat transaksi</span>
            </a>
        </li>
        <?php endif; ?>
    </ul>
</nav>