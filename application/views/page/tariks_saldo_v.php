<style>
.demo {
    display: flex;
    justify-content: center;
    align-items: flex-end;
    flex-direction: column;
    margin-top: 10px;
    margin-bottom: 2px;
}

.btn-icon-text {
    padding-top: 8px;
    padding-bottom: 8px;
    padding-right: 13px;
    padding-left: 13px;
}

.input-wrapper {
    position: relative;
    line-height: 14px;
    margin: 0 5px;
    display: grid;
}

.label-in {
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

.label-date {
    color: #bbb;
    font-size: 11px;
    text-transform: uppercase;
    position: absolute;
    z-index: 1;
    left: 50px;
    top: 14px;
    padding: 0 0px;
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

input {
    font-size: 13px;
    color: #555;
    outline: none;
    border: 1px solid #bbb;
    padding: 15px 20px 10px;
    border-radius: 10px;
    position: relative;
}

input:invalid+label {
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

input:focus+label {
    color: #2b96f1;
    -webkit-transform: translateY(-20px);
    -moz-transform: translateY(-20px);
    -o-transform: translateY(-20px);
    -ms-transform: translateY(-20px);
    transform: translateY(-20px);
}
</style>

<div class="main-panel">
    <div class="content-wrapper">
        <form id="tarik-saldo">
            <div class="row">
                <div class="col-lg-3 grid-margin stretch-card mb-2 pt-2">
                    <div class="card">
                        <div class="card card-light bg-success">
                            <div class="card-body">
                                <h2 class="mb-4">Saldo</h2>
                                <h1 class="fs-80 mb-3 text-center" style="color:white"><?=$totalDPP; ?></h1>
                                <p class="fs-30 mb-2"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 grid-margin stretch-card mb-2 pt-2">
                    <div class="card">
                        <div class="card-body pb-2 pr-2">
                            <h4 class="card-title">Form Tarik Saldo</h4>
                            <div class="input-group pb-0">
                                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 pr-1">
                                    <div class="input-wrapper">
                                        <label class="label-in">No. penarikan</label>
                                        <input type="text" id="no_tarik" value="<?= $nomer; ?>" class="col-lg-12"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 pr-1">
                                    <div id="datepicker-popup" class="input-group date datepicker">
                                        <label class="label-date">Tanggal</label>
                                        <input type="text" id="tanggal" class="form-control">
                                        <span class="input-group-addon input-group-append border-left">
                                            <span class="ti-calendar input-group-text"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 pr-1" hidden>
                                    <div class="input-wrapper">
                                        <label class="label-in">Perumahan</label>
                                        <input type="text" id="id-perum" class="col-lg-12"
                                            value="<?php echo  $this->uri->segment(3); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 pr-1">
                                    <div class="input-wrapper">
                                        <label class="label-in">Nominal</label>
                                        <input type="text" id="nominal" value="<?= $DPP; ?>" class="col-lg-12" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12  mt-1 mb-2 pr-2">
                                    <div class="input-wrapper">
                                        <input type="number" id="fee" class="col-lg-12">
                                        <label class="label-in">Fee %</label>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12  mt-1 mb-2 pr-2" hidden>
                                    <div class="input-wrapper">
                                        <input type="number" id="Rp_fee" class="col-lg-12">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12  mt-1 mb-2 pr-2">
                                    <div class="input-wrapper">
                                        <label class="label-in">Total</label>
                                        <input type="number" id="totdpp" class="col-lg-12" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="demo">
                                <button type="submit" id="tombol" class="btn btn-outline-success btn-icon-text">
                                    <i class="ti-archive"> </i>
                                    Tarik Saldo
                                </button>
                            </div>
                        </div>
                    </div>
        </form>
    </div>
</div>

<div class="row pt-2">
    <div class="col-md-12 col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body pt-1 mt-1">
                <div class="row mb-1 pb-1">
                    <div class="col-md-12 grid-margin mb-0 pb-0">
                        <div class="row">
                            <div class="col-3 col-xl-8 mb-4 mb-xl-0">
                                <h4 class="font-weight-bold">Data Tarik Saldo
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="data-trxsal" class="display expandable-table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No. Penarikan</th>
                                            <th>Nama perumahan</th>
                                            <th>Tanggal</th>
                                            <th>Nominal</th>
                                            <th>Fee</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    </tbody>
                                    <tfoot>
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

<!-- kode javascript untuk manipulasi data -->
<script>
$(document).ready(function() {

    // kode ajax untuk membuat tagihan
    $('#tarik-saldo').submit(function(event) {
        event.preventDefault();

        var id_perum = $('#id-perum').val();
        var no_tarik = $('#no_tarik').val();
        var tanggal = $('#tanggal').val();
        var nominal = $('#nominal').val();
        var fee = $('#fee').val();
        var totdpp = $('#totdpp').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('Tarik_saldo/buat_tarik') ?>',
            data: {

                id_perum: id_perum,
                no_tarik: no_tarik,
                tanggal: tanggal,
                nominal: nominal,
                fee: fee,
                totdpp: totdpp,

            },
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    console.log(
                        response);

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Tagihan Berhasil Dibuat.',
                    });
                    // Bersihkan nilai input secara manual
                    $('#id_perum').val('');
                    $('#fee').val('');
                    $('#totdpp').val('');
                    // Bersihkan input lainnya sesuai kebutuhan

                    window.location.href =
                        "<?php echo base_url('Tarik_saldo/form_tarik'); ?>";
                } else {
                    console.error('Terjadi kesalahan saat validasi data di server.');

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat validasi data di server.',
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat mengirim data ke server.',
                });
            }
        });
    });

    // datatable tagihan

});

var table;

table = $('#data-trxsal').DataTable({
    "paging": true,
    "autoWidth": true,
    "search": true,
    "responsive": true,
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "<?=site_url('Tarik_saldo/get_data_tf/')?><?= $this->uri->segment(3);?>",
        "type": "POST",
    },

    "columnDefs": [{
            "targets": [6],
            "className": 'text-right'
        },
        {
            "targets": [1, 2, 3, 4],
            "className": 'text-left'
        },
        {
            "targets": [0],
            "className": 'text-center'
        },
        {
            "targets": [1, 3, 4, 6],
            "orderable": false
        },
    ]
})

// kode untuk menghitung hasil saldo + fee
const nominalInput = document.getElementById('nominal');
const feeInput = document.getElementById('fee');
const rpfeeInput = document.getElementById('Rp_fee');
const totaldppInput = document.getElementById('totdpp');

// Fungsi untuk menghitung dan menampilkan hasilnya di 'saldo'
function hitungfeetarik() {
    const nominalValue = parseFloat(nominalInput.value);
    const feeValue = parseFloat(feeInput.value);

    if (!isNaN(nominalValue) && !isNaN(feeValue)) {
        const hasiltarik = nominalValue * feeValue / 100;
        rpfeeInput.value = hasiltarik.toFixed(0);

        saldodpp = nominalValue - hasiltarik
        totaldppInput.value = saldodpp.toFixed(0);
    }
}

feeInput.addEventListener('input', hitungfeetarik);

hitungfeetarik();
// kode untuk menghitung hasil saldo + fee

// kode menonaktifkan tombol jika saldo 0
document.addEventListener("DOMContentLoaded", function() {
    var nominalInput = document.getElementById("nominal");
    var tombol = document.getElementById("tombol");

    nominalInput.addEventListener("input", function() {
        if (parseFloat(nominalInput.value) === 0) {
            tombol.disabled = true;
        } else {
            tombol.disabled = false;
        }
    });

    if (parseFloat(nominalInput.value) === 0) {
        tombol.disabled = true;
    }
});
// akhir kode menonaktifkan tombol jika saldo 0
</script>