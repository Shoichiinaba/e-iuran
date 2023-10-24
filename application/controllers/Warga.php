<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warga extends AUTH_Controller
{
    var $template = 'templates/index';

	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_warga');
        $this->load->model('M_perumahan');
        $this->load->model('M_dashboard');

    }

	public function index()
	{
        $id = $this->session->userdata('userdata')->id_perum;
        $id_rtrw = $this->session->userdata('userdata')->id_rtrw;
        $data['userdata'] 		= $this->userdata;
        $data['perum']          = $this->M_perumahan->get_perum();
        $data['code']          = $this->M_perumahan->get_code($id);
        $data['menunggu']       = $this->M_dashboard->jumlah_byr($id_rtrw);
        $data['rtrw']          = $this->M_perumahan->get_rtrw();
        $data['warga']          = $this->M_warga->get_warga();
        $data['content']        = 'page/warga_v';
        $this->load->view($this->template, $data);
    }

    function get_warga() {
        $id = $this->session->userdata('userdata')->id_rtrw;
        $role = $this->session->userdata('userdata')->role;

        $list = $this->M_warga->get_datatables($id, $role);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $warga) {

            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = '<td class="font-weight-medium"><div class="badge badge-primary">'.$warga->perum.'</div></td>';
            $row[] = $warga->nama;
            $row[] = '<td class="font-weight-medium"><div class="badge badge-info">' . $warga->no_rumah . '</div></td>';
            $row[] = $warga->no_hp;
            $row[] = $warga->rt;
            $row[] = $warga->rw;
            $row[] = $warga->keterangan;
            $row[] = '<button type="button" class="btn btn-inverse-danger btn-icon btn-sm" onclick="hapusData(' . $warga->id_warga . ')">
                        <i class="ti-trash"></i>
                      </button>
                      <button type="button" data-toggle="modal" data-target="#modal-edit' . $warga->id_warga . '" class="btn btn-inverse-success btn-icon btn-sm" data-placement="top" title="Edit">
                      <i class="ti-pencil-alt"></i>
                      </button>';

            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->M_warga->count_all($id, $role),
                    "recordsFiltered" => $this->M_warga->count_filtered($id, $role),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    public function hapus_data()
    {
        $id = $this->input->post('id');
        $this->M_warga->hapus_warga($id);
        $response = array('status' => 'success', 'message' => 'Data berhasil dihapus.');
        echo json_encode($response);
    }

    public function simpan()
    {
        $id_perum = $this->input->post('id_perum');
        $id_rtrw = $this->input->post('id_rtrw');
        $nama = $this->input->post('nama');
        $no_rumah = $this->input->post('no_rumah');
        $no_hp = $this->input->post('no_hp');
        $keterangan = $this->input->post('keterangan');
        $code = $this->input->post('code');
        $role = 'Warga';
        $foto = 'default.png';

        $data = array();
        foreach ($id_perum as $key => $id_perum) {
            if (!empty($id_perum)) {
                $password = md5('BP123');
                $username = $code[$key] . $no_rumah[$key];
                $data[] = array(
                    'id_perum' => $id_perum,
                    'id_rtrw' => $id_rtrw[$key],
                    'nama' => $nama[$key],
                    'no_rumah' => $no_rumah[$key],
                    'no_hp' => $no_hp[$key],
                    'keterangan' => $keterangan[$key],
                    'username' =>  $username,
                    'password' => $password,
                    'role' => $role,
                    'foto' => $foto,
                );
            }
        }


        if (!empty($data)) {
            $inserted_rows = $this->M_warga->insert_warga($data);
            if ($inserted_rows > 0) {
                $this->session->set_flashdata('sukses', 'Data berhasil disimpan.');
            } else {
                $this->session->set_flashdata('gagal', 'Data Gagal disimpan.');
            }
        }

        redirect('Warga');
    }

    function edit_warga()
    {
        if ($this->input->post() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal Di Edit");
            redirect('Warga');
        } else {
            $id_warga = $this->input->post('id_warga');
            $id_perum = $this->input->post('id_perum');
            $id_rtrw = $this->input->post('id_rtrw');
            $no_rumah = $this->input->post('no_rumah');
            $nama = $this->input->post('nama');
            $no_hp = $this->input->post('no_hp');
            $keterangan = $this->input->post('keterangan');

            $data_warga = array(
                'id_warga'   => $id_warga,
                'id_perum'   => $id_perum,
                'id_rtrw'    => $id_rtrw,
                'no_rumah'   => $no_rumah,
                'nama'       => $nama,
                'no_hp'      => $no_hp,
                'keterangan' => $keterangan,
            );

            $this->M_warga->edit_warga($id_warga, $data_warga);
            $this->session->set_flashdata('sukses', "Berhasil Di Edit");
            redirect('Warga');
        }
    }

}