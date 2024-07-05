<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model
{

    public function get_warga($id_rtrw)
    {
        // untuk data per rt
        $this->db->select('warga.id_warga, warga.nama, warga.id_rtrw, warga.no_rumah, warga.kapling_gabungan, perumahan.id_perumahan, perumahan.nama as nama_perum');
        $this->db->from('warga');
        $this->db->join('perumahan', 'warga.id_perum = perumahan.id_perumahan');
        $this->db->where('id_rtrw', $id_rtrw);
        $query = $this->db->get();
        return $query->result();

        // untuk data warga per perumahan
        // $this->db->select('warga.id_warga, warga.nama, warga.id_rtrw, warga.no_rumah, perumahan.id_perumahan, perumahan.nama as nama_perum');
        // $this->db->from('warga');
        // $this->db->join('perumahan', 'warga.id_perum = perumahan.id_perumahan');
        // $this->db->where('id_perum', $id);
        // $query = $this->db->get();
        // return $query->result();
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
        $rt_query = $this->db->select('rt')->get('rt-rw');
        $rt = $rt_query->row()->rt;

        $this->db->select("MAX(CAST(RIGHT(tagihan.no_invoice, 4) AS UNSIGNED)) as kode", FALSE);
        $this->db->order_by('no_invoice', 'DESC')->limit(1);
        $invoice_query = $this->db->get('tagihan');

        if ($invoice_query->num_rows() > 0) {
            $data = $invoice_query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        // Format nomor tagihan
        $tahun = date("y");
        $bulan = date("m");
        $kode_max = str_pad($kode, 4, "0", STR_PAD_LEFT);

        $no_invoice = "IV-$rt-$bulan-$tahun-$kode_max";
        return $no_invoice;
    }


    function save_data($data) {
        return $this->db->insert('tagihan', $data);
    }

    function check_existing_data($id_warga, $bln_tagihan, $thn_tagihan) {
        $this->db->where('id_warga', $id_warga);
        $this->db->where('bln_tagihan', $bln_tagihan);
        $this->db->where('thn_tagihan', $thn_tagihan);
        $query = $this->db->get('tagihan');
        return $query->num_rows() > 0;
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

    function get_filter_perum()
    {
        $this->db->select('*');
        $this->db->from('perumahan');
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function get_bank($id_rtrw, $role)
    {
        if ($role == 'Admin') {
            $this->db->select('foto_bukti');
            $this->db->from('transaksi');
            $this->db->where('foto_bukti IS NOT NULL');
            $this->db->where('foto_bukti !=', '');
            $this->db->where_not_in('foto_bukti', ['Update date', 'Hi-care']);
            $this->db->order_by('foto_bukti', 'ASC');
            $this->db->group_by('foto_bukti');
            $query = $this->db->get();
            return $query->result();
        } else if ($role == 'RT') {
            $this->db->select('foto_bukti');
            $this->db->from('transaksi');
            $this->db->where('foto_bukti IS NOT NULL');
            $this->db->where('foto_bukti !=', '');
            $this->db->where_not_in('foto_bukti', ['Update date', 'Hi-care']);
            $this->db->where('id_rtrw', $id_rtrw);
            $this->db->order_by('foto_bukti', 'ASC');
            $this->db->group_by('foto_bukti');
            $query = $this->db->get();
            return $query->result();
        }
    }

    // start datatables
    var $column_order = array(null, 'tagihan.no_invoice', 'tagihan.bln_tagihan', 'tagihan.thn_tagihan');
    var $column_search = array('tagihan.no_invoice','warga.nama', 'warga.no_rumah', 'tagihan.bln_tagihan', 'tagihan.thn_tagihan', 'tagihan.status');
    var $order = array('tagihan.no_invoice' => 'desc');

    private function _get_datatables_query($id, $role, $bulan_filter, $status_filter, $tahun_filter, $filter_perum)
    {
        if ($role == 'Admin') {

            $this->db->select('tagihan.*, warga.*, warga.nama as nama_warga, perumahan.nama as nama_perum');
            $this->db->from('tagihan');
            $this->db->join('warga', 'warga.id_warga = tagihan.id_warga');
            $this->db->join('perumahan', 'perumahan.id_perumahan = warga.id_perum');
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
            if ($filter_perum !== '') {
                $this->db->where('perumahan.nama', $filter_perum);
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

    } else if ($role == 'RT') {

            $this->db->select('*, warga.nama as nama_warga');
            $this->db->from('tagihan');
            $this->db->join('warga', 'warga.id_warga = tagihan.id_warga');
            $this->db->where('tagihan.id_rtrw', $id);
            $this->db->where_in('tagihan.status', array(0, 2));
            $this->db->order_by('tagihan.no_invoice', 'desc');

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
    function get_datatables($id, $role, $bulan_filter, $status_filter, $tahun_filter, $filter_perum ) {
        $this->_get_datatables_query($id, $role, $bulan_filter, $status_filter, $tahun_filter, $filter_perum);
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered($id,$role, $bulan_filter, $status_filter, $tahun_filter, $filter_perum) {
        $this->_get_datatables_query($id, $role, $bulan_filter, $status_filter, $tahun_filter, $filter_perum);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all() {
        $this->db->from('tagihan');
        return $this->db->count_all_results();
    }
    // end datatables

    // datatable serverside untuk transaksi pembayaran
    var $column_ordertrx = array(null, 'transaksi.code_tagihan', 'transaksi.no_invoice', 'bln_tagihan', 'thn_tagihan');
    var $column_searchtrx = array('transaksi.code_tagihan', 'no_invoice','warga.nama', 'warga.no_rumah', 'bln_tagihan', 'thn_tagihan', 'transaksi.tgl_upload', 'transaksi.tgl_byr','transaksi.foto_bukti');
    var $ordertrx = array('transaksi.id_transaksi' => 'asc');

    private function _get_datatables_trx($id, $role,  $status_trans, $jenis_trans, $perum_filter) {
        if ($role == 'Admin') {

            $this->db->select('*, warga.nama as nama_warga, perumahan.nama as nama_perum');
            $this->db->from('transaksi');
            $this->db->join('tagihan', 'tagihan.code_tagihan = transaksi.code_tagihan');
            $this->db->join('warga', 'warga.id_warga = transaksi.id_warga');
            $this->db->join('perumahan', 'perumahan.id_perumahan = warga.id_perum');
            $this->db->where_in('tagihan.status', array(1, 2));
            $this->db->group_by('transaksi.code_tagihan');

            if ($status_trans !== '') {
                $this->db->where('tagihan.status', $status_trans);
            }

            if ($jenis_trans !== '') {
                $this->db->where('transaksi.foto_bukti', $jenis_trans);
            }

            if ($perum_filter !== '') {
                $this->db->where('perumahan.nama', $perum_filter);
            }

            $i = 0;
            foreach ($this->column_searchtrx as $trx) {
                if(@$_POST['search']['value']) {
                    if($i===0) {
                        $this->db->group_start();
                        $this->db->like($trx, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($trx, $_POST['search']['value']);
                    }
                    if(count($this->column_searchtrx) - 1 == $i)
                        $this->db->group_end();
                }
                $i++;
            }

            if(isset($_POST['order'])) {
                $this->db->order_by($this->column_ordertrx[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }  else if(isset($this->order)) {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }

    } else if ($role == 'RT') {

            $this->db->select('*, warga.nama as nama_warga');
            $this->db->from('transaksi');
            $this->db->join('tagihan', 'tagihan.code_tagihan = transaksi.code_tagihan');
            $this->db->join('warga', 'warga.id_warga = transaksi.id_warga');
            $this->db->where('transaksi.id_rtrw', $id);
            $this->db->where_in('tagihan.status', array(1, 2));
            $this->db->group_by('transaksi.code_tagihan');

            if ($status_trans !== '') {
                $this->db->where('tagihan.status', $status_trans);
            }

            if ($jenis_trans !== '') {
                $this->db->where('transaksi.foto_bukti', $jenis_trans);
            }

            $i = 0;
            foreach ($this->column_searchtrx as $trx) {
                if(@$_POST['search']['value']) {
                    if($i===0) {
                        $this->db->group_start();
                        $this->db->like($trx, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($trx, $_POST['search']['value']);
                    }
                    if(count($this->column_searchtrx) - 1 == $i)
                        $this->db->group_end();
                }
                $i++;
            }

            if(isset($_POST['order'])) {
                $this->db->order_by($this->column_ordertrx[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }  else if(isset($this->order)) {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }
    }
    function get_datatablest($id, $role, $status_trans, $jenis_trans, $perum_filter) {
        $this->_get_datatables_trx($id, $role, $status_trans, $jenis_trans, $perum_filter);
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtereds($id,$role, $status_trans, $jenis_trans, $perum_filter) {
        $this->_get_datatables_trx($id, $role,  $status_trans, $jenis_trans, $perum_filter);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all_trx() {
        $this->db->from('transaksi');
        return $this->db->count_all_results();
    }
    // akhir datatable serverside untuk transaksi pembayaran

    function get_saldo($id_perum, $id) {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('tagihan', 'tagihan.code_tagihan = transaksi.code_tagihan');
        $this->db->join('warga', 'warga.id_warga = transaksi.id_warga');
        $this->db->where('transaksi.id_perum', $id_perum);
        $this->db->where('transaksi.id_rtrw', $id);
        $this->db->where('tagihan.status', 2);
        $this->db->where('transaksi.status_saldo', 1);
        $this->db->where('transaksi.foto_bukti !=', 'CASH');
        $this->db->group_by('transaksi.code_tagihan');

        $query = $this->db->get();
        return $query->result();
    }

}