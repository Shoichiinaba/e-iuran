<?php
class Lap_segel extends AUTH_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_cetak_segel');
    }

    // function index()
    // {
    //     $this->load->library('pdfgenerator');

    //     $id = $this->session->userdata('userdata')->id_rtrw;
    //     $filter_segel = $this->input->get('status_segel');
    //     $filteredData = $this->M_cetak_segel->get_filtered_data($id, $filter_segel);
    //     $periode_tagihan = $this->M_cetak_segel->count_tagihan_by_warga($trx->id_warga, $id);

    //     $data['title'] = "Laporan Data Meteran Di Segel";
    //     $data['filteredData'] = $filteredData;
    //     $data['periode'] = $periode_tagihan;

    //     $file_pdf = 'laporan_Data_Meteran_Disegel';
    //     $paper = 'A4';
    //     $orientation = "potrait";
    //     $html = $this->load->view('page/laporan/laporan_segel', $data, true);
    //     $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    // }

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


}
?>