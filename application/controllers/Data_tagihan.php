<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_tagihan extends AUTH_Controller
{
    var $template = 'templates/index';

	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_transaksi');

    }

    public function index()
    {
        $id = $this->session->userdata('userdata')->id_rtrw;
        $data['userdata']       = $this->userdata;
        $data['iuran']          = $this->M_transaksi->get_iuran($id);
        $data['kubik']          = $this->M_transaksi->get_meter();

        // di looping karena untuk memasukan element badge kedalam select
        $warga_data = array();
        foreach ($this->M_transaksi->get_warga($id) as $warga) {
            $warga_data[] = array(
                'id' => $warga->id_warga,
                'text' => $warga->nama,
                'badge' => $warga->no_rumah
            );
        }
        $data['warga'] = $warga_data;

        $data['content'] = 'page/tagihan_v';
        $this->load->view($this->template, $data);
    }


}