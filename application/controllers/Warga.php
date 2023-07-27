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

    }

	public function index()
	{
        $id = $this->session->userdata('userdata')->id_perum;
        $data['userdata'] 		= $this->userdata;
        $data['perum']          = $this->M_perumahan->get_perum();
        $data['rtrw']          = $this->M_perumahan->get_rtrw();
        $data['warga']          = $this->M_warga->get_warga();
        $data['content']        = 'page/warga_v';
        $this->load->view($this->template, $data);
    }

    public function get_warga()
    {
        $columns = array(
            'id_warga',
            'nama',
            'perum',
            'no_rumah',
            'no_hp',
            'keterangan',
            'rt',
            'rw',
            ''
        );

        $id = $this->session->userdata('userdata')->id_rtrw;
        $role = $this->session->userdata('userdata')->role;
        $limit = $this->input->post('length');
        $offset = $this->input->post('start');
        $order = $this->input->post('order');
        $order_column = isset($order[0]['column']) ? $columns[$order[0]['column']] : '';
        $order_dir = isset($order[0]['dir']) ? $order[0]['dir'] : '';

        $total_records = $this->M_warga->get_total_warga($id, $role);
        $filtered_records = $this->M_warga->get_filtered_warga($limit, $offset, $order_column, $order_dir, $id, $role);


        $data = array();
        $starting_number = isset($_POST['start']) ? $_POST['start'] : 0; // Mengambil nomor urut awal berdasarkan halaman saat ini
        $nomor_urut = $starting_number + 1;
        foreach ($filtered_records as $wargas) {
            $data[] = array(
                'nomor_urut' => $nomor_urut,
                'id_warga' =>$wargas->id_warga,
                'perum' =>'<td class="font-weight-medium"><div class="badge badge-primary">'.$wargas->perum.'</div></td>',
                'nama' => $wargas->nama,
                'no_rumah' =>'<td class="font-weight-medium"><div class="badge badge-info">'.$wargas->no_rumah.'</div></td>',
                'no_hp' => $wargas->no_hp,
                'rt' => $wargas->rt,
                'rw' => $wargas->rw,
                'keterangan' => $wargas->keterangan,
                'aksi' => '<button type="button" class="btn btn-inverse-danger btn-icon btn-sm" onclick="hapusData(' . $wargas->id_warga . ')">
                                <i class="ti-trash"></i>
                            </button>
                            <button type="button" data-toggle="modal" data-target="#modal-edit' . $wargas->id_warga . '" class="btn btn-inverse-success btn-icon btn-sm" data-placement="top" title="Edit">
                                <i class="ti-pencil-alt"></i>
                            </button>'
            );
            $nomor_urut++;
        }

        $response = array(
            'draw' => $this->input->post('draw'),
            'recordsTotal' => $total_records,
            'recordsFiltered' => $total_records,
            'data' => $data
        );

        echo json_encode($response);
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

        $data = array();
        foreach ($id_perum as $key => $id_perum) {
            if (!empty($id_perum)) {
                $data[] = array(
                    'id_perum' => $id_perum,
                    'id_rtrw' => $id_rtrw[$key],
                    'nama' => $nama[$key],
                    'no_rumah' => $no_rumah[$key],
                    'no_hp' => $no_hp[$key],
                    'keterangan' => $keterangan[$key],
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