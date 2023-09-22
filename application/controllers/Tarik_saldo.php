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
        $id_perum = $this->input->get('id_perum');
        $data['menunggu']       = $this->M_dashboard->jumlah_byr($id);
        $data['userdata']       = $this->userdata;
        $data['nomer']          = $this->M_saldo->no_tf();
        $data['perum']          = $this->M_perumahan->get_perumahan();

        // code saldo
        $saldo = $this->M_saldo->get_saldo($id_perum);

        $totalDPP = calculate_saldo($saldo);
        $Rp_saldo = 'Rp. ' . number_format($totalDPP, 0, ',', '.');
        $data['totalDPP'] = $Rp_saldo;
        // akhir code saldo

        $data['content'] = 'page/tariks_v';
        $this->load->view($this->template, $data);
    }

    public function form_tarik()
    {
       $id = $this->session->userdata('userdata')->id_rtrw;
       $id_perum = $this->input->get('id_perumahan');
       $perum = $this->uri->segment(3);

       $data['menunggu']       = $this->M_dashboard->jumlah_byr($id);
       $data['userdata']       = $this->userdata;
       $data['nomer']          = $this->M_saldo->no_tf();
       $data['perum']          = $this->M_perumahan->get_perumahan();

       // code saldo
       $saldo = $this->M_saldo->get_saldo($perum);
       $totalDPP = calculate_saldo($saldo);
       $Rp_saldo = 'Rp. ' . number_format($totalDPP, 0, ',', '.');
       $data['totalDPP'] = $Rp_saldo;
       $data['DPP'] = $totalDPP;
       // akhir code saldo

       $data['content'] = 'page/tariks_saldo_v';
       $this->load->view($this->template, $data);
   }

   function get_data_tf()
   {

    $id_perum = $this->uri->segment(3);

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

    public function buat_tarik() {
        $status        = '2';
        $id_perum      = $this->input->post('id_perum');

        $data = array(
            'id_perum'  => $this->input->post('id_perum'),
            'code_tranfer '  => $this->input->post('no_tarik'),
            'tanggal'   => $this->input->post('tanggal'),
            'fee'       => $this->input->post('fee'),
            'dpp'       => $this->input->post('nominal'),
            'saldo'    => $this->input->post('totdpp'),
        );

        $result = $this->M_saldo->save_data($data);
        $result = $this->M_saldo->update_saldo($status, $id_perum);

        if ($result) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
        }

        echo json_encode($response);
    }

}