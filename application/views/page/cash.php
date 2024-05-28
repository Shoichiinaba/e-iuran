<style>
@-webkit-keyframes placeHolderShimmer {
    0% {
        background-position: -468px 0;
    }

    100% {
        background-position: 468px 0;
    }
}

@keyframes placeHolderShimmer {
    0% {
        background-position: -468px 0;
    }

    100% {
        background-position: 468px 0;
    }
}

.content-placeholder {
    display: inline-block;
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
    -webkit-animation-iteration-count: infinite;
    animation-iteration-count: infinite;
    -webkit-animation-name: placeHolderShimmer;
    animation-name: placeHolderShimmer;
    -webkit-animation-timing-function: linear;
    animation-timing-function: linear;
    background: #f6f7f8;
    background: -webkit-gradient(linear, left top, right top, color-stop(8%, #eeeeee), color-stop(18%, #dddddd), color-stop(33%, #eeeeee));
    background: -webkit-linear-gradient(left, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
    background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
    -webkit-background-size: 800px 104px;
    background-size: 800px 104px;
    height: inherit;
    position: relative;
}

.post_data {
    padding: 24px;
    border: 1px solid #f9f9f9;
    border-radius: 5px;
    margin-bottom: 24px;
    box-shadow: 10px 10px 5px #eeeeee;
}
</style>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="popover-static-demo">
                <div class="col-lg-12 col-xxl-10 col-md-10 col-sm-12">
                    <div class="justify-content-center d-flex">
                        <div class="input-group input-group-sm filter">
                            <span class="input-group-text text-body bg-gradient-primary">
                                <i class="fa fa-search" style="color:white;" aria-hidden="true"></i>
                            </span>
                            <input type="text" class="form-control" id="search-tagihan" name="search"
                                placeholder=" Masukan Blok Atau Nama">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 grid-margin stretch-card pt-3 mt-3">
                    <div class="card" id="load_data"></div>
                </div>
                <div id="load_data_message"></div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        const limit = 7;
        let start = 0;
        let action = 'inactive';

        function lazy_loader(limit) {
            let output = '';
            for (let i = 0; i < limit; i++) {
                output += '<div class="post_data">';
                output +=
                    '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
                output +=
                    '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
                output += '</div>';
            }
            $('#load_data_message').html(output);
        }

        function load_data(limit, start, search = '') {
            $.ajax({
                url: "<?php echo base_url(); ?>Pembayaran_cash/fetch",
                method: "POST",
                data: {
                    limit: limit,
                    start: start,
                    search: search
                },
                cache: false,
                success: function(data) {
                    if (data.trim() === '') {
                        $('#load_data_message').html(
                            '<div class="alert alert-danger alert-dismissible shadow-lg p-3 mb-4" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span></button>' +
                            '<i class="fa fa-folder-open"></i> Data Event Tidak Ada Lagi...</div>'
                        );
                        action = 'active';
                    } else {
                        $('#load_data').append(data);
                        $('#load_data_message').html("");
                        action = 'inactive';
                    }
                },
                error: function() {
                    $('#load_data_message').html(
                        '<div class="alert alert-danger alert-dismissible shadow-lg p-3 mb-4" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span></button>' +
                        '<i class="fa fa-exclamation-triangle"></i> Gagal memuat data...</div>'
                    );
                    action = 'inactive';
                }
            });
        }

        function debounce(func, wait) {
            let timeout;
            return function() {
                const context = this,
                    args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }

        $('#search-tagihan').on('input', debounce(function() {
            const search = $(this).val();
            if (search.trim() !== '') {
                $('#load_data').html('');
                start = 0;
                lazy_loader(limit);
                load_data(limit, start, search);
            } else {
                $('#load_data').html('');
                $('#load_data_message').html('');
            }
        }, 500));

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action ===
                'inactive') {
                lazy_loader(limit);
                action = 'active';
                start += limit;
                setTimeout(function() {
                    load_data(limit, start);
                }, 1000);
            }
        });

        $(document).on('click', '.pilih-tombol', function() {
            const id_warga = $(this).data('id-warga');
            window.location.href = "<?php echo base_url(); ?>Dashboard/?id=" + id_warga;
        });

    });
    </script>