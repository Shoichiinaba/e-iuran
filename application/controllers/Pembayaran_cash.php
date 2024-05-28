<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
use Xendit\Invoice;

class Pembayaran_cash extends AUTH_Controller
{
    var $template = 'templates/index';

	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_dashboard');
        $this->load->model('M_cash');

    }

    public function index()
    {
        $id_rtrw                = $this->session->userdata('userdata')->id_rtrw;
        $id_warga               = $this->input->get('id');
        $data['userdata']       = $this->userdata;
        $data['menunggu']       = $this->M_dashboard->jumlah_byr($id_rtrw);
        $data['content']        = 'page/cash';
        $this->load->view($this->template, $data);
    }

    public function fetch()
    {
        $output = '';

        $limit  = $this->input->post('limit');
        $start  = $this->input->post('start');
        $search = $this->input->post('search');

        $data = $this->M_cash->get_data_tagihan($limit, $start,$search);

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $tagihan) {

                $periode_tagihan = $this->M_cash->jlm_tagihan($tagihan->id_warga);
                $nominal_tagihan = $this->M_cash->jml_tagihan_nominal($tagihan->id_warga);
                $Rp_total = 'Rp. ' . number_format($nominal_tagihan, 0, ',', '.');

                $output .= '<div class="mb-0 pb-0 mt-0 pt-0 pl-3 font-weight-bold text-success">
                                <small>' . $tagihan->nama_perum . '</small>
                            </div>
                            <div class="card-body pt-1 pb-2">
                                <div class="d-flex align-items-center pb-2 border-bottom">
                                    <h4 class="font-weight-bold text-info mb-0">' . $tagihan->no_rumah . '</h4>
                                    <div class="ms-3">
                                            <h6 class="mb-1 text-primary">' . $tagihan->nama . '</h6>
                                            <small class="text-dark mb-0"><i class="fa fa-calendar me-1"></i>' . $periode_tagihan . ' Bulan</small>
                                            <p class="text-dark font-weight-bold mb-0"><i class="fa fa-money me-1"></i>' . $Rp_total . '</p>
                                    </div>
                                    <a class="fa fa-hand-o-up font-weight-bold ms-auto px-1 py-1 text-info mdi-24px mr-0 pr-0 pilih-tombol" data-id-warga="' . $tagihan->id_warga . '"> Pilih</a>
                                </div>
                            </div>';
            }
            echo $output;
        }
    }
}