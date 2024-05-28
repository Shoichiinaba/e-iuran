<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarik_saldo extends AUTH_Controller
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
        $data['menunggu']       = $this->M_dashboard->jumlah_byr($id);
        $data['userdata']       = $this->userdata;
        $data['nomer']          = $this->M_saldo->no_tf();
        $data['perum']          = $this->M_perumahan->get_perumahan();

        // code saldo
        $perum = $this->M_perumahan->get_perumahan();
            $data['perum_balances'] = array();

            foreach ($perum as $perum_data) {
                $id_perumahan = $perum_data->id_perumahan;

                $saldo_data = $this->M_saldo->get_saldo($id_perumahan);
                $saldo_seg = $this->M_saldo->get_saldo_segel($id_perumahan);

                $totalDPP = 0;
                foreach ($saldo_data as $s) {
                    $tax = $s->periode * $s->taxs;
                    $DPP = $s->jumlah - $tax;
                    $totalDPP += $DPP;
                }

                $saldo_segel = 0;
                foreach ($saldo_seg as $s) {
                    $saldo_segel += $s->nominal;
                }

                $data['perum_balances'][$id_perumahan] = 'Rp. ' . number_format($totalDPP, 0, ',', '.');
                $data['segel_balances'][$id_perumahan] = 'Rp. ' . number_format($saldo_segel, 0, ',', '.');
            }
        // akhir code saldo

        $data['content'] = 'page/tariks_v';
        $this->load->view($this->template, $data);
    }

   public function form_tarik()
    {
        $id = $this->session->userdata('userdata')->id_rtrw;

        $id_rtrw = $this->input->post('id_rtrw');
        $perum = $this->uri->segment(3);

        $data['menunggu'] = $this->M_dashboard->jumlah_byr($id);
        $data['userdata'] = $this->userdata;
        $data['nomer'] = $this->M_saldo->no_tf();
        $data['perum'] = $this->M_perumahan->get_perumahan();
        $data['rtrw'] = $this->M_perumahan->get_rttarik($perum);

        // saldo Xendit
        xendit_loaded();
        $getBalance = \Xendit\Balance::getBalance('CASH');
        $balance = $getBalance['balance'];
        $Rp_saldo_xendit = 'Rp. ' . number_format($balance, 0, ',', '.');
        $data['xendit'] = $Rp_saldo_xendit;
        // akhir saldo Xendit

        $data['content'] = 'page/tariks_saldo_v';
        $this->load->view($this->template, $data);
    }

    public function form_tarik_ajax()
    {
        $id_rtrw = $this->input->post('id_rtrw');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        $perum = $this->uri->segment(3);

        $saldo = $this->M_saldo->get_filter_saldo($perum, $id_rtrw, $startDate, $endDate);
        $saldo_segel = $this->M_saldo->get_filter_saldo_seg($perum, $id_rtrw, $startDate, $endDate);
        // saldo transaksi IPL & Air
        $totalDPP = calculate_saldo($saldo);
        $Rp_saldo = 'Rp. ' . number_format($totalDPP, 0, ',', '.');
        // saldo transaksi penyegelan meteran
        $total_saldo_segel = calculate_saldo_segel($saldo_segel);
        $Rp_saldo_segel = 'Rp. ' . number_format($total_saldo_segel, 0, ',', '.');

        $data['totalDPP'] = $Rp_saldo;
        $data['saldo_segel'] = $Rp_saldo_segel;
        $data['DPP'] = $totalDPP;
        $data['segel'] =  $total_saldo_segel;
        echo json_encode($data);
    }



   function get_data_tf()
   {

    $id_perum = $this->uri->segment(3);
    $list = $this->M_saldo->get_datatables($id_perum);
    $data = array();
    $no = @$_POST['start'];
    foreach ($list as $tf)
    {

        $Rp_dpp     = 'Rp. ' . number_format($tf->dpp, 0, ',', '.');
        $Rp_akhir     = 'Rp. ' . number_format($tf->saldo, 0, ',', '.');
        $Rp_segel     = 'Rp. ' . number_format($tf->segel, 0, ',', '.');
        $tanggal_formatted = date('d/m/Y', strtotime($tf->tanggal));

        $no++;
        $row = array();
        $row[] = $no.".";
        $row[] = $tf->code_tranfer;
        $row[] = '<td class="font-weight-medium"><div class="badge bg-gradient-info">' . $tf->nama . '</div> </td>';
        $row[] = '<td class="font-weight-medium"><div class="badge badge-danger">' . $tf->rt . ' &nbsp; ' . '<td class="font-weight-medium"><div class="badge bg-gradient-primary">' . $tf->rw . '</div></td>';
        $row[] = $tanggal_formatted;
        $row[] = $Rp_segel;
        $row[] = $Rp_dpp;
        $row[] = $tf->fee. ' %';
        $row[] = $Rp_akhir;

        $data[] = $row;
    }
    $output = array(
                "draw" => @$_POST['draw'],
                "recordsTotal" => $this->M_saldo->count_all_tf($id_perum),
                "recordsFiltered" => $this->M_saldo->count_filtered($id_perum),
                "data" => $data,
            );
    // output to json format
    echo json_encode($output);

    }

    public function buat_tarik() {
        $status        = '2';
        $id_perum      = $this->input->post('id_perum');
        $id_rtrw       = $this->input->post('id_rtrw');

        $data = array(
            'id_perum'       => $this->input->post('id_perum'),
            'id_rtrw'        => $this->input->post('id_rtrw'),
            'code_tranfer '  => $this->input->post('no_tarik'),
            'tanggal'        => $this->input->post('tanggal'),
            'segel'          => $this->input->post('segel'),
            'fee'            => $this->input->post('fee'),
            'dpp'            => $this->input->post('nominal'),
            'saldo'          => $this->input->post('totdpp'),
        );

        $result = $this->M_saldo->save_data($data);
        $result = $this->M_saldo->update_saldo($status, $id_perum, $id_rtrw);

        if ($result) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
        }

        echo json_encode($response);
    }

}