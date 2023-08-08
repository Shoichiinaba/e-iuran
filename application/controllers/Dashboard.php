<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends AUTH_Controller
{
    var $template = 'templates/index';
    public $userdata;
    public $M_client;
    public $session;
    public $input;
    public $upload;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_client');
    }

    public function index()
    {
        $role = $this->session->userdata('userdata')->role;
        if ($role == 'Warga') {
            // LOAD PAGE DASHBOARD WARGA
            $id_warga = $this->session->userdata('userdata')->id_warga;
            // $data['group_by_bln']          = $this->M_client->m_group_by_bln($id_warga);
            $data['tagihan_air']          = $this->M_client->m_tagihan_air($id_warga);
            $data['biodata']          = $this->M_client->m_biodata($id_warga);
            $data['userdata']         = $this->userdata;
            $data['content']        = 'warga/dashboard';
            $this->load->view($this->template, $data);
        } else {
            // LOAD PAGE DASHBOARD ADMIN, RT
            $data['userdata']         = $this->userdata;
            $data['content']        = 'page/dashboard_v';
            $this->load->view($this->template, $data);
        }
    }
    // function Warga
    function upload_bukti()
    {
        $id_warga = $this->session->userdata('userdata')->id_warga;
        $id_rtrw = $this->session->userdata('userdata')->id_rtrw;
        $tgl_upload = $this->input->post('tgl-upload');
        // $foto_bukti = $this->input->post('foto-bukti');
        $code_tagihan = 'CT-' . $id_rtrw . $id_warga . date("dmy");
        // $arr_id = $this->input->post('id-tagihan');
        // $arr_id = $this->input->post('tagihan');
        $id_tagihan = $this->input->post('id-tagihan');
        $config['upload_path'] = "./upload/";
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->M_client->m_update_tagihan($code_tagihan, $id_tagihan);
        // echo $id_tagihan;

        // if ($this->upload->do_upload("foto-bukti")) {
        //     $data = array('upload_data' => $this->upload->data());
        //     $foto_bukti = $data['upload_data']['file_name'];
        //     $uploadedImage = $this->upload->data();
        //     // echo $header_foto;
        //     $data = [
        //         'id_rtrw' => $id_rtrw,
        //         'id_warga' => $id_warga,
        //         'tgl_upload' => $tgl_upload,
        //         'code_tagihan' => $code_tagihan,
        //         'foto_bukti' => $foto_bukti,
        //         'jumlah' => preg_replace('/[Rp. ]/', '', $tagihan),
        //     ];
        //     $this->M_client->m_upload_bukti($data);
        // }
        // exit;
    }
    function get_data_riwayat()
    {
        $table_anda = '<div class="table-responsive">
                            <table class=" expandable-table dataTable table" style="width: 100%;display: table;overflow: auto;" aria-describedby="data-perum_info">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center pb-4">Bulan</th>
                                        <th colspan="2" class="text-center">Angka Pada Meter</th>
                                        <th rowspan="2" class="text-center pb-4">Pemaikaian</th>
                                        <th rowspan="2" class="text-center pb-4">Tarif</th>
                                        <th rowspan="2" class="text-center pb-4">Abunemen</th>
                                        <th rowspan="2" class="text-center pb-4">Priode</th>
                                        <th rowspan="2" class="text-center pb-4">Jumlah</th>
                                        <th rowspan="2" class="text-center pb-4">Iuran</th>
                                        <th rowspan="2" class="text-center pb-4">Total bayar</th>
                                        <th rowspan="2" class="text-center pb-4">Status</th>
                                        <th rowspan="2" class="text-center pb-4">Aksi</th>
                                    </tr>
                                    <tr>
                                        <center>
                                            <th class="text-center">Awal</th>
                                            <th class="text-center">Akhir</th>
                                        </center>
                                    </tr>
                                </thead>';

        $table_warga = '<div class="table-responsive">
                        <table class=" expandable-table dataTable table" style="width: 100%;display: table;overflow: auto;" aria-describedby="data-perum_info">
                            <thead>
                                <tr>

                                    <th class="text-center">No. Rumah</th>
                                    <th class="text-center">Pemilik</th>
                                    <th class="text-center">Tunggakan</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>';
        $table_end = '</table>
                </div>';
        $action = $this->input->post('action');
        if ($action == 'anda') {
            echo $table_anda;
            echo '<tbody>';
            $id_warga = $this->session->userdata('userdata')->id_warga;
            $data['riwayat_anda']          = $this->M_client->m_riwayat_anda($id_warga);
            foreach ($data['riwayat_anda'] as $riwayat) {
                echo '<tr>';
                echo '<td>' . $riwayat->bln_tagihan . ' / ' . $riwayat->thn_tagihan . '</td>';
                echo '<td>' . $riwayat->kubik1 . '</td>';
                echo '<td>' . $riwayat->kubik_in . '</td>';
                echo '<td>' . $riwayat->hasil_kubik . '</td>';
                echo '<td>Rp' . number_format($riwayat->perkubik, 0, ',', '.') . '</td>';
                echo '<td>Rp' . number_format($riwayat->abunament, 0, ',', '.') . '</td>';
                echo '<td>1 Bulan</td>';
                echo '<td>Rp' . number_format($riwayat->nominal, 0, ',', '.') . '</td>';
                echo '<td>Rp' . number_format($riwayat->lain_lain, 0, ',', '.') . '</td>';
                echo '<td>Rp' . number_format($riwayat->lain_lain += $riwayat->nominal, 0, ',', '.') . '</td>';
                if ($riwayat->status == '0') {
                    echo '<td class="font-weight-medium"><div class="badge badge-warning">Belum Bayar</div></td>';
                    echo '<td><button type="button" class="btn btn-primary btn-bayar btn-sm" data-bs-toggle="modal" data-bs-target="#modal-bayar">Bayar</button></td>';
                } elseif ($riwayat->status == '1') {
                    echo '<td class="font-weight-medium"><div class="badge badge-info">Menunggu konfirmasi</div></td>';
                } elseif ($riwayat->status == '2') {
                    echo '<td class="font-weight-medium"><div class="badge badge-success">Lunas</div></td>';
                    echo '<td><button type="button" class="btn btn-primary btn-bayar btn-sm" data-bs-toggle="modal" data-bs-target="#modal-bayar">Print</button></td>';
                }
                echo '</tr>';
            }
            echo '</tbody>';
            echo $table_end;
        } elseif ($action == 'warga') {
            echo $table_warga;
            echo '<tbody>';
            $id_warga = $this->session->userdata('userdata')->id_warga;
            $data['riwayat_warga']          = $this->M_client->m_riwayat_warga($id_warga);
            foreach ($data['riwayat_warga'] as $riwayat) {
                echo '<tr id="tr-' . $riwayat->id_warga . '" class="">';
                echo '<td>' . $riwayat->no_rumah . '</td>';
                echo '<td class="text-center">' . $riwayat->nama . '</td>';
                $id = $riwayat->id_warga;
                $data['unpaid']          = $this->M_client->m_unpaid($id);
                foreach ($data['unpaid'] as $row) {
                    echo '<td class="text-center">' . $row->total . ' Bulan</td>';
                    if ($row->total <= '0') {
                        echo '<td class="font-weight-medium text-center"><div class="badge badge-success">Lunas</div></td>';
                    } else {
                        echo '<td class="font-weight-medium text-center"><div class="badge badge-warning">Belum Bayar</div></td>';
                        echo '<script>';
                        echo '$("#tr-' . $row->id_warga . '").addClass("Belumbayar", true)';
                        echo '</script>';
                    }
                }
                echo '</tr>';
            }
            echo '</tbody>';

            echo $table_end;
        }
    }
    // END function Warga
}