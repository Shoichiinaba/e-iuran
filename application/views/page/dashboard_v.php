<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome <i class="text-info"><?php echo $userdata->nama; ?></i>
                        </h3>
                        <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span
                                class="text-primary">3 unread alerts!</span></h6>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                    id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="#">January - March</a>
                                    <a class="dropdown-item" href="#">March - June</a>
                                    <a class="dropdown-item" href="#">June - August</a>
                                    <a class="dropdown-item" href="#">August - November</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                    <div class="card-people mt-auto">
                        <img src="<?= base_url('assets'); ?>/images/dashboard/people.svg" alt="people">
                        <div class="weather-info">
                            <div class="d-flex">
                                <div>
                                    <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>30<sup>C</sup>
                                    </h2>
                                </div>
                                <div class="ml-2">
                                    <h4 class="location font-weight-normal">Semarang</h4>
                                    <h6 class="font-weight-normal">Indonesia</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($userdata->role == 'Admin') : ?>
            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Belum Bayar</p>
                                <p class="fs-30 mb-2"><?=$b_bayar; ?> Orang</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-light bg-warning">
                            <div class="card-body">
                                <p class="mb-4">Menunggu Pembayaran</p>
                                <p class="fs-30 mb-2"><?=$menunggu; ?> Orang</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-light bg-success">
                            <div class="card-body">
                                <p class="mb-4">Lunas</p>
                                <p class="fs-30 mb-2"><?=$lunas; ?> Orang</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">Total Warga</p>
                                <p class="fs-30 mb-2"><?=$jum_warga; ?> Orang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($userdata->role == 'RT') : ?>
            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <h3 class="mb-4">Saldo</h3>
                                <p class="fs-30 mb-2"><?=$totalDPP; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Belum Bayar</p>
                                <p class="fs-30 mb-2"><?=$b_bayar; ?> Orang</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-light bg-warning">
                            <div class="card-body">
                                <p class="mb-4">Menunggu Pembayaran</p>
                                <p class="fs-30 mb-2"><?=$menunggu; ?> Orang</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-light bg-success">
                            <div class="card-body">
                                <p class="mb-4">Lunas</p>
                                <p class="fs-30 mb-2"><?=$lunas; ?> Orang</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">Total Warga</p>
                                <p class="fs-30 mb-2"><?=$jum_warga; ?> Orang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>