<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

    public function no_penerimaan()
    {
        $nomer_penerimaan = $this->M_keuangan->no_penerimaan();
        echo json_encode(array('nomer' => $nomer_penerimaan));
    }

    public function no_pembayaran()
    {
        $nomer_pembayaran = $this->M_keuangan->no_pembayaran();
        echo json_encode(array('nomer' => $nomer_pembayaran));
    }

    public function saldo_cash()
    {
        $saldo                   = $this->M_keuangan->get_cash();
        $saldo_cash              = cash_saldo($saldo);
        $Rp_saldo_cash           = 'Rp. ' . number_format($saldo_cash, 0, ',', '.');

        $data['saldo_cash'] = $Rp_saldo_cash;
        echo json_encode($data);
    }

    public function saldo_hutang()
    {
        $hutang                  = $this->M_keuangan->saldo_hutang();
        $Rp_hutang               = 'Rp. ' . number_format($hutang, 0, ',', '.');

        $data['saldo_hutang'] = $Rp_hutang;
        echo json_encode($data);
    }

    function saldo_bln_lalu()
    {
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

    function get_data_keuangan()
    {
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

    public function buat_penerimaan()
    {
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

    public function buat_pembayaran()
    {
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


    // controller untuk Fiture deposit
    public function deposit()
    {
        $id_rtrw                 = $this->session->userdata('userdata')->id_rtrw;
        $id_warga                = $this->input->get('id');
        $data['userdata']        = $this->userdata;
        $data['menunggu']        = $this->M_dashboard->jumlah_byr($id_rtrw);
        // $data['tahun']           = $this->M_keuangan->get_tahun();
        $data['content']         = 'page/deposit';
        $this->load->view($this->template, $data);
    }

    public function no_deposit()
    {
        $nomer_deposit = $this->M_keuangan->no_deposit();
        echo json_encode(array('nomer' => $nomer_deposit));
    }

    public function input_deposit()
    {
        $config['upload_path'] = './upload/foto_bukti/';
        $config['allowed_types'] = 'jpg|png|jpeg|';
        $config['max_size'] = 2048;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file_upload')) {
            $response = array('status' => 'error', 'message' => $this->upload->display_errors());
            echo json_encode($response);
            return;
        } else {
            $upload_data = $this->upload->data();
            $file_path = $upload_data['file_name'];
        }

        $data = array(
            'no_transaksi' => $this->input->post('no_depo'),
            'tanggal' => $this->input->post('tanggal'),
            'nominal' => $this->input->post('nominal'),
            'keterangan' => $this->input->post('keterangan'),
            'file_path' => $file_path
        );

        $this->load->model('M_keuangan');
        $result = $this->M_keuangan->save_deposit($data);

        if ($result) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
        }

        echo json_encode($response);
    }

    function get_data_deposit()
    {
        $filter_bulan = $this->input->post('fil_bulan');
        $filter_tahun = $this->input->post('fil_tahun');
        $filter_daterange = $this->input->post('fil_daterange');

        $list = $this->M_keuangan->get_datatables_depo($filter_bulan, $filter_tahun, $filter_daterange);
        $data = array();
        $no = @$_POST['start'];
        $total_nominal = 0;

        foreach ($list as $dep) {
            $tanggal = date('d-m-Y', strtotime($dep->tanggal));

            $total_nominal += $dep->nominal;

            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $dep->no_transaksi;
            $row[] = $tanggal;
            $row[] = $dep->nama_warga . ' &nbsp; ' . '<td class="font-weight-medium"><div class="badge badge-info">' . $dep->no_rumah . '</div></td>';
            $row[] = $dep->ket_deposit;
            $row[] = '<a href="' . base_url('upload/foto_bukti/') . $dep->foto_bukti . '" data-src="' . base_url('upload/foto_bukti/') . $dep->foto_bukti . '">
                         <img src="' . base_url('upload/foto_bukti/') . $dep->foto_bukti . '" alt="Foto Bukti" class="border border-primary m-0 p-0 img-lg rounded">
                      </a>';
            $row[] = 'Rp. ' . number_format($dep->nominal, 0, ',', '.');

            $data[] = $row;
        }

        $totalNominalFormatted = 'Rp. ' . number_format($total_nominal, 0, ',', '.');

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_keuangan->count_all_depo(),
            "recordsFiltered" => $this->M_keuangan->count_filtered_depo($filter_bulan, $filter_tahun, $filter_daterange),
            "data" => $data,
            "totalNominal" => $totalNominalFormatted
        );

        echo json_encode($output);
    }

    public function saldo_deposit()
    {
        $saldo                   = $this->M_keuangan->get_depo();
        $saldo_depo              = depo_saldo($saldo);
        $Rp_saldo_deposit        = 'Rp. ' . number_format($saldo_depo, 0, ',', '.');

        $data['saldo_deposit'] = $Rp_saldo_deposit;
        echo json_encode($data);
    }

    // akhir controller untuk Fiture deposit

}
