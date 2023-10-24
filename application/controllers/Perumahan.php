<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perumahan extends AUTH_Controller
{
    var $template = 'templates/index';

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('M_perumahan');

    }

	public function index()
	{
        $data['userdata'] 		= $this->userdata;
        $data['perum']          = $this->M_perumahan->get_perumahan();
        $data['content']        = 'page/perumahan_v';
        $this->load->view($this->template, $data);
    }

    function hapus($params = '')
    {
        $this->M_perumahan->hapus_perum($params);
        $this->session->set_flashdata('sukses', 'Data berhasil dihapus.');
        return redirect('Perumahan');
    }

    public function simpan_data()
    {
        $data_perumahan = $this->input->post('nama');
        $code = $this->input->post('code');
        $data = array();
        foreach ($data_perumahan as $key =>  $nama) {
            if (!empty($nama)) {
                $data[] = array(
                    'nama' => $nama,
                    'code' => $code[$key],
                );
            }
        }

        if (!empty($data)) {
            $inserted_rows = $this->M_perumahan->insert_perumahan($data);
            if ($inserted_rows > 0) {
                $this->session->set_flashdata('sukses', 'Data berhasil disimpan.');
            } else {
                $this->session->set_flashdata('gagal', 'Data Gagal disimpan.');
            }
        }

        redirect('perumahan');
    }

    function edit_perum()
	{
		if($this->input->post()==FALSE){
			$this->session->set_flashdata('error',"Data Gagal Di Edit");
			redirect('Perumahan');
		}else{
			$id_perumahan 			= $this->input->post('id_perumahan');
			$nama                   = $this->input->post('nama');
            $code                   = $this->input->post('code');

        $troop_ = array(
         'id_perumahan' 		    =>  $id_perumahan,
         'nama'          			=>  $nama,
         'code'          			=>  $code,

      );
        $this->M_perumahan->edit($id_perumahan, $troop_);
        $this->session->set_flashdata('sukses', "Berhasil Di Edit");
        redirect('Perumahan');

	    }

	}

    // controller fanction untuk menampilkan halaman RT/RW
    public function rtrw()
	{
        $data['userdata'] 		= $this->userdata;
        $data['perum']          = $this->M_perumahan->get_perum();
        $data['rtrw']           = $this->M_perumahan->get_rtrw();
        $data['content']        = 'page/rt-rw_v';
        $this->load->view($this->template, $data);
    }

    public function simpan_rtrw()
    {
        $id_perum = $this->input->post('id_perum');
        $rw = $this->input->post('rw');
        $rt = $this->input->post('rt');

        $data = array();
        foreach ($id_perum as $key => $id_perum) {
            if (!empty($id_perum)) {
                $data[] = array(
                    'id_perum' => $id_perum,
                    'rw' => $rw[$key],
                    'rt' => $rt[$key],
                );
            }
        }


        if (!empty($data)) {
            $inserted_rows = $this->M_perumahan->insert_rtrw($data);
            if ($inserted_rows > 0) {
                $this->session->set_flashdata('sukses', 'Data berhasil disimpan.');
            } else {
                $this->session->set_flashdata('gagal', 'Data Gagal disimpan.');
            }
        }

        redirect('perumahan/rtrw');
    }

    function edit_rtrw()
	{
		if($this->input->post()==FALSE){
			$this->session->set_flashdata('error',"Data Gagal Di Edit");
			redirect('Perumahan/rtrw');
		}else{
			$id_rtrw 			    = $this->input->post('id_rtrw');
			$id_perum               = $this->input->post('id_perum');
            $rw                     = $this->input->post('rw');
            $rt                     = $this->input->post('rt');

        $troop_ = array(
         'id_rtrw' 		            =>  $id_rtrw,
         'id_perum'          		=>  $id_perum,
         'rw'          		        =>  $rw,
         'rt'          		        =>  $rt,

      );
        $this->M_perumahan->edit_rtrw($id_rtrw, $troop_);
        $this->session->set_flashdata('sukses', "Berhasil Di Edit");
        redirect('Perumahan/rtrw');

	    }
	}

    function hapus_rtrw($params = '')
    {
        $this->M_perumahan->hapus_rtrw($params);
        $this->session->set_flashdata('sukses', 'Data berhasil dihapus.');
        return redirect('Perumahan/rtrw');
    }


}