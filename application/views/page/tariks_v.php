<style>
.bg-gradient-primary {
    border-radius: 20px;
}
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <?php foreach ($perum as $data) { ?>
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card grid-margin mr-0 pr-0">
                        <div class="card">
                            <a href="<?= base_url('Tarik_saldo/form_tarik/'.$data->id_perumahan) ?>" type="button">
                                <div class="card-body bg-gradient-primary pb-1 mb-1">
                                    <h4 class="card-title text-white mb-2 mt-0"><?= $data->nama; ?></h4>
                                    <div class="d-flex align-items-center pb-0 border-bottom">
                                        <img class="img-sm rounded-circle mb-3"
                                            src="<?php echo base_url(); ?>assets/images/perum/<?php echo $data->gambar; ?>"
                                            alt="profile">
                                        <div class="ms-2 mt-0">
                                            <div class="d-flex justify-content-between ml-0 pl-0">
                                                <h4 class="text-white">Saldo</h4>
                                                <p class="text-white pl-4">
                                                    <?= isset($perum_balances[$data->id_perumahan]) ? $perum_balances[$data->id_perumahan] : 'Saldo tidak tersedia'; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 mt-2 pb-1">
                                        <div class="d-flex justify-content-between ml-0 pl-0">
                                            <h6 class="text-white">Saldo Segel </h6>
                                            <p class="text-white pl-4">
                                                <?= isset($segel_balances[$data->id_perumahan]) ? $segel_balances[$data->id_perumahan] : 'Saldo tidak tersedia'; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>