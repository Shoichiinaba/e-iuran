<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_iuran extends AUTH_Controller
{
    var $template = 'templates/index';

	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_iuran');
        $this->load->model('M_dashboard');

    }

	public function index()
	{
        $role = $this->session->userdata('userdata')->role;
        $id_rtrw = $this->session->userdata('userdata')->id_rtrw;
        $data['userdata'] 		= $this->userdata;
        $data['iuran']          = $this->M_iuran->get_iuran($id_rtrw, $role);
        $data['menunggu']       = $this->M_dashboard->jumlah_byr($id_rtrw);
        $data['nama']          = $this->M_iuran->get_nama_iuran();
        $data['content']        = 'page/iuran_v';
        $this->load->view($this->template, $data);
    }

    public function simpan_iuran()
    {
        $id_iuran = $this->input->post('id_iuran');
        $id_rtrw = $this->input->post('id_rtrw');
        $nominal = $this->input->post('nominal');

        $data = array();
        foreach ($id_iuran as $key => $id_iuran) {
            if (!empty($id_iuran)) {
                $data[] = array(
                    'id_iuran' => $id_iuran,
                    'id_rtrw' => $id_rtrw[$key],
                    'nominal' => $nominal[$key],
                );
            }
        }


        if (!empty($data)) {
            $inserted_rows = $this->M_iuran->insert_iuran($data);
            if ($inserted_rows > 0) {
                $this->session->set_flashdata('sukses', 'Data berhasil disimpan.');
            } else {
                $this->session->set_flashdata('gagal', 'Data Gagal disimpan.');
            }
        }

        redirect('Data_iuran');
    }

    function edit_iuran()
	{
		if($this->input->post()==FALSE){
			$this->session->set_flashdata('error',"Data Gagal Di Edit");
			redirect('Data_iuran');
		}else{
			$id 			    = $this->input->post('id');
            $id_iuran           = $this->input->post('id_iuran');
            $nominal            = $this->input->post('nominal');
            $nominal1            = $this->input->post('nominal1');
            $perawatan          = $this->input->post('perawatan');
            $abunament          = $this->input->post('abunament');

        $troop_ = array(
         'id' 		                        =>  $id,
         'id_iuran'          		        =>  $id_iuran,
         'nominal'          		        =>  $nominal,
         'nominal1'          		        =>  $nominal1,
         'perawatan'          		        =>  $perawatan,
         'abunament'          		        =>  $abunament,

      );
        $this->M_iuran->edit_iuran($id, $troop_);
        $this->session->set_flashdata('sukses', "Berhasil Di Edit");
        redirect('Data_iuran');

	    }
	}

    function hapus_iuran($params = '')
    {
        $this->M_iuran->hapus_iuran($params);
        $this->session->set_flashdata('sukses', 'Data berhasil dihapus.');
        return redirect('Data_iuran');
    }

    public function nama_iuran()
	{
        $data['userdata'] 		= $this->userdata;
        $data['nama_iuran']     = $this->M_iuran->get_nama();
        $data['content']        = 'page/nama_v';
        $this->load->view($this->template, $data);
    }

    public function simpan_nama()
    {
        $nama = $this->input->post('nama');

        $data = array();

        if (!empty($nama)) {
            foreach ($nama as $key => $item) {
                $data[] = array(
                    'nama' => $item,
                );
            }

            if (!empty($data)) {
                $inserted_rows = $this->M_iuran->insert_nama($data);
                if ($inserted_rows > 0) {
                    $this->session->set_flashdata('sukses', 'Data berhasil disimpan.');
                } else {
                    $this->session->set_flashdata('gagal', 'Data Gagal disimpan.');
                }
            } else {
                $this->session->set_flashdata('gagal', 'Tidak ada data yang disimpan.');
            }
        } else {
            $this->session->set_flashdata('gagal', 'Data kosong.');
        }

        redirect('Data_iuran/nama_iuran');
    }

    function edit_nama()
	{
		if($this->input->post()==FALSE){
			$this->session->set_flashdata('error',"Data Gagal Di Edit");
			redirect('Data_iuran');
		}else{
            $id_iuran        = $this->input->post('id_iuran');
            $nama            = $this->input->post('nama');

        $troop_ = array(
         'id_iuran'         =>  $id_iuran,
         'nama'          	=>  $nama,

      );
        $this->M_iuran->edit_nama($id_iuran, $troop_);
        $this->session->set_flashdata('sukses', "Berhasil Di Edit");
        redirect('Data_iuran/nama_iuran');

	    }
	}

    function hapus_nama_iuran($params = '')
    {
        $this->M_iuran->hapus_nama($params);
        $this->session->set_flashdata('sukses', 'Data berhasil dihapus.');
        return redirect('Data_iuran/nama_iuran');
    }

}