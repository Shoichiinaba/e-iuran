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
        $id_warga = $this->input->get('id');
        $data['userdata']       = $this->userdata;
        $data['iuran']          = $this->M_transaksi->get_iuran($id);
        $data['ifas']          = $this->M_transaksi->iuran_fas($id);
        $data['nomer']          = $this->M_transaksi->no_invoice();

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

    public function get_meter() {
        $id_warga = $this->input->get('id_warga');
        // $id_warga = 1 ;
        $kubikData = $this->M_transaksi->get_meter($id_warga);

        $data_kubik_in = array();

        foreach ($kubikData as $data) {
            $data_array = (array) $data;
            $data_kubik_in[] = $data_array['kubik_in'];
        }
        header('Content-Type: application/json');
        echo json_encode($data_kubik_in);
    }

    public function get_tagihan()
    {
        $columns = array(
            'no_invoice',
            'nama',
            'no_rumah',
            'bln_tagihan',
            'thn_tagihan',
            'lain',
            'nominal',
            'status',
        );

        $id = $this->session->userdata('userdata')->id_rtrw;
        $role = $this->session->userdata('userdata')->role;
        $limit = $this->input->post('length');
        $offset = $this->input->post('start');
        $order = $this->input->post('order');
        $order_column = isset($order[0]['column']) ? $columns[$order[0]['column']] : '';
        $order_dir = isset($order[0]['dir']) ? $order[0]['dir'] : '';

        $total_records = $this->M_transaksi->get_total_tagihan($role, $id);
        $filtered_records = $this->M_transaksi->get_filtered_tagihan($id, $role, $order_column, $order_dir, $limit, $offset);

        if (!is_array($filtered_records)) {
            echo json_encode(array(
                'draw' => $this->input->post('draw'),
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => array()
            ));
            return;
        }

        $data = array();
        $starting_number = isset($_POST['start']) ? $_POST['start'] : 0;
        $nomor_urut = $starting_number + 1;

        foreach ($filtered_records as $tagih) {
            $status = ($tagih->status == 0) ? '<td class="font-weight-medium"><div class="badge badge-warning">Belum Bayar</div></td>' : $tagih->status;
            $total = $tagih->nominal + $tagih->lain_lain;

            $formatted_nominal = 'Rp. ' . number_format($tagih->nominal, 0, ',', '.');
            $formatted_lain = 'Rp. ' . number_format($tagih->lain_lain, 0, ',', '.');
            $Rp_total = 'Rp. ' . number_format($total, 0, ',', '.');

            $data[] = array(
                'nomor_urut'    => $nomor_urut,
                'no_invoice'    => $tagih->no_invoice,
                'nama'          => $tagih->nama . ' &nbsp ' .'<td class="font-weight-medium"><div class="badge badge-info">' . $tagih->no_rumah . '</div></td>',
                'bln_tagihan'   => $tagih->bln_tagihan,
                'thn_tagihan'   => $tagih->thn_tagihan,
                'nominal'       => $formatted_nominal,
                'lain_lain'     => $formatted_lain,
                'total'         => $Rp_total,
                'status'        => $status,
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

    public function buat_tagihan() {
        $data = array(
            'id_rtrw' => $this->input->post('id_rtrw'),
            'id_warga' => $this->input->post('id_warga'),
            'id_iuran' => $this->input->post('id_iuran'),
            'no_invoice' => $this->input->post('no_invoice'),
            'thn_tagihan' => $this->input->post('thn_tagihan'),
            'bln_tagihan' => $this->input->post('bln_tagihan'),
            'kubik1' => $this->input->post('kubik1'),
            'kubik_in' => $this->input->post('kubik_in'),
            'hasil_kubik' => $this->input->post('hasil_kubik'),
            'abunament' => $this->input->post('abunament'),
            'perkubik' => $this->input->post('perkubik'),
            'lain_lain' => $this->input->post('lain_lain'),
            'nominal' => $this->input->post('nominal')
        );

        $this->load->model('M_transaksi');
        $result = $this->M_transaksi->save_data($data);

        if ($result) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
        }

        echo json_encode($response);
    }

    public function confm_tagihan()
    {
        $id = $this->session->userdata('userdata')->id_rtrw;
        $role = $this->session->userdata('userdata')->role;
        $data['userdata']       = $this->userdata;
        $data['bayar']          = $this->M_transaksi->get_bayar();
        $data['content'] = 'page/confm_v';
        $this->load->view($this->template, $data);
    }

    public function get_bayar()
    {
        $columns = array(
            'no_invoice',
            'code_tagihan',
            'nama',
            'no_rumah',
            'periode',
            'tgl_upload',
            'nominal',
            'total',
        );

        $id = $this->session->userdata('userdata')->id_rtrw;
        $role = $this->session->userdata('userdata')->role;
        $limit = $this->input->post('length');
        $offset = $this->input->post('start');
        $order = $this->input->post('order');
        $order_column = isset($order[0]['column']) ? $columns[$order[0]['column']] : '';
        $order_dir = isset($order[0]['dir']) ? $order[0]['dir'] : '';

        $total_records = $this->M_transaksi->get_total_bayar($role, $id);
        $filtered_records = $this->M_transaksi->get_filtered_bayar($id, $role, $order_column, $order_dir, $limit, $offset);

        if (!is_array($filtered_records)) {
            echo json_encode(array(
                'draw' => $this->input->post('draw'),
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => array()
            ));
            return;
        }

        $data = array();
        $starting_number = isset($_POST['start']) ? $_POST['start'] : 0;
        $nomor_urut = $starting_number + 1;

        foreach ($filtered_records as $bayar) {
            // $formatted_nominal = 'Rp. ' . number_format($bayar->nominal, 0, ',', '.');
            $formatted_jum = 'Rp. ' . number_format($bayar->jumlah, 0, ',', '.');

            $data[] = array(
                'nomor_urut'    => $nomor_urut,
                'no_invoice'    => $bayar->no_invoice,
                'code_tagihan'  => $bayar->code_tagihan,
                'nama'          => $bayar->nama . ' &nbsp ' .'<td class="font-weight-medium"><div class="badge badge-info">' . $bayar->no_rumah . '</div></td>',
                'periode'       => $bayar->periode,
                'tgl_upload'    => $bayar->tgl_upload,
                // 'nominal'       => $formatted_nominal,
                'total'         => $formatted_jum,
                'aksi'          => '<button type="button" data-toggle="modal" data-target="#modal-edit" class="btn btn-inverse-success btn-icon btn-sm" data-id-warga="'.$bayar->id_warga.'" data-foto-bukti="'.$bayar->foto_bukti.'" data-placement="top" title="approve">
                                    <i class="ti-eye"></i></button>'
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

    function approve()
	{
		if($this->input->post()==FALSE){
			$this->session->set_flashdata('error',"Data Gagal Di Edit");
			redirect('Data_tagihan/confm_tagihan');
		}else{
			$id 			    = $this->input->post('id_warga');
            $status 			= 2;

        $troop_ = array(
         'id_warga' 		    =>  $id,
         'status' 		        =>  $status,

      );
        $this->M_transaksi->approve($id, $troop_);
        $this->session->set_flashdata('sukses', "Berhasil Di Approve");
        redirect('Data_tagihan/confm_tagihan');

	    }
	}
    function hapus_iuran($params = '')
    {
        $this->M_iuran->hapus_iuran($params);
        $this->session->set_flashdata('sukses', 'Data berhasil dihapus.');
        return redirect('Data_iuran');
    }
    public function get_trx_approv()
    {
        $id_warga = $this->input->post('id_warga');

        $this->db->select('transaksi.code_tagihan, warga.nama, warga.no_rumah, transaksi.tgl_upload, transaksi.jumlah');
        $this->db->from('transaksi');
        $this->db->join('warga', 'warga.id_warga = transaksi.id_warga');
        $this->db->where('transaksi.id_warga', $id_warga);
        $query = $this->db->get();
        $result = $query->result();

        echo json_encode($result);
    }

}