<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Carbon\Carbon;
use Xendit\Invoice;

class Data_tagihan extends AUTH_Controller
{
    var $template = 'templates/index';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_transaksi');
        $this->load->model('M_dashboard');
    }

    // xendit
    function show_saldo()
    {
        xendit_loaded();
        $getBalance = \Xendit\Balance::getBalance('CASH');
        var_dump($getBalance);
    }

    public function index()
    {
        $id_rtrw = $this->session->userdata('userdata')->id_rtrw;
        $id_warga = $this->input->get('id');
        $data['userdata']       = $this->userdata;
        $data['menunggu']       = $this->M_dashboard->jumlah_byr($id_rtrw);
        $data['iuran']          = $this->M_transaksi->get_iuran($id_rtrw);
        $data['ifas']           = $this->M_transaksi->iuran_fas($id_rtrw);
        $data['tax']            = $this->M_transaksi->taxs_adm();
        $data['filter']         = $this->M_transaksi->get_filter();
        $data['filter_perum']   = $this->M_transaksi->get_filter_perum();

        // di looping karena untuk memasukan element badge kedalam select
        $warga_data = array();
        foreach ($this->M_transaksi->get_warga($id_rtrw) as $warga) {
            $warga_data[] = array(
                'id' => $warga->id_warga,
                'text' => $warga->nama,
                'badge' => $warga->no_rumah,
                'no_rumah' => $warga->no_rumah,
                'kapling_gabungan' => $warga->kapling_gabungan
            );
        }

        $data['warga'] = $warga_data;
        $data['content'] = 'page/tagihan_v';
        $this->load->view($this->template, $data);
    }

    public function no_invoice()
    {
        $nomer_invoice = $this->M_transaksi->no_invoice();
        echo json_encode(array('nomer' => $nomer_invoice));
    }


    public function get_meter()
    {
        $id_warga = $this->input->get('id_warga');
        $kubikData = $this->M_transaksi->get_meter($id_warga);

        $data_kubik_in = array();

        foreach ($kubikData as $data) {
            $data_array = (array) $data;
            $data_kubik_in[] = $data_array['kubik_in'];
        }
        header('Content-Type: application/json');
        echo json_encode($data_kubik_in);
    }

    public function buat_tagihan()
    {
        $id_warga = $this->input->post('id_warga');
        $bln_tagihan = $this->input->post('bln_tagihan');
        $thn_tagihan = $this->input->post('thn_tagihan');

        // Cek apakah data sudah ada
        $is_exist = $this->M_transaksi->check_existing_data($id_warga, $bln_tagihan, $thn_tagihan);
        if ($is_exist) {
            $response = array('status' => 'exist', 'message' => 'Data sudah Di Buat Tagihan Bulan ini.');
        } else {
            $data = array(
                'id_rtrw' => $this->input->post('id_rtrw'),
                'id_warga' => $id_warga,
                'id_iuran' => $this->input->post('id_iuran'),
                'no_invoice' => $this->input->post('no_invoice'),
                'thn_tagihan' => $thn_tagihan,
                'bln_tagihan' => $bln_tagihan,
                'kubik1' => $this->input->post('kubik1'),
                'kubik_in' => $this->input->post('kubik_in'),
                'hasil_kubik' => $this->input->post('hasil_kubik'),
                'abunament' => $this->input->post('abunament'),
                'perkubik' => $this->input->post('perkubik'),
                'lain_lain' => $this->input->post('lain_lain'),
                'taxs' => $this->input->post('taxs'),
                'nominal' => $this->input->post('nominal')
            );

            $this->load->model('M_transaksi');
            $result = $this->M_transaksi->save_data($data);

            if ($result) {
                $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
            } else {
                $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
            }
        }

        echo json_encode($response);
    }


    function hapus_iuran($params = '')
    {
        $this->M_iuran->hapus_iuran($params);
        $this->session->set_flashdata('sukses', 'Data berhasil dihapus.');
        return redirect('Data_iuran');
    }

    // untuk mengirim data semua transaksi
    function get_trx()
    {
        $id = $this->session->userdata('userdata')->id_rtrw;
        $role = $this->session->userdata('userdata')->role;
        $bulan_filter = $this->input->post('bln_filter');
        $status_filter = $this->input->post('status_filter');
        $tahun_filter = $this->input->post('thn_filter');
        $filter_perum = $this->input->post('nama_perum');

        $list = $this->M_transaksi->get_datatables($id, $role, $bulan_filter, $status_filter, $tahun_filter, $filter_perum);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $tagih) {
            $status = ($tagih->status == 0) ? '<td class="font-weight-medium"><div class="badge badge-danger">Belum Bayar</div></td>' : ($tagih->status == 2 ? '<td class="font-weight-medium"><div class="badge badge-success">Lunas</div></td>' : '<td class="font-weight-medium"><div class="badge badge-info">Status Lain</div></td>');
            $total = $tagih->nominal + $tagih->lain_lain;

            $formatted_nominal = 'Rp. ' . number_format($tagih->nominal, 0, ',', '.');
            $formatted_lain = 'Rp. ' . number_format($tagih->lain_lain, 0, ',', '.');
            $Rp_total = 'Rp. ' . number_format($total, 0, ',', '.');

            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $tagih->no_invoice;

            if ($role == 'Admin') {
                $row[] = '<td class="font-weight-medium"><div class="badge badge-primary">' . $tagih->nama_perum . '</div></td>';
            }

            $row[] = $tagih->nama_warga . ' &nbsp; ' . '<td class="font-weight-medium"><div class="badge badge-info">' . $tagih->no_rumah . '</div></td>';
            $row[] = $tagih->bln_tagihan;
            $row[] = $tagih->thn_tagihan;
            $row[] = $formatted_nominal;
            $row[] = $formatted_lain;
            $row[] = $Rp_total;
            $row[] = $status;

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_transaksi->count_all(),
            "recordsFiltered" => $this->M_transaksi->count_filtered($id, $role, $bulan_filter, $status_filter, $tahun_filter, $filter_perum),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    // data transaksi pembayaran
    public function data_transaksi()
    {
        $id_rtrw = $this->session->userdata('userdata')->id_rtrw;
        $role = $this->session->userdata('userdata')->role;
        $data['userdata']           = $this->userdata;
        $data['menunggu']           = $this->M_dashboard->jumlah_byr($id_rtrw);
        $data['filter']             = $this->M_transaksi->get_filter();
        $data['bank']               = $this->M_transaksi->get_bank($id_rtrw, $role);
        $data['filter_perum']       = $this->M_transaksi->get_filter_perum();
        $data['content']            = 'page/transaksi_byr';
        $this->load->view($this->template, $data);
    }

    function get_datapay()
    {
        $id = $this->session->userdata('userdata')->id_rtrw;
        $role = $this->session->userdata('userdata')->role;
        $status_trans = $this->input->post('status');
        $jenis_trans = $this->input->post('jenis_pem');
        $perum_filter = $this->input->post('perum_filter');
        $status_saldo = $this->input->post('saldoStat_filter');


        $list = $this->M_transaksi->get_datatablest($id, $role, $status_trans, $jenis_trans, $perum_filter, $status_saldo);
        $data = array();
        $no = @$_POST['start'];
        $total_nominal = 0;

        foreach ($list as $trx) {

            $status = ($trx->status == 1)
                ? '<td class="font-weight-medium"><div class="badge badge-warning"><a href="' . $trx->url_payment . '" target="_blank">Menunggu Pembayaran</a></div></td>'
                : ($trx->status == 2
                    ? '<td class="font-weight-medium"><div class="badge badge-success text-white"><a href="' . $trx->url_payment . '" target="_blank" class="text-white">Lunas</a></div></td>'
                    : '<td class="font-weight-medium"><div class="badge badge-info">Status Lain</div></td>');

            $total = $trx->jumlah;
            $Rp_total = 'Rp. ' . number_format($total, 0, ',', '.');
            $total_nominal += $trx->jumlah;

            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $trx->no_invoice;
            $row[] = $trx->code_tagihan;

            if ($role == 'Admin') {
                $row[] = '<td class="font-weight-medium"><div class="badge badge-primary">' . $trx->nama_perum . '</div></td>';
            }

            $row[] = $trx->nama_warga . ' &nbsp; ' . '<td class="font-weight-medium"><div class="badge badge-info">' . $trx->no_rumah . '</div></td>';
            $row[] = $trx->foto_bukti;
            $row[] = $trx->tgl_upload;
            $row[] = $trx->tgl_byr;
            $row[] = $trx->periode . " Bulan";
            $row[] = $status;
            $row[] = $Rp_total;

            $data[] = $row;
        }

        $totalNominalFormatted = 'Rp. ' . number_format($total_nominal, 0, ',', '.');

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_transaksi->count_all_trx(),
            "recordsFiltered" => $this->M_transaksi->count_filtereds($id, $role, $status_trans, $jenis_trans, $perum_filter, $status_saldo),
            "data" => $data,
            "totalNominal" => $totalNominalFormatted
        );

        echo json_encode($output);
    }
    // akhir data transaksi pembayaran

}
