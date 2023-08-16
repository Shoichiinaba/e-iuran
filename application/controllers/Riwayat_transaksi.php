<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Riwayat_transaksi extends AUTH_Controller
{
    var $template = 'templates/index';
    public $input;
    public $session;
    public $M_riwayat;
    public $userdata;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_riwayat');
    }
    public function index()
    {
        $data['userdata']         = $this->userdata;
        $data['content']        = 'warga/riwayat_transaksi';
        $this->load->view($this->template, $data);
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
            $data['riwayat_anda']          = $this->M_riwayat->m_riwayat_anda($id_warga);
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
                    echo '<td class="font-weight-bold"><i>Belum Bayar</i></td>';
                    echo '<td><button type="button" class="btn btn-primary btn-bayar btn-sm" data-bs-toggle="modal" data-bs-target="#modal-bayar">Bayar</button></td>';
                } elseif ($riwayat->status == '1') {
                    echo '<td class="font-weight-bold"><i>Menunggu konfirmasi</i></td>';
                } elseif ($riwayat->status == '2') {
                    echo '<td class="font-weight-bold">Lunas</td>';
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
            $data['riwayat_warga']          = $this->M_riwayat->m_riwayat_warga($id_warga);
            foreach ($data['riwayat_warga'] as $riwayat) {
                echo '<tr id="tr-' . $riwayat->id_warga . '" class="">';
                echo '<td>' . $riwayat->no_rumah . '</td>';
                echo '<td class="text-center">' . $riwayat->nama . '</td>';
                $id = $riwayat->id_warga;
                $data['unpaid']          = $this->M_riwayat->m_unpaid($id);
                foreach ($data['unpaid'] as $row) {
                    echo '<td class="text-center">' . $row->total . ' Bulan</td>';
                    if ($row->total <= '0') {
                        echo '<td class="text-center"><i>Lunas</i></td>';
                    } else {
                        echo '<td class="text-center"><i>Belum bayar</i></td>';
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
}
