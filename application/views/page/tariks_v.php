<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <?php
                            foreach ($perum as $data) {
                        ?>
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
                        <div class="card">
                            <a href="<?= base_url('Tarik_saldo/form_tarik/'.$data->id_perumahan) ?>" type="button">
                                <div class="card-body bg-gradient-primary">
                                    <h4 class="card-title text-white"><?= $data->nama; ?></h4>
                                    <input type="text" id="id_perum" class="col-lg-12"
                                        value="<?= $data->id_perumahan; ?>" hidden>
                                    <!-- <div class="d-flex justify-content-between">
                                        <p class="text-muted">Saldo</p>
                                        <p class="text-muted"><?=$totalDPP; ?></p>
                                    </div>
                                    <div class="progress progress-md">
                                        <div class="progress-bar bg-info w-25" role="progressbar" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> -->
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                            }
                        ?>
                </div>
            </div>

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

</div>

<script>
$(document).ready(function() {
    $("#id_perum").on("input", function() {
        var id_perum = $(this).val();

        $.ajax({
            url: '<?php echo base_url('Tarik_saldo') ?>',
            type: 'GET',
            data: {
                id_perum: id_perum
            },

            success: function(response) {
                console.log(response);
            },

        });
    });
});
</script>