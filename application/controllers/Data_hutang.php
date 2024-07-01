<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
use Xendit\Invoice;

class Data_hutang extends AUTH_Controller
{
    var $template = 'templates/index';

	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_hutang');

    }

    public function index()
    {
        $data['userdata']       = $this->userdata;
        $data['content']        = 'page/data_hutang';
        $this->load->view($this->template, $data);
    }

    function get_datahutang() {

        $list = $this->M_hutang->get_datatablest();
        $data = array();
        $no = @$_POST['start'];
        $totalNominal = 0;
        $saldo= 0;


        foreach ($list as $trx) {
            $debit = is_numeric($trx->debit) ? $trx->debit : 0;
            $credit = is_numeric($trx->credit) ? $trx->credit : 0;
            $tanggal = date('d-m-Y', strtotime($trx->tanggal));

            $debit_RP = 'Rp. ' . number_format($debit, 0, ',', '.');
            $credit_RP = 'Rp. ' . number_format($credit, 0, ',', '.');

            $saldo += $credit - $debit;

            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $trx->no_transaksi;
            $row[] = $tanggal;
            $row[] = $trx->keterangan;
            $row[] = $credit_RP;
            $row[] = $debit_RP;
            $row[] = 'Rp. ' . number_format($saldo, 0, ',', '.');

            $data[] = $row;
        }

        $totalNominalFormatted = 'Rp. ' . number_format($saldo, 0, ',', '.');

        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->M_hutang->count_all_trx(),
                    "recordsFiltered" => $this->M_hutang->count_filtereds(),
                    "data" => $data,
                    "totalNominal" => $totalNominalFormatted
                );

        echo json_encode($output);
    }

}