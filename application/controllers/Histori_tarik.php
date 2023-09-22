<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Histori_tarik extends AUTH_Controller
{
    var $template = 'templates/index';

	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_saldo');
        $this->load->model('M_dashboard');
        $this->load->model('M_perumahan');
        $this->load->helper('saldo_helper');
    }

     public function index()
     {
        $id = $this->session->userdata('userdata')->id_rtrw;
        $id_perum = $this->session->userdata('userdata')->id_perum;
        $data['menunggu']       = $this->M_dashboard->jumlah_byr($id);
        $data['userdata']       = $this->userdata;
        $data['perum']          = $this->M_perumahan->get_perumahan();

        // code saldo
        $saldo = $this->M_saldo->get_saldo($id_perum);

        $totalDPP = calculate_saldo($saldo);
        $Rp_saldo = 'Rp. ' . number_format($totalDPP, 0, ',', '.');
        $data['totalDPP'] = $Rp_saldo;
        // akhir code saldo

        $data['content'] = 'page/hiatory_saldo_v';
        $this->load->view($this->template, $data);
    }

    function get_data_history() {

        $id = $this->session->userdata('userdata')->id_rtrw;
        $id_perum = $this->session->userdata('userdata')->id_perum;
        $list = $this->M_saldo->get_datatablest($id_perum);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $tf)
        {

            $Rp_dpp     = 'Rp. ' . number_format($tf->dpp, 0, ',', '.');
            $Rp_akhir     = 'Rp. ' . number_format($tf->saldo, 0, ',', '.');

            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $tf->code_tranfer;
            $row[] = $tf->nama;
            $row[] = $tf->tanggal;
            $row[] = $Rp_dpp;
            $row[] = $tf->fee. ' %';
            $row[] = $Rp_akhir;
            $row[] = '<a href="'.site_url('Cetak_invoice/bikti_tf/'.$tf->id_saldo).'" class="btn btn-info" target="_blank"><i class="ti ti-printer"></i> Cetak</a>';

            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->M_saldo->count_all_tf($id_perum),
                    "recordsFiltered" => $this->M_saldo->count_filtereds($id_perum),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

}