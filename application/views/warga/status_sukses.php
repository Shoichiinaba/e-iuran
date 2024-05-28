<style>
.container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.pay {
    width: 100%;
    max-width: 400px;
}

.image-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
}

.img-custom {
    max-width: 48%;
    max-height: 48%;
    object-fit: contain;
}
</style>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome <i class="text-info"><?php echo $userdata->nama; ?></i>
                        </h3>
                    </div>
                </div>
                <div class="container">
                    <div class="card pay col-lg-4 col-sm-12">
                        <div class="image-container">
                            <img class="card-img-top img-custom"
                                src="<?= base_url('assets'); ?>/images/payment/payment.png" alt="Image image">
                        </div>
                        <div class="card-body pt-1 mb-0 pb-0">
                            <h4 class="card-title mt-3 text-center text-success">Pembayaran Berhasil</h4>
                            <?php foreach ($transaksi as $data) { ?>
                            <h4 class="card-title mt-3 text-center primary"><?= $data->code_tagihan; ?></h4>

                            <p class="card-text"> Nama : <?= $data->nama; ?></p>
                            <p class="card-text"> Blog : <?= $data->no_rumah; ?></p>
                            <p class="card-text"> Tanggal : <?= $data->tgl_byr; ?></p>
                            <p class="card-text"> Pembayaran : <?= $data->foto_bukti; ?></p>
                            <h4 class="card-title mt-3 text-center text-primary">Rp.
                                <?= number_format($data->jumlah, 0, ',', '.'); ?></h4>
                            <?php } ?>
                        </div>
                        <div class="text-center mb-2">
                            <a href="<?= site_url('Dashboard') ?>" class="btn btn-outline-primary btn-sm">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>