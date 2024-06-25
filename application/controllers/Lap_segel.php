<?php
class Lap_segel extends AUTH_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_cetak_segel');
        $this->load->model('M_cetak_keuangan');
    }

    function index()
    {
        $this->load->library('pdfgenerator');

        $id = $this->session->userdata('userdata')->id_rtrw;
        $filter_segel = $this->input->get('status_segel');
        $filteredData = $this->M_cetak_segel->get_filtered_data($id, $filter_segel);

        $periode_tagihan = array();
        foreach ($filteredData as $trx) {
            $periode_tagihan[$trx->id_warga] = $this->M_cetak_segel->count_tagihan_by_warga($trx->id_warga, $id);
        }

        $data['title'] = "Laporan Data Meteran Di Segel";
        $data['filteredData'] = $filteredData;
        $data['periode'] = $periode_tagihan;

        $file_pdf = 'laporan_Data_Meteran_Disegel';
        $paper = 'A4';
        $orientation = "potrait";
        $html = $this->load->view('page/laporan/laporan_segel', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    function lap_keuangan()
    {
        $this->load->library('pdfgenerator');

        $filter_bulan       = $this->input->get('fil_bulan');
        $filter_tahun       = $this->input->get('fil_tahun');
        $filter_daterange   = $this->input->get('fil_daterange');

        $saldo_awal = 0;
        if (!empty($filter_bulan) && !empty($filter_tahun)) {
            $saldo_awal = $this->M_cetak_keuangan->get_saldo_lalu($filter_bulan, $filter_tahun);
        }

        $filteredData       = $this->M_cetak_keuangan->get_filtered_data($filter_bulan, $filter_tahun, $filter_daterange);
        $data_keuangan = array();
        $saldo = $saldo_awal;

        $data_keuangan[] = (object) array(
            'no_transaksi' => '',
            'tanggal' => '',
            'type_transaksi' => '',
            'keterangan' => 'Saldo Awal',
            'credit' => '',
            'debit' => '',
            'saldo' => $saldo_awal
        );

        foreach ($filteredData as $keu) {
            $saldo += $keu->credit - $keu->debit;
            $keu->saldo = $saldo;
            $data_keuangan[] = $keu;
        }

        $data['title'] = "Laporan Keuangan";
        $data['filter_bulan'] = $filter_bulan;
        $data['filter_tahun'] = $filter_tahun;
        $data['data_keuangan'] = $data_keuangan;

        $file_pdf = 'laporan_Keuangan';
        $paper = 'A4';
        $orientation = "potrait";
        $html = $this->load->view('page/laporan/laporan_keuangan', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    function lap_cash()
    {
        $this->load->library('pdfgenerator');
        $this->load->model('M_cetak_cash');
        $filteredData = $this->M_cetak_cash->get_pembayaran_cash();

        $data['title'] = "Laporan Data Pembayaran Cash";
        $data['filteredData'] = $filteredData;
        $file_pdf = 'laporan_Data_Pembayaran_Cash';
        $paper = 'A4';
        $orientation = "Landscape";
        $html = $this->load->view('page/laporan/laporan_cash', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

}
?>