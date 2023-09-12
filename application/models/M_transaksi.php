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

    public function get_total_tagihan($role, $id)
    {
        if ($role == 'Admin') {

            return $this->db->count_all_results('tagihan');

        } else if ($role == 'RT') {

            $this->db->select('*');
            $this->db->where('tagihan.id_rtrw', $id);
            $this->db->where('tagihan.status', 0);
            $total_warga = $this->db->count_all_results('tagihan');
            return $total_warga;
        }

    }

    public function get_filtered_tagihan($id, $role, $order_column, $order_dir, $limit, $offset)
    {
        if ($role == 'Admin') {

        $this->db->select('*');
        $this->db->from('tagihan');
        $this->db->join('warga', 'warga.id_warga = tagihan.id_warga');
        $this->db->where('tagihan.status', 0);
        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();

        } else if ($role == 'RT') {
            $bulan_indonesia = array(
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember'
            );

            $current_month = date('n');
            $current_year = date('Y');

            $current_month_name = $bulan_indonesia[$current_month];

            $this->db->select('*');
            $this->db->from('tagihan');
            $this->db->join('warga', 'warga.id_warga = tagihan.id_warga');
            $this->db->where('tagihan.id_rtrw', $id);
            $this->db->where('tagihan.status', 0);
            $this->db->where('bln_tagihan', $current_month_name);
            $this->db->where('thn_tagihan', $current_year);
            $this->db->order_by($order_column, $order_dir);
            $this->db->limit($limit, $offset);
            $query = $this->db->get();
            return $query->result();
        }
    }

    function save_data($data) {
        return $this->db->insert('tagihan', $data);
    }

    public function get_total_bayar($role, $id)
    {
        if ($role == 'Admin') {

            return $this->db->count_all_results('transaksi');

        } else if ($role == 'RT') {

            $this->db->select('COUNT(*) AS `numrows`');
            $this->db->from('transaksi trx');
            $this->db->join('tagihan', 'tagihan.code_tagihan = trx.code_tagihan');
            $this->db->where('trx.id_rtrw', $id);
            $this->db->where('tagihan.status', 1);
            $total_warga = $this->db->get()->row()->numrows;
            return $total_warga;
        }

    }

    public function get_filtered_bayar($id, $role, $order_column, $order_dir, $limit, $offset)
    {
        if ($role == 'Admin') {

        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('warga', 'warga.id_warga = transaksi.id_warga');
        $this->db->join('tagihan', 'tagihan.code_tagihan = transaksi.code_tagihan');
        $this->db->where('tagihan.status', 1);
        $this->db->group_by('transaksi.code_tagihan');
        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();

        } else if ($role == 'RT') {

        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('warga', 'warga.id_warga = transaksi.id_warga');
        $this->db->join('tagihan', 'tagihan.code_tagihan = transaksi.code_tagihan');
        $this->db->where('tagihan.status', 1);
        $this->db->where('transaksi.id_rtrw', $id);
        $this->db->group_by('transaksi.code_tagihan');
        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();

        }
    }

    public function get_bayar()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('warga', 'warga.id_warga = transaksi.id_warga');
        $this->db->join('tagihan', 'transaksi.code_tagihan = transaksi.code_tagihan');
        $this->db->where('tagihan.status', 1);
        $query = $this->db->get();
        return $query->result();

    }

// untuk model konfirmasi tagihan
    function approve($id,$troop_)
    {
        $this->db->where('id_warga', $id);
        $this->db->update('tagihan', $troop_);
    }

// akhir untuk model konfirmasi tagihan

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
            $this->db->where_in('tagihan.status', array(0, 2));

    } else if ($role == 'RT') {

            $this->db->select('*');
            $this->db->from('tagihan');
            $this->db->join('warga', 'warga.id_warga = tagihan.id_warga');
            // $this->db->join('transaksi', 'transaksi.code_tagihan = tagihan.code_tagihan');
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

}