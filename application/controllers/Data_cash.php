<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
use Xendit\Invoice;

class Data_cash extends AUTH_Controller
{
    var $template = 'templates/index';

	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_cash');

    }

    public function index()
    {
        $data['userdata']       = $this->userdata;
        $data['content']        = 'page/data_cash';
        $this->load->view($this->template, $data);
    }

    function get_datacash() {

        $list = $this->M_cash->get_datatablest();
        $data = array();
        $no = @$_POST['start'];
        $totalNominal = 0;


        foreach ($list as $trx) {

            // $status = ($trx->status == 1) ? '<td class="font-weight-medium"><div class="badge badge-warning">Menunggu Pembayaran </div></td>' : ($trx->status == 2 ? '<td class="font-weight-medium"><div class="badge badge-success">Lunas</div></td>' : '<td class="font-weight-medium"><div class="badge badge-info">Status Lain</div></td>');
            $total = $trx->jumlah;
            $Rp_total = 'Rp. ' . number_format($total, 0, ',', '.');

            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $trx->code_tagihan;
            $row[] = $trx->nama . ' &nbsp; ' . '<td class="font-weight-medium"><div class="badge badge-info">' . $trx->no_rumah . '</div></td>';
            $row[] = $trx->periode . " Bulan";
            // $row[] = $status;
            $row[] = $trx->tgl_upload;
            $row[] = $trx->foto_bukti;
            $row[] = $Rp_total;

            $data[] = $row;
            $totalNominal += $trx->jumlah;
        }

        $totalNominalFormatted = 'Rp. ' . number_format($totalNominal, 0, ',', '.');

        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->M_cash->count_all_trx(),
                    "recordsFiltered" => $this->M_cash->count_filtereds(),
                    "data" => $data,
                    "totalNominal" => $totalNominalFormatted
                );

        echo json_encode($output);
    }

    function count_tagihan_bulan($id_warga, $id) {
        $this->db->select('bln_tagihan, COUNT(*) as total_tagihan');
        $this->db->from('tagihan');
        $this->db->where('id_warga', $id_warga);
        $this->db->where('id_rtrw', $id);
        $this->db->where('status', 0);
        $this->db->group_by('bln_tagihan');
        $this->db->order_by('id_tagihan', 'ASC');
        $query = $this->db->get();

        $tagihan_by_bulan = array();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $tagihan_by_bulan[$row->bln_tagihan] = $row->total_tagihan;
            }
        }

        return $tagihan_by_bulan;
    }

}