<style>
    .Belumbayar {
        background: #f2a2a7;
    }
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Riwayat Transaksi</i>
                        </h3>
                        <!-- <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-3 pb-3">
            <ul class="pl-0 mb-0" style="display: flex;list-style: none;">
                <li class="mr-2">
                    <button type="submit" class="btn btn-primary btn-md btn-riwayat-anda">Riwayat transaksi anda</button>
                </li>
                <li>
                    <button type="submit" class="btn btn-light btn-md btn-riwayat-warga">Riwayat transaksi warga</button>
                </li>
            </ul>
            <!-- <div class="card-body"> -->
            <div id="load-data-riwayat"></div>
            <!-- </div> -->
        </div>
    </div>
    <script>
        $('.btn-riwayat-anda').click(function() {
            $('.btn-riwayat-anda').addClass('btn-primary').removeClass('btn-light')
            $('.btn-riwayat-warga').addClass('btn-light').removeClass('btn-primary')
            var action = 'anda';
            get_data_riwayat(action);
        });
        $('.btn-riwayat-warga').click(function() {
            $('.btn-riwayat-warga').addClass('btn-primary').removeClass('btn-light')
            $('.btn-riwayat-anda').addClass('btn-light').removeClass('btn-primary')
            var action = 'warga';
            get_data_riwayat(action);
        });
        var action = 'anda';
        get_data_riwayat(action)

        function get_data_riwayat(action) {
            // alert(action);
            let formData = new FormData();
            formData.append('action', action);

            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('Riwayat_transaksi/get_data_riwayat'); ?>",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#load-data-riwayat').html(data);

                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
        }
    </script>