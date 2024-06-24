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
        $id_rtrw                 = $this->session->userdata('userdata')->id_rtrw;
        $id_warga                = $this->input->get('id');
        $data['userdata']        = $this->userdata;
        $data['menunggu']        = $this->M_dashboard->jumlah_byr($id_rtrw);
        $data['tahun']           = $this->M_keuangan->get_tahun();
        $data['content']         = 'page/keuangan';
        $this->load->view($this->template, $data);
    }

    public function no_penerimaan() {
        $nomer_penerimaan = $this->M_keuangan->no_penerimaan();
        echo json_encode(array('nomer' => $nomer_penerimaan));
    }

    public function no_pembayaran() {
        $nomer_pembayaran = $this->M_keuangan->no_pembayaran();
        echo json_encode(array('nomer' => $nomer_pembayaran));
    }

    public function saldo_cash() {
        $saldo                   = $this->M_keuangan->get_cash();
        $saldo_cash              = cash_saldo($saldo);
        $Rp_saldo_cash           = 'Rp. ' . number_format( $saldo_cash, 0, ',', '.');

        $data['saldo_cash'] = $Rp_saldo_cash;
        echo json_encode($data);
    }

    public function saldo_hutang() {
        $hutang                  = $this->M_keuangan->saldo_hutang();
        $Rp_hutang               = 'Rp. ' . number_format( $hutang, 0, ',', '.');

        $data['saldo_hutang'] = $Rp_hutang;
        echo json_encode($data);
    }

    function saldo_bln_lalu() {
        $filter_bulan = $this->input->post('fil_bulan');
        $filter_tahun = $this->input->post('fil_tahun');

        $saldo_awal = 0;

        if (!empty($filter_bulan) && !empty($filter_tahun)) {
            $saldo_awal = $this->M_keuangan->get_saldo_lalu($filter_bulan, $filter_tahun);
            $saldo_awal = is_numeric($saldo_awal) ? $saldo_awal : 0;
        } else {
            $saldo_awal = 0;
        }

        $saldo = $this->M_keuangan->get_saldo_lalu($filter_bulan, $filter_tahun);
        $Rp_saldo = 'Rp. ' . number_format($saldo, 0, ',', '.');

        $data['totalDPP'] = $Rp_saldo;
        echo json_encode($data);
    }

    function get_data_keuangan() {
        $filter_bulan = $this->input->post('fil_bulan');
        $filter_tahun = $this->input->post('fil_tahun');
        $filter_daterange = $this->input->post('fil_daterange');

        $saldo_awal = 0;

        if (!empty($filter_bulan) && !empty($filter_tahun)) {
            $saldo_awal = $this->M_keuangan->get_saldo_lalu($filter_bulan, $filter_tahun);
            $saldo_awal = is_numeric($saldo_awal) ? $saldo_awal : 0;
        } else {
            $saldo_awal = 0;
        }

        $list = $this->M_keuangan->get_datatablest($filter_bulan, $filter_tahun, $filter_daterange);
        $data = array();
        $no = @$_POST['start'];
        $saldo = $saldo_awal;

        $data[] = array(
            "",
            "",
            "",
            "",
            "Saldo Awal",
            "",
            "",
            'Rp. ' . number_format($saldo_awal, 0, ',', '.')
        );

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
            "recordsFiltered" => $this->M_keuangan->count_filtereds($filter_bulan, $filter_tahun, $filter_daterange),
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

        $result = $this->M_keuangan->save_data($data);

        if ($result) {
            if ($this->input->post('jenis_pemasukan') == 'Saldo Cash') {
                $update_data = array('status_saldo' => 2);
                $this->db->where('foto_bukti', 'CASH');
                $this->db->where('status_saldo', '1');
                $this->db->update('transaksi', $update_data);
            }

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
            'jenis_pemasukan' => $this->input->post('bayar_hutang'),
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