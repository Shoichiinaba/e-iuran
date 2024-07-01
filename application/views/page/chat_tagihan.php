<style>
/* Mengatur tata letak elemen form secara horizontal */
.template-demo {
    display: flex;
    flex-wrap: wrap;
}

.input-wrapper {
    position: relative;
    line-height: 14px;
    margin: -15px 5px;
    display: block;
}

.dataTables_wrapper select {
    width: 140px;
    height: 30px;
}

.input-wrapper select {
    width: 100px;
    height: 32px;
}

.label-select {
    color: #bbb;
    font-size: 11px;
    text-transform: uppercase;
    position: absolute;
    z-index: 2;
    left: 20px;
    top: 14px;
    padding: 0 2px;
    pointer-events: none;
    background: #fff;

    -webkit-transition: -webkit-transform 100ms ease;
    -moz-transition: -moz-transform 100ms ease;
    -o-transition: -o-transform 100ms ease;
    -ms-transition: -ms-transform 100ms ease;
    transition: transform 100ms ease;
    -webkit-transform: translateY(-20px);
    -moz-transform: translateY(-20px);
    -o-transform: translateY(-20px);
    -ms-transform: translateY(-20px);
    transform: translateY(-20px);
}

input,
select {
    font-size: 13px;
    color: #555;
    outline: none;
    border: 1px solid #bbb;
    padding: 15px 20px 10px;
    border-radius: 10px;
    position: relative;
}

input:invalid+label,
select:invalid+label {
    -webkit-transform: translateY(0);
    -moz-transform: translateY(0);
    -o-transform: translateY(0);
    -ms-transform: translateY(0);
    transform: translateY(0);
}

input:focus,
select:focus {
    border-color: #2b96f1;
}

input:focus+label,
select:focus+label {
    color: #2b96f1;
    -webkit-transform: translateY(-20px);
    -moz-transform: translateY(-20px);
    -o-transform: translateY(-20px);
    -ms-transform: translateY(-20px);
    transform: translateY(-20px);
}

.btn-custom {
    width: 106px;
    height: 27px;
}

.btn-buka-custom {
    width: 120px;
    height: 27px;
}

.btn-segel {
    width: 93px;
    height: 27px;
}

.btn-print {
    width: 58px;
    height: 40px;
    border-radius: 11px;
}
</style>

<!-- alerts -->
<?php
        $sukses_message = $this->session->flashdata('sukses');
        $gagal_message = $this->session->flashdata('gagal');
    ?>
<?php if ($sukses_message): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Pembayaran!',
    text: '<?php echo $sukses_message; ?>',
});
</script>
<?php endif; ?>

<?php if ($gagal_message): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal!',
    text: '<?php echo $gagal_message; ?>',
});
</script>
<?php endif; ?>
<!-- akhir alerts -->

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body pt-1 mt-1">
                        <div class="row mb-1 pb-1">
                            <div class="col-md-12 grid-margin mb-0 pb-0">
                                <div class="col-xl-8 mb-4 mb-xl-0">
                                    <h4 class="font-weight-bold">Kelola Data Tagihan
                                    </h4>
                                </div>
                                <div class="row">
                                    <div class="row mb-2">
                                        <div class="col-lg-2 col-xxl-2 col-md-3 col-sm-3 mb-1">
                                            <div class="input-group input-group-sm filter">
                                                <span class="input-group-text text-body bg-gradient-primary">
                                                    <i class="fa fa-lock btn-icon-prepend" style="color:white;"
                                                        aria-hidden="true"></i>
                                                </span>
                                                <select class="form-control pt-1" id="fil-status-segel">
                                                    <option value=""> &nbsp; Filter Status</option>
                                                    <option value="0"> &nbsp; Harus Disegel</option>
                                                    <option value="1"> &nbsp; Tersegel</option>
                                                    <option value="2"> &nbsp; Buka Segel</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-xxl-2 col-md-3 col-sm-3 align-items-center mb-2 pb-2">
                                            <a id="cetak" target="_blank" href="#">
                                                <button type="button" class="btn bg-gradient-primary btn-print">
                                                    <i class="fa fa-print btn-icon-prepend text-center"
                                                        style="color:white;"></i>
                                                </button>
                                            </a>
                                        </div>
                                        <div class="col-md-8 col-lg-8 d-flex justify-content-end ml-auto mt-0 pt-0">
                                            <div class="row w-100">
                                                <div class="col-lg-4 col-md-4 grid-margin mb-1 pb-1">
                                                    <div class="card d-flex align-items-left shadow-lg">
                                                        <div class="card-body pl-2 ml-2 pr-1 mr-1 mb-0 pb-0">
                                                            <div class="d-flex flex-row align-items-center">
                                                                <i
                                                                    class="fa fa-unlock-alt text-info icon-md mb-2 pb-2"></i>
                                                                <div class="ms-2">
                                                                    <b class="mt-0 text-info card-text">Harus
                                                                        Disegel</b>
                                                                    <h6 class="card-title text-info pt-1 mt-0"
                                                                        style="font-size: 15px;"><?= $harus_segel?></h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 grid-margin mb-1 pb-1">
                                                    <div class="card d-flex align-items-left shadow-lg">
                                                        <div class="card-body pl-2 ml-2 pr-1 mr-1 mb-0 pb-0">
                                                            <div class="d-flex flex-row align-items-center">
                                                                <i class="fa fa-lock text-danger icon-md mb-2 pb-2"></i>
                                                                <div class="ms-2">
                                                                    <b class="mt-0 text-danger card-text">Tersegel</b>
                                                                    <h6 class="card-title text-danger pt-1 mt-0"
                                                                        style="font-size: 15px;"><?= $tersegel?></h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 grid-margin mb-2 pb-2">
                                                    <div class="card d-flex align-items-left shadow-lg">
                                                        <div class="card-body pl-2 ml-2 pr-1 mr-1 mb-0 pb-0">
                                                            <div class="d-flex flex-row align-items-center">
                                                                <i
                                                                    class="fa fa-unlock text-success icon-md mb-2 pb-2"></i>
                                                                <div class="ms-2">
                                                                    <b class="mt-2 text-success card-text">Buka
                                                                        Segel</b>
                                                                    <h6 class="card-title text-success pt-1 mt-0"
                                                                        style="font-size: 15px;"><?= $buka_segel?></h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-1 mt-1 pt-1">
                                            <button type="button" class="btn btn-outline-success btn-sm btn-icon-text"
                                                onclick="broadcast()">
                                                <i class="fa fa-whatsapp"></i>
                                                Broadcast WA
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="data-chat" class="display expandable-table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama || No Rumah</th>
                                                    <th>Periode</th>
                                                    <th>Bulan</th>
                                                    <th>Total + Tax</th>
                                                    <th>Status </th>
                                                    <th>Aksi </th>
                                                    <th>Status WA </th>
                                                    <th>Jml. Chat </th>
                                                </tr>
                                            </thead>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="4" class="bg-primary text-right text-light"
                                                        style="font-weight: bold;">Total: &nbsp;
                                                    </th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        var table;

        table = $('#data-chat').DataTable({
            "paging": true,
            "autoWidth": true,
            "search": true,
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?=site_url('Chat_tagihan/get_datachat')?>",
                "type": "POST",
                "data": function(d) {
                    d.status_segel = $('#fil-status-segel').val();
                }
            },

            "columnDefs": [{
                "targets": [1, 2, 3, 4],
                "className": 'text-right'
            }],

            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                // Total Nominal
                var totalNominal = api.column(4, {
                        page: 'current'
                    }).data()
                    .reduce(function(a, b) {
                        return a + parseFloat(b.replace(/[^\d.-]/g, ''));
                    }, 0);

                // Ambil totalNominal dari objek output
                var totalNominalObj = api.ajax.json().totalNominal;

                $(api.column(4, {
                    page: 'current'
                }).footer()).html(totalNominalObj);
            }
        })
        $('#fil-status-segel').on('change', function() {
            // debugging apakah nilai select muncul
            // console.log('Nilai select: ' + $(this).val());
            table.draw();
        });
    });

    function segel_meteran(id_warga) {
        Swal.fire({
            title: 'Apakah Anda yakin ingin menyagel?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Segel Meteran!'
        }).then((result) => {
            if (result.isConfirmed) {
                sendSegelRequest(id_warga);
            }
        });
    }

    function sendSegelRequest(id_warga) {
        // console.log("ID Warga:", id_warga);
        $.ajax({
            url: '<?php echo base_url("Chat_tagihan/updateSegelStatus"); ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                id_warga: id_warga
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        position: "top-center",
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Penyegelan Berhasil dilakukan.',
                        timer: 1400
                    });

                    var table = $('#data-chat').DataTable();
                    table.ajax.reload(null, false);
                } else {
                    alert("Gagal Melakukan penyegelan.");
                }
            },
            error: function() {
                alert("Terjadi kesalahan saat mengirim request.");
            }
        });
    }


    function buka_segel($id_warga) {
        Swal.fire({
            title: 'Apakah Anda yakin ingin Membuka Segel?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Buka Segel!'
        }).then((result) => {
            if (result.isConfirmed) {
                bukaSegelRequest($id_warga);
            }
        });
    }

    function bukaSegelRequest(id_warga) {
        // console.log("ID Warga:", id_warga);
        $.ajax({
            url: '<?php echo base_url("Chat_tagihan/bukaSegel"); ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                id_warga: id_warga
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        position: "top-center",
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Penyegelan Berhasil Dibuka.',
                        timer: 1400
                    });

                    var table = $('#data-chat').DataTable();
                    table.ajax.reload(null, false);
                } else {
                    alert("Gagal Membuka penyegelan.");
                }
            },
            error: function() {
                alert("Terjadi kesalahan saat mengirim request.");
            }
        });
    }

    // kode untuk print pdf
    $('#cetak').on('click', function() {
        printFilteredData();
    });

    function printFilteredData() {
        var filter_segel = $('#fil-status-segel').val();

        var printUrl = "<?php echo site_url('Lap_segel/index'); ?>";
        printUrl += "?status_segel=" + filter_segel;

        window.open(printUrl, '_blank');
    }
    // akhir kode untuk print pdf

    // kode whatsapps broadcast
    function broadcast() {
        Swal.fire({
            title: 'Apakah Anda yakin ingin Kirim Broadcast WA?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Kirim!'
        }).then((result) => {
            if (result.isConfirmed) {
                kirimRequest();
            }
        });
    }

    function kirimRequest() {
        $.ajax({
            url: '<?php echo base_url("Chat_tagihan/API_wa"); ?>',
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        position: "top-center",
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Pesan Broadcast Berhasil terkirim.',
                        timer: 1400
                    });
                } else {
                    Swal.fire({
                        position: "top-center",
                        icon: 'error',
                        title: 'Gagal',
                        text: response.message,
                        timer: 1400
                    });
                }
            },
            error: function() {
                Swal.fire({
                    position: "top-center",
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Terjadi kesalahan saat mengirim request.',
                    timer: 1400
                });
            }
        });
    }
    </script>