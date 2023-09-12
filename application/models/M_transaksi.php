<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model
{

    public function get_warga($id)
    {
        $this->db->select('id_warga, nama, id_rtrw, no_rumah');
        $this->db->from('warga');
        $this->db->where('id_rtrw', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_iuran($id_rtrw)
    {
        $this->db->select('iuran.id, iuran.id_iuran, iuran.id_rtrw, iuran.nominal, iuran.nominal1, iuran.perawatan, iuran.abunament, nama_iuran.nama ');
        $this->db->from('iuran');
        $this->db->join('nama_iuran', 'nama_iuran.id_iuran = iuran.id_iuran');
        $this->db->where('id_rtrw', $id_rtrw);
        $this->db->where('iuran.id_iuran', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function iuran_fas($id_rtrw)
    {
        $this->db->select('iuran.id, iuran.id_iuran, iuran.id_rtrw, iuran.nominal');
        $this->db->from('iuran');
        $this->db->where('id_rtrw', $id_rtrw);
        $this->db->where('iuran.id_iuran', 3);
        $query = $this->db->get();
        return $query->result();
    }

    public function taxs_adm()
    {
        $this->db->select('*');
        $this->db->from('taxs');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_meter($id_warga)
    {
        $this->db->select('id_tagihan, id_warga, kubik_in');
        $this->db->from('tagihan');
        $this->db->where('id_warga', $id_warga);
        $this->db->order_by('id_tagihan', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }

    public function no_invoice() {

        $this->db->select('rt');
        $this->db->from('rt-rw');
        $query_rt = $this->db->get();
        $rt = $query_rt->row()->rt;

        $this->db->select("RIGHT(tagihan.no_invoice, 4) as kode", FALSE);
        $this->db->order_by('no_invoice', 'DESC');
        $this->db->limit(1);

        $query_ = $this->db->get('tagihan');
        if ($query_->num_rows() <> 0) {
            $data_ = $query_->row();
            $kode_ = intval($data_->kode) + 1;
        } else {
            $kode_ = 1;
        }

        $tahun = date("y");
        $bulan = date("m");
        $kode_max_ = str_pad($kode_, 4, "0", STR_PAD_LEFT);

        $no_invoice = "IV" . '-' . $rt . '-' . $bulan . '-' . $tahun . '-' . $kode_max_;
        return $no_invoice;
    }

    function save_data($data) {
        return $this->db->insert('tagihan', $data);
    }

    // untuk data transaksi tagihan warga

    function get_filter()
    {
        $this->db->select('thn_tagihan, status');
        $this->db->from('tagihan');
        $this->db->order_by('thn_tagihan', 'ASC');
        $this->db->group_by('thn_tagihan');
        $query = $this->db->get();
        return $query->result();
    }

    // start datatables
    var $column_order = array(null, 'no_invoice', 'bln_tagihan', 'thn_tagihan');
    var $column_search = array('no_invoice','nama', 'bln_tagihan', 'thn_tagihan', 'status');
    var $order = array('tagihan.id_tagihan' => 'asc'); // default order

    private function _get_datatables_query($id, $role, $bulan_filter, $status_filter, $tahun_filter) {
        if ($role == 'Admin') {

            $this->db->select('*');
            $this->db->from('tagihan');
            $this->db->join('warga', 'warga.id_warga = tagihan.id_warga');
            $this->db->join('taxs', 'taxt.id_warga = tagihan.id_warga');
            $this->db->where_in('tagihan.status', array(0, 2));

    } else if ($role == 'RT') {

            $this->db->select('*');
            $this->db->from('tagihan');
            $this->db->join('warga', 'warga.id_warga = tagihan.id_warga');
            $this->db->where('tagihan.id_rtrw', $id);
            $this->db->where_in('tagihan.status', array(0, 2));

            if ($bulan_filter) {
                $this->db->where('tagihan.bln_tagihan', $bulan_filter);
            }
            if ($status_filter !== '') {
                $this->db->where('tagihan.status', $status_filter);
            }
            if ($tahun_filter !== '') {
                $this->db->where('tagihan.thn_tagihan', $tahun_filter);
            }

            $i = 0;
            foreach ($this->column_search as $item) {
                if(@$_POST['search']['value']) {
                    if($i===0) {
                        $this->db->group_start();
                        $this->db->like($item, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }
                    if(count($this->column_search) - 1 == $i)
                        $this->db->group_end();
                }
                $i++;
            }

            if(isset($_POST['order'])) {
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }  else if(isset($this->order)) {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }
    }
    function get_datatables($id, $role, $bulan_filter, $status_filter, $tahun_filter ) {
        $this->_get_datatables_query($id, $role, $bulan_filter, $status_filter, $tahun_filter);
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered($id,$role, $bulan_filter, $status_filter, $tahun_filter) {
        $this->_get_datatables_query($id, $role, $bulan_filter, $status_filter, $tahun_filter);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all() {
        $this->db->from('tagihan');
        return $this->db->count_all_results();
    }
    // end datatables

    // datatable serverside untuk transaksi pembayaran
    var $column_ordertrx = array(null, 'code_tagihan', 'no_invoice', 'bln_tagihan', 'thn_tagihan');
    var $column_searchtrx = array('code_tagihan', 'no_invoice','nama', 'bln_tagihan', 'thn_tagihan', 'tgl_upload', 'tgl_byr','foto_bukti');
    var $ordertrx = array('transaksi.id_transaksi' => 'asc'); // default order

    private function _get_datatables_trx($id, $role) {
        if ($role == 'Admin') {

            $this->db->select('*');
            $this->db->from('tagihan');
            $this->db->join('warga', 'warga.id_warga = tagihan.id_warga');
            $this->db->where_in('tagihan.status', array(0, 2));

    } else if ($role == 'RT') {

            $this->db->select('*');
            $this->db->from('transaksi');
            $this->db->join('tagihan', 'tagihan.code_tagihan = transaksi.code_tagihan');
            $this->db->join('warga', 'warga.id_warga = transaksi.id_warga');
            $this->db->where('transaksi.id_rtrw', $id);

            $i = 0;
            foreach ($this->column_search as $trx) {
                if(@$_POST['search']['value']) {
                    if($i===0) {
                        $this->db->group_start();
                        $this->db->like($trx, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($trx, $_POST['search']['value']);
                    }
                    if(count($this->column_search) - 1 == $i)
                        $this->db->group_end();
                }
                $i++;
            }

            if(isset($_POST['order'])) {
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }  else if(isset($this->order)) {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }
    }
    function get_datatablest($id, $role) {
        $this->_get_datatables_trx($id, $role);
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtereds($id,$role) {
        $this->_get_datatables_trx($id, $role);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all_trx() {
        $this->db->from('transaksi');
        return $this->db->count_all_results();
    }
    // akhir datatable serverside untuk transaksi pembayaran
}