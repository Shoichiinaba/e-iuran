<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
use Xendit\Invoice;

class Data_tagihan_adm extends AUTH_Controller
{
    var $template = 'templates/index';

	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_dashboard');
        $this->load->model('M_tagihan_adm');

    }

    public function index()
    {
        $data['userdata']       = $this->userdata;
        $id_rtrw = $this->session->userdata('userdata')->id_rtrw;

        $data['menunggu']       = $this->M_dashboard->jumlah_byr($id_rtrw);
        $data['filter_perum']   = $this->M_tagihan_adm->get_filter_perum();
        $data['content']        = 'page/tagihan_adm';
        $this->load->view($this->template, $data);
    }


    function get_tagihan() {
        $id = $this->session->userdata('userdata')->id_rtrw;
        $filter_perum = $this->input->post('filter_perum');
        $filter_periode = $this->input->post('filter_periode');

        $list = $this->M_tagihan_adm->get_datatablest($filter_perum, $filter_periode);
        $data = array();
        $no = @$_POST['start'];
        $totalNominal = 0;


        foreach ($list as $trx) {

            $status = ($trx->status == 0) ? '<td class="font-weight-medium"><div class="badge badge-danger">Belum Bayar</div></td>' : ($trx->status == 2 ? '<td class="font-weight-medium"><div class="badge badge-success">Lunas</div></td>' : '<td class="font-weight-medium"><div class="badge badge-info">Status Lain</div></td>');
            $periode_tagihan = $this->M_tagihan_adm->count_tagihan_by_warga($trx->id_warga);
            $nominal_tagihan = $this->M_tagihan_adm->count_tagihan_nominal($trx->id_warga);
            $Rp_total = 'Rp. ' . number_format($nominal_tagihan, 0, ',', '.');

            $tagihan_by_bulan = $this->M_tagihan_adm->count_tagihan_bulan($trx->id_warga);
            $bulan_array = array_keys($tagihan_by_bulan);
            $bulan = implode(", ", $bulan_array);

            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = '<td class="font-weight-medium"><div class="badge badge-success">' . $trx->nama_perum . '</div></td>';
            $row[] = $trx->nama_warga . ' &nbsp; ' . '<td class="font-weight-medium"><div class="badge badge-info">' . $trx->no_rumah . '</div></td>';
            $row[] = $periode_tagihan . " Bulan";
            $row[] = $bulan;
            $row[] = $Rp_total;
            $row[] = $status;

            $data[] = $row;

            $totalNominal += $nominal_tagihan;
        }

        $totalNominalFormatted = 'Rp. ' . number_format($totalNominal, 0, ',', '.');

        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->M_tagihan_adm->count_all_trx($filter_perum, $filter_periode),
                    "recordsFiltered" => $this->M_tagihan_adm->count_filtereds($filter_perum, $filter_periode),
                    "data" => $data,
                    "totalNominal" => $totalNominalFormatted
                );

        echo json_encode($output);
    }


}