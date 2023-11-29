<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak_invoice extends AUTH_Controller
{
    public $pdfgenerator;
    public $input;
    public $M_cetak_pdf;
    public $uri;
    public $session;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_cetak_pdf');
    }
    public function data()
    {
        $no_invoice = $this->uri->segment(3);
        $id_warga = $this->session->userdata('id_warga');

        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $data['_tittle'] = 'INVOICE #' . $no_invoice;
        // filename dari pdf ketika didownload
        $file_pdf = 'INVOICE #' . $no_invoice;
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "potrait";

        $data['data_invoice'] = $this->M_cetak_pdf->m_data_invoice($no_invoice, $id_warga);
        // $html = $this->load->view('warga/cetak_pdf', $data);

        $html = $this->load->view('warga/cetak_pdf', $data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function bikti_tf()
    {
        $id_saldo = $this->uri->segment(3);
        $id = $this->session->userdata('id_rtrw');
        $id_perum = $this->session->userdata('id_perum');

        $this->load->library('pdfgenerator');

        $data['_tittle'] = 'Bukti Tranfer Saldo Hi-care';
        $file_pdf = 'Bukti_Tarik_saldo';
        $paper = 'A4';
        $orientation = "potrait";

        $data['data_tarik'] = $this->M_cetak_pdf->m_bukti_tarik($id_saldo);
        $html = $this->load->view('page/cetak/bukti_pdf', $data, true);

        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}