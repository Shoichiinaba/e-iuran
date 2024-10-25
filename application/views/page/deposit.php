<link rel="stylesheet" href="<?= base_url('assets'); ?>/vendors/jquery-file-upload/uploadfile.css">
<style>
    /* Mengatur tata letak elemen form secara horizontal */
    .template-demo {
        display: flex;
        flex-wrap: wrap;
    }

    .file-upload-wrapper input[type="file"] {
        width: 154%;
    }


    .file-upload-container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        max-width: 400px;
        margin: 0 auto;
    }

    .file-upload-wrapper {
        width: 100%;
    }

    .image-preview-container {
        display: flex;
        justify-content: flex-start;
        width: 325%;
        margin-top: 5px;
        padding-left: 98px;
    }

    .image-preview-container img {
        max-width: 50%;
        /* Atur lebar maksimum gambar preview */
        max-height: 200px;
        object-fit: cover;
    }

    .dataTables_wrapper select {
        width: 140px;
        height: 30px;
    }

    .input-wrapper select {
        width: 232px;
        height: 40px;
    }

    .input-wrapper {
        position: relative;
        line-height: 14px;
        margin: 0 7px;
        display: grid;
    }

    .btn {
        border-radius: 10px;
        padding: 5px 10px;
        font-size: 20px;
    }

    .filter select {
        height: 30px !important;
    }

    .filter input {
        height: 30px !important;
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

    .label-select {
        color: #4B49AC;
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

    .label-pem {
        color: #77bd68;
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
    textarea,
    select {
        font-size: 12px;
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
    select:focus,
    textarea:focus {
        border-color: #2b96f1;
    }

    input:focus+label,
    select:focus+label,
    textarea:focus+label {
        color: #2b96f1;
        -webkit-transform: translateY(-20px);
        -moz-transform: translateY(-20px);
        -o-transform: translateY(-20px);
        -ms-transform: translateY(-20px);
        transform: translateY(-20px);
    }

    @media (max-width: 768px) {
        .flex-md-row {
            flex-direction: column !important;
        }
    }
</style>

<!-- alerts -->
<?php
$sukses_message = $this->session->flashdata('sukses');
$gagal_message = $this->session->flashdata('gagal');
?>
<?php if ($sukses_message) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Pembayaran!',
            text: '<?php echo $sukses_message; ?>',
        });
    </script>
<?php endif; ?>

<?php if ($gagal_message) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '<?php echo $gagal_message; ?>',
        });
    </script>
<?php endif; ?>
<!-- akhir alerts -->


<?php
$current_month = date('m');
$current_year = date('Y');
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body pt-1 mt-1">

                        <div class="row">
                            <div class="template-demo col-lg-4 col-md-4 pt-2 mb-1">
                                <div class="grid-margin pt-2 mb-2 pb-2">
                                    <button type="button" class="btn btn-outline-info btn-sm mr-2 pr-2 shadow" data-bs-toggle="modal" data-bs-target="#deposit">
                                        <svg data-name="Layer 1" id="Layer_1" viewBox="0 0 512 512" width="50px" height="50px" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M410.11,242.92V469.71h74.78V242.92Zm37.44,57.15a16.32,16.32,0,1,1,16.32-16.32A16.32,16.32,0,0,1,447.55,300.07Z" />
                                            <path d="M184.71,198.74a71.87,71.87,0,1,0,71.87-71.87A72,72,0,0,0,184.71,198.74Zm71.87-55.93a55.93,55.93,0,1,1-55.94,55.93A56,56,0,0,1,256.58,142.81Z" />
                                            <path d="M239.46,232.61a33.56,33.56,0,0,0,14.09,4.77v1.68a5.89,5.89,0,0,0,2.08,4.78,6.26,6.26,0,0,0,4,1.47A6.51,6.51,0,0,0,263.6,244a5.94,5.94,0,0,0,2.38-4.91v-1.87c5.18-.93,9.2-3,12-6a19.82,19.82,0,0,0,5.51-12.09,24.94,24.94,0,0,0-.37-7,20.14,20.14,0,0,0-3-7.55,21.19,21.19,0,0,0-6.44-6.06,25.84,25.84,0,0,0-7.69-3.19V173.31a15.2,15.2,0,0,1,2.83,2.65,9.77,9.77,0,0,1,1.79,3.21,18.73,18.73,0,0,1,.83,4c.4,3.27,3,5.43,6,5,2.63-.31,4.63-2.29,5.3-6.06-.15-6.22-2.18-11.3-6-15.1A22.78,22.78,0,0,0,266,161.12v-2.69a6.28,6.28,0,0,0-10.6-4.55,6.15,6.15,0,0,0-1.85,4.55v2a32,32,0,0,0-6.63,1.67,23.86,23.86,0,0,0-8.26,5.07,21.89,21.89,0,0,0-5.16,7.61,20.54,20.54,0,0,0-1.27,9.41,21.91,21.91,0,0,0,7.5,14.55,28,28,0,0,0,13.82,5.88l0,21.55a17.32,17.32,0,0,1-7.86-3A12.13,12.13,0,0,1,241,216.6a5.58,5.58,0,0,0-5.65-4.89,5.89,5.89,0,0,0-4.56,1.78,5.05,5.05,0,0,0-1,4.52A21.26,21.26,0,0,0,239.46,232.61Zm4.42-49.12a10.82,10.82,0,0,1,3.14-8.36,12.56,12.56,0,0,1,6.51-3.4v21.4a16.43,16.43,0,0,1-2.93-1,17.51,17.51,0,0,1-4.28-2.9,7.1,7.1,0,0,1-1.71-2.42A14.4,14.4,0,0,1,243.88,183.49Zm28.34,35.18a6.25,6.25,0,0,1-.43,1.87,7.65,7.65,0,0,1-1.28,2.37,10.43,10.43,0,0,1-3,2.32,7.43,7.43,0,0,1-1.49.62V207a10.48,10.48,0,0,1,3.94,2.68c1.63,1.88,2.4,4.87,2.3,8.88Z" />
                                            <path d="M118.44,217.54a50.37,50.37,0,1,0-50.37-50.37A50.42,50.42,0,0,0,118.44,217.54Zm0-84.8A34.43,34.43,0,1,1,84,167.17,34.46,34.46,0,0,1,118.44,132.74Z" />
                                            <path d="M198.47,121.17A39.44,39.44,0,1,0,159,81.73,39.49,39.49,0,0,0,198.47,121.17Zm0-62.95A23.51,23.51,0,1,1,175,81.73,23.53,23.53,0,0,1,198.47,58.22Z" />
                                            <path d="M235.12,294.41l-14-8.7a39.26,39.26,0,0,0-33.71-3.34l-6.55,2.73,32.82,18.09C220.56,300.28,227.8,297.31,235.12,294.41Z" />
                                            <path d="M106.66,286.59l-7.75,3.62,70.44,32.46c4.71-2.17,12.54-5.72,22.06-9.91l-45.77-25.22A43.93,43.93,0,0,0,106.66,286.59Z" />
                                            <path d="M378.52,316c-.42-.25-42.18-25.49-71.2-24-24.61,1.29-103.61,35.81-133.1,49.51a74.43,74.43,0,0,0-15.75,16,8.29,8.29,0,0,0-.28,9,9.45,9.45,0,0,0,9.1,5l125.16-8.89a9.56,9.56,0,1,1,1.37,19.08l-125.17,8.89a28.47,28.47,0,0,1-27.1-14.61,27.37,27.37,0,0,1,1.23-29.41,85.63,85.63,0,0,1,9.1-10.85l-79-36.41-.06,0-6.6-3a41.33,41.33,0,0,0-39.14,5l148.14,115.6a68.09,68.09,0,0,0,64.21,12.81l139.15-36.81a9.63,9.63,0,0,1,2.45-.32H391V317.35h-7.5A9.56,9.56,0,0,1,378.52,316Z" />
                                        </svg>
                                        <p class="mt-1 pt-1 mb-0 pb-0 pl-0 pr-0">Penerimaan</p>
                                    </button>
                                </div>
                            </div>
                            <div class="pt-2 mb-6 col-md-8 col-lg-8 col-sm-8 d-flex flex-column flex-md-row justify-content-end">
                                <div class="col-lg-4 col-md-4 col-sm-12 grid-margin pt-2 pt-2 pl-0 pr-1 pb-1 mb-1">
                                    <div class="card d-flex align-items-left shadow-lg">
                                        <div class="card-body pl-2 ml-2 pr-1 mr-1 mb-0 pb-0">
                                            <div class="d-flex flex-row align-items-right">
                                                <svg height="40px" width="40px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                                                    <path style="fill:#235BFD;" d="M416.542,364.475H17.356C7.77,364.475,0,356.705,0,347.119V86.78c0-9.586,7.77-17.356,17.356-17.356
	                                                    h399.186c9.586,0,17.356,7.77,17.356,17.356v260.339C433.898,356.705,426.128,364.475,416.542,364.475z" />
                                                    <path style="fill:#A0D755;" d="M399.186,199.593c-71.89,0-130.169,58.279-130.169,130.17c0,12.041,1.765,23.645,4.825,34.712h142.7
	                                                    c9.585,0,17.356-7.771,17.356-17.356v-142.7C422.832,201.358,411.227,199.593,399.186,199.593z" />
                                                    <path style="fill:#FFC850;" d="M130.169,199.593H60.746c-4.792,0-8.678-3.886-8.678-8.678v-52.068c0-4.792,3.886-8.678,8.678-8.678
	                                                    h69.424c4.792,0,8.678,3.886,8.678,8.678v52.068C138.847,195.708,134.962,199.593,130.169,199.593z" />
                                                    <g>
                                                        <path style="fill:#FFFFFF;" d="M121.492,271.186H52.068c-5.991,0-10.847-4.856-10.847-10.847c0-5.991,4.856-10.847,10.847-10.847
		                                                h69.424c5.991,0,10.847,4.856,10.847,10.847C132.339,266.33,127.483,271.186,121.492,271.186z" />
                                                        <path style="fill:#FFFFFF;" d="M329.763,323.254H52.068c-5.991,0-10.847-4.856-10.847-10.847s4.856-10.847,10.847-10.847h277.695
		                                                c5.991,0,10.847,4.856,10.847,10.847S335.754,323.254,329.763,323.254z" />
                                                    </g>
                                                    <path style="fill:#E4EAF8;" d="M329.763,301.559h-57.595c-1.556,7.03-2.455,14.287-2.823,21.695h60.417
	                                                    c5.991,0,10.847-4.856,10.847-10.847S335.754,301.559,329.763,301.559z" />
                                                    <path style="fill:#FFFFFF;" d="M225.627,271.186h-69.424c-5.991,0-10.847-4.856-10.847-10.847c0-5.991,4.856-10.847,10.847-10.847
	                                                    h69.424c5.991,0,10.847,4.856,10.847,10.847C236.475,266.33,231.618,271.186,225.627,271.186z" />
                                                    <path style="fill:#E1A546;" d="M112.814,156.203H95.458v-26.034H78.102v69.424h17.356v-26.034h17.356
	                                                    c4.792,0,8.678-3.886,8.678-8.678C121.492,160.089,117.606,156.203,112.814,156.203z" />
                                                    <circle style="fill:#FF507D;" cx="290.712" cy="160.542" r="39.051" />
                                                    <circle style="fill:#FFC850;" cx="342.78" cy="160.542" r="39.051" />
                                                    <path style="fill:#FF8C66;" d="M303.729,160.542c0,11.52,5.082,21.769,13.017,28.916c7.935-7.147,13.017-17.396,13.017-28.916
	                                                    s-5.082-21.769-13.017-28.916C308.811,138.774,303.729,149.022,303.729,160.542z" />
                                                    <path style="fill:#FFFFFF;" d="M329.763,271.186h-69.424c-5.991,0-10.847-4.856-10.847-10.847c0-5.991,4.856-10.847,10.847-10.847
	                                                    h69.424c5.991,0,10.847,4.856,10.847,10.847C340.61,266.33,335.754,271.186,329.763,271.186z" />
                                                    <path style="fill:#E4EAF8;" d="M283.056,271.186h46.707c5.991,0,10.847-4.856,10.847-10.847c0-5.991-4.856-10.847-10.847-10.847
	                                                    H296.85C291.563,256.222,286.951,263.482,283.056,271.186z" />
                                                    <circle style="fill:#FFFFFF;" cx="399.186" cy="329.763" r="104.136" />
                                                    <path style="fill:#235BFD;" d="M399.186,216.949c-22.46,0-43.988,6.621-62.341,18.832l1.596-5.002
                                                        c1.449-4.568-1.067-9.449-5.635-10.907c-4.551-1.449-9.449,1.076-10.907,5.635l-10.661,33.424c-0.882,2.788-0.314,5.831,1.534,8.102
                                                        c1.652,2.043,4.136,3.212,6.737,3.212c0.289,0,0.585-0.017,0.873-0.042l34.907-3.534c4.771-0.483,8.246-4.737,7.762-9.509
                                                        c-0.484-4.772-4.635-8.169-9.509-7.762l-6.909,0.701c15.485-10.245,33.63-15.794,52.553-15.794
                                                        c52.635,0,95.458,42.823,95.458,95.458s-42.823,95.458-95.458,95.458c-4.797,0-8.678,3.881-8.678,8.678
                                                        c0,4.797,3.881,8.678,8.678,8.678c62.204,0,112.814-50.61,112.814-112.814S461.39,216.949,399.186,216.949z" />
                                                    <g>
                                                        <path style="fill:#FFF082;" d="M362.373,435.881c-1.025,0-2.059-0.178-3.068-0.56c-5.635-2.136-11.161-4.754-16.407-7.78
                                                            c-4.152-2.39-5.584-7.695-3.187-11.848c2.381-4.152,7.695-5.593,11.848-3.187c4.45,2.559,9.118,4.779,13.881,6.577
                                                            c4.483,1.695,6.746,6.704,5.051,11.187C369.178,433.745,365.873,435.881,362.373,435.881z" />
                                                        <path style="fill:#FFF082;" d="M321.339,407.602c-2.39,0-4.771-0.983-6.491-2.916c-4.034-4.543-7.711-9.416-10.923-14.475
                                                            c-2.568-4.05-1.365-9.416,2.678-11.983c4.059-2.568,9.416-1.373,11.983,2.678c2.712,4.279,5.822,8.398,9.245,12.254
                                                            c3.178,3.585,2.856,9.067-0.729,12.254C325.449,406.882,323.39,407.602,321.339,407.602z" />
                                                        <path style="fill:#FFF082;" d="M298.094,363.55c-3.89,0-7.433-2.636-8.415-6.584c-1.458-5.864-2.441-11.899-2.932-17.923
                                                            c-0.382-4.779,3.178-8.966,7.949-9.356c4.746-0.34,8.967,3.178,9.356,7.949c0.407,5.102,1.245,10.194,2.474,15.144
                                                            c1.153,4.652-1.678,9.356-6.331,10.517C299.492,363.466,298.788,363.55,298.094,363.55z" />
                                                        <path style="fill:#FFF082;" d="M298.009,313.729c-0.687,0-1.373-0.076-2.068-0.246c-4.652-1.136-7.509-5.839-6.373-10.492
                                                            c1.432-5.855,3.356-11.652,5.712-17.229c1.865-4.407,6.958-6.475,11.372-4.61c4.415,1.865,6.475,6.958,4.61,11.372
                                                            c-2,4.721-3.619,9.627-4.83,14.584C305.467,311.076,301.915,313.729,298.009,313.729z" />
                                                    </g>
                                                    <path style="fill:#235BFD;" d="M407.864,323.098v-27.294c10.893,1.804,17.356,6.63,17.356,9.552c0,4.797,3.881,8.678,8.678,8.678
                                                        c4.797,0,8.678-3.881,8.678-8.678c0-13.863-14.423-24.711-34.712-27.137v-0.524c0-4.797-3.881-8.678-8.678-8.678
                                                        c-4.797,0-8.678,3.881-8.678,8.678v0.524c-20.289,2.426-34.712,13.273-34.712,27.137c0,19.313,18.977,26.672,34.712,31.071v27.294
                                                        c-10.893-1.804-17.356-6.63-17.356-9.552c0-4.797-3.881-8.678-8.678-8.678s-8.678,3.881-8.678,8.678
                                                        c0,13.863,14.423,24.711,34.712,27.137v0.524c0,4.797,3.881,8.678,8.678,8.678c4.797,0,8.678-3.881,8.678-8.678v-0.524
                                                        c20.289-2.425,34.712-13.273,34.712-27.137C442.576,334.857,423.6,327.498,407.864,323.098z M373.153,305.356
                                                        c0-2.922,6.463-7.749,17.356-9.552v22.413C377.998,314.171,373.153,310.465,373.153,305.356z M407.864,363.722v-22.413
                                                        c12.51,4.045,17.356,7.752,17.356,12.861C425.22,357.092,418.757,361.918,407.864,363.722z" />
                                                </svg>
                                                <div class="ms-1 mt-0">
                                                    <b class="mt-0 text-info card-text">Saldo</b>
                                                    <h6 class="card-title text-info pt-1 mt-0" style="font-size: 15px;" id="saldo-deposit"></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1 pb-1">
                            <div class="col-md-12 grid-margin mb-0 pb-0">
                                <div class="row">
                                    <div class="col-xl-8 col-sm-12 mb-4 mb-xl-0">
                                        <h4 class="font-weight-bold">Data Deposit
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row pr-0 mr-0">
                                <div class="col-12 pr-0 mr-0">
                                    <div class="table-responsive">
                                        <table id="data-deposit" class="display expandable-table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No. Transaksi</th>
                                                    <th>Tanggal</th>
                                                    <th>Nama || No Rumah</th>
                                                    <th>Keterangan</th>
                                                    <th>Foto Bukti</th>
                                                    <th>Nominal</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="6" class="bg-primary text-right text-light" style="font-weight: bold;">Total Nominal: &nbsp;
                                                    </th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                            <tbody></tbody>
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

    <!-- Modal Deposit -->
    <div class="modal fade" id="deposit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header pb-2 pt-2">
                    <h5 class="modal-title" id="exampleModalLabel">Deposit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-3 pl-2 pr-2 pb-1">
                    <div class="popover-static-demo">
                        <div class="col-lg-12 col-xxl-10 col-md-10 col-sm-12 pl-2 pr-2 pb-4">
                            <div class="justify-content-center d-flex">
                                <div class="input-group input-group-sm filter">
                                    <span class="input-group-text text-body bg-gradient-info">
                                        <i class="fa fa-search" style="color:white;" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" id="search-tagihan" name="search" placeholder=" Masukan Blok Atau Nama">
                                </div>
                            </div>
                        </div>
                    </div>

                    <form id="input-deposit" enctype="multipart/form-data" method="post" style="display:none;">
                        <div class="input-group pb-0">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 p-0">
                                <div class="input-wrapper">
                                    <input type="text" id="no-depo" name="no_depo" class="col-lg-12" required>
                                    <label class="label-in">No transaksi</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 p-0">
                                <div class="input-wrapper">
                                    <input type="text" id="nama-warga" class="col-lg-12">
                                    <input type="text" id="id_warga" name="id_warga" class="col-lg-12 mb-3" hidden>
                                    <label class="label-in">Nama</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mt-1 mb-2 p-0">
                                <div class="input-wrapper">
                                    <input type="date" id="tanggal" name="tanggal" class="col-lg-12" required>
                                    <label class="label-in">Tanggal</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mt-2 mb-2 p-0">
                                <div class="input-wrapper">
                                    <input type="number" id="nominal" name="nominal" class="col-lg-12" required>
                                    <label class="label-in">Nominal</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12 mt-2 mb-2 p-0">
                                <div class="input-wrapper">
                                    <textarea id="keterangan" name="keterangan" class="col-lg-12" required></textarea>
                                    <label class="label-in">Keterangan</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mt-0 mb-0 p-0">
                                <div class="card-body m-1 p-1 file-upload-container">
                                    <div class="file-upload-wrapper">
                                        <input type="file" id="file-upload" name="file_upload" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mt-0 mb-0 p-0">
                                <div class="image-preview-container">
                                    <img id="image-preview" src="" alt="Image Preview" style="display:none;">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer pr-0">
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info" id="btn-penerimaan">
                                <span id="btn-text-penerimaan">Simpan</span>
                                <span id="loading-icon-penerimaan" class="loading" style="display:none;">
                                    <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" />
                                        <rect x="11" y="6" rx="1" width="2" height="7">
                                            <animateTransform attributeName="transform" type="rotate" dur="9s" values="0 12 12;360 12 12" repeatCount="indefinite" />
                                        </rect>
                                        <rect x="11" y="11" rx="1" width="2" height="9">
                                            <animateTransform attributeName="transform" type="rotate" dur="0.75s" values="0 12 12;360 12 12" repeatCount="indefinite" />
                                        </rect>
                                    </svg> Loading...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- akhir Modal Deposit -->
    <!-- <script src="<?= base_url('assets'); ?>/vendors/jquery-file-upload/jquery.uploadfile.min.js"></script>
    <script src="<?= base_url('assets'); ?>/js/jquery-file-upload.js"></script> -->
    <script>
        // kode preview
        document.getElementById('file-upload').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const imagePreview = document.getElementById('image-preview');
                    imagePreview.src = event.target.result;
                    imagePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                document.getElementById('image-preview').style.display = 'none';
            }
        });


        $(document).ready(function() {
            $('#deposit').on('shown.bs.modal', function() {
                $.ajax({
                    url: '<?php echo base_url('Keuangan/no_deposit') ?>',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#no-depo').val(response.nomer);
                    }
                });
            });

            $('#search-tagihan').on('input', function() {
                var search = $(this).val();
                if (search.length > 0) {
                    $.ajax({
                        url: '<?php echo base_url('Keuangan/get_warga') ?>',
                        method: 'POST',
                        data: {
                            search: search
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.length > 0) {
                                $('#nama-warga').val(data[0].nama);
                                $('#id_warga').val(data[0].id_warga);
                                $('#input-deposit').show();
                            } else {
                                $('#nama-warga').val('');
                                $('#id_warga').val('');
                                $('#input-deposit').hide();
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                } else {
                    $('#nama-warga').val('');
                    $('#id_warga').val('');
                    $('#input-deposit').hide();
                }
            });

        });

        function SaldoDeposit() {
            $.ajax({
                url: '<?php echo base_url('Keuangan/saldo_deposit') ?>',
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    $('#saldo-deposit').text(data.saldo_deposit);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching saldo:', error);
                }
            });
        }

        $(document).ready(function() {
            SaldoDeposit();
        });

        $(document).ready(function() {
            $('#fil-daterange').daterangepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                clearBtn: true,
                todayHighlight: true
            });

            $('#fil-daterange').val('');

            var table;

            table = $('#data-deposit').DataTable({
                "paging": true,
                "autoWidth": true,
                "search": true,
                "responsive": true,
                "processing": false,
                "serverSide": true,
                "ajax": {
                    "url": "<?= site_url('Keuangan/get_data_deposit') ?>",
                    "type": "POST",
                    "data": function(d) {
                        d.fil_bulan_ = $('#fil-bulan_').val();
                        d.fil_tahun_ = $('#fil-tahun_').val();
                        d.fil_daterange_ = $('#fil-daterange_').val();
                    }
                },
                "lengthMenu": [
                    [25, 50, 75, 100, -1],
                    [25, 50, 75, 100, "All"]
                ],

                "pageLength": -1,
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api(),
                        data;

                    var totalNominal = api.column(6, {
                            page: 'current'
                        }).data()
                        .reduce(function(a, b) {
                            return a + parseFloat(b.replace(/[^\d.-]/g, ''));
                        }, 0);

                    var totalNominalObj = api.ajax.json().totalNominal;

                    $(api.column(6, {
                        page: 'current'
                    }).footer()).html(totalNominalObj);
                }

            })

            $('#fil-bulan_, #fil-tahun_, #fil-daterange_').on('change', function() {
                // debugging apakah nilai select muncul
                // console.log('Nilai select: ' + $(this).val());
                table.draw();
            });


            // buat transaksi deposit
            $('#input-deposit').submit(function(event) {
                event.preventDefault();

                $('#btn-text-penerimaan').hide();
                $('#loading-icon-penerimaan').show();
                $('#btn-penerimaan').attr('disabled', true);

                var formData = new FormData($('#input-deposit')[0]);

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('Keuangan/input_deposit'); ?>',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                position: "top-center",
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Deposit Berhasil.',
                                timer: 1400
                            });

                            var table = $('#data-deposit').DataTable();
                            table.ajax.reload(null, false);
                            $('#deposit').modal('hide');
                            $('#input-deposit')[0].reset();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat validasi data di server.',
                            });
                        }

                        $('#btn-text-penerimaan').show();
                        $('#loading-icon-penerimaan').hide();
                        $('#btn-penerimaan').attr('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat mengirim data ke server.',
                        });
                        $('#btn-text-penerimaan').show();
                        $('#loading-icon-penerimaan').hide();
                        $('#btn-penerimaan').attr('disabled', false);
                    }
                });
            });

        });

        $('#deposit').on('hidden.bs.modal', function(e) {
            $('#input-deposit')[0].reset();
            $('#input-deposit').hide();
            $('#search-tagihan').val('');
            $('#btn-penerimaan').show();
            $('#btn-penerimaan').attr('disabled', false);
            $('#btn-text-penerimaan').show();
            $('#loading-icon-penerimaan').hide();

            const imagePreview = document.getElementById('image-preview');
            imagePreview.src = '';
            imagePreview.style.display = 'none';

        });
    </script>