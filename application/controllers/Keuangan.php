<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
use Xendit\Invoice;

class Keuangan extends AUTH_Controller
{
    var $template = 'templates/index';

	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_keuangan');
        $this->load->model('M_dashboard');
        $this->load->helper('saldo_helper');

    }

    public function index()
    {
        // hitung salgo
        $hutang                  = $this->M_keuangan->saldo_hutang();
        $Rp_hutang               = 'Rp. ' . number_format($hutang, 0, ',', '.');
        $saldo                   = $this->M_keuangan->get_cash();
        $saldo_cash              = calculate_saldo($saldo);
        $Rp_saldo_cash = 'Rp. ' . number_format( $saldo_cash, 0, ',', '.');


        $id_rtrw                 = $this->session->userdata('userdata')->id_rtrw;
        $id_warga                = $this->input->get('id');
        $data['userdata']        = $this->userdata;
        $data['menunggu']        = $this->M_dashboard->jumlah_byr($id_rtrw);
        $data['no_rec']          = $this->M_keuangan->no_penerimaan();
        $data['no_pay']          = $this->M_keuangan->no_pembayaran();
        $data['hutang']          = $Rp_hutang;
        $data['saldo_cash']      = $Rp_saldo_cash;
        $data['content']         = 'page/keuangan';
        $this->load->view($this->template, $data);
    }

    function get_data_keuangan() {

        $list = $this->M_keuangan->get_datatablest();
        $data = array();
        $no = @$_POST['start'];
        $saldo = 0;
        $totalNominal = 0;
        $saldo_awal = 0;

        foreach ($list as $trx) {

            $debit = $trx->debit;
            $credit = $trx->credit;
            $tanggal = date('d-m-Y', strtotime($trx->tanggal));

            $debit_RP = 'Rp. ' . number_format($debit , 0, ',', '.');
            $credit_RP = 'Rp. ' . number_format($credit , 0, ',', '.');

            $saldo += $credit - $debit;

            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $trx->no_transaksi;
            $row[] = $tanggal;
            $row[] = $trx->type_transaksi;
            $row[] = $trx->keterangan;
            $row[] = $credit_RP;
            $row[] = $debit_RP;
            $row[] = 'Rp. ' . number_format($saldo, 0, ',', '.');

            $data[] = $row;

        }

        $totalNominalFormatted = 'Rp. ' . number_format($saldo, 0, ',', '.');

        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->M_keuangan->count_all_trx(),
                    "recordsFiltered" => $this->M_keuangan->count_filtereds(),
                    "data" => $data,
                    "totalNominal" => $totalNominalFormatted
                );

        echo json_encode($output);
    }

    public function buat_penerimaan() {
        $data = array(
            'no_transaksi' => $this->input->post('no_penerimaan'),
            'tanggal' => $this->input->post('tanggal'),
            'id_saldo_awal' => 1,
            'type_transaksi' => 'Penerimaan',
            'jenis_pemasukan' => $this->input->post('jenis_pemasukan'),
            'credit' => $this->input->post('nominal'),
            'keterangan' => $this->input->post('ket_penerimaan'),
        );

        $this->load->model('M_keuangan');
        $result = $this->M_keuangan->save_data($data);

        if ($result) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
        }

        echo json_encode($response);
    }

    public function buat_pembayaran() {
        $data = array(
            'no_transaksi' => $this->input->post('no_pembayaran'),
            'tanggal' => $this->input->post('tgl_pembayaran'),
            'id_saldo_awal' => 1,
            'type_transaksi' => 'Pembayaran',
            'debit' => $this->input->post('nominal_pembayaran'),
            'keterangan' => $this->input->post('ket_pembayaran'),
        );

        $this->load->model('M_keuangan');
        $result = $this->M_keuangan->save_data($data);

        if ($result) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
        }

        echo json_encode($response);
    }



}