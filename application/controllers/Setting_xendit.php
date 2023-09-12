<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_xendit extends AUTH_Controller
{
    var $template = 'templates/index';

	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_setting');
        $this->load->model('M_dashboard');

    }

	public function index()
	{
        $id_rtrw = $this->session->userdata('userdata')->id_rtrw;
        $data['userdata'] 		= $this->userdata;
        $data['menunggu']       = $this->M_dashboard->jumlah_byr($id_rtrw);
        $data['setting']          = $this->M_setting->get_key();
        $data['content']        = 'page/setting_v';
        $this->load->view($this->template, $data);
    }

    public function simpan_api()
    {
        $name = $this->input->post('name');
        $value = $this->input->post('value');

        $data = array();
        foreach ($name as $key => $name) {
            if (!empty($name)) {
                $data[] = array(
                    'name' => $name,
                    'value' => $value[$key],
                );
            }
        }

        if (!empty($data)) {
            $inserted_rows = $this->M_setting->add_key($data);
            if ($inserted_rows > 0) {
                $this->session->set_flashdata('sukses', 'Data berhasil disimpan.');
            } else {
                $this->session->set_flashdata('gagal', 'Data Gagal disimpan.');
            }
        }

        redirect('Setting_xendit');
    }

    function edit_api()
	{
		if($this->input->post()==FALSE){
			$this->session->set_flashdata('error',"Data Gagal Di Edit");
			redirect('Setting_xendit');
		}else{
			$id 			= $this->input->post('id');
			$name           = $this->input->post('name');
            $value          = $this->input->post('value');

        $troop_ = array(
         'id' 		    =>  $id,
         'name'         =>  $name,
         'value'        =>  $value,

      );
        $this->M_setting->update_key($id, $troop_);
        $this->session->set_flashdata('sukses', "Berhasil Di Edit");
        redirect('Setting_xendit');

	    }
	}

    function hapus($params = '')
    {
        $this->M_setting->hapus_api($params);
        $this->session->set_flashdata('sukses', 'Data berhasil dihapus.');
        return redirect('Setting_xendit');
    }

}