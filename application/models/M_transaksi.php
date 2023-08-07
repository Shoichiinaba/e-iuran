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

    public function get_iuran($id)
    {
        $this->db->select('iuran.id, iuran.id_iuran, iuran.id_rtrw, iuran.nominal, iuran.nominal1, iuran.perawatan, iuran.abunament, nama_iuran.nama ');
        $this->db->from('iuran');
        $this->db->join('nama_iuran', 'nama_iuran.id_iuran = iuran.id_iuran');
        $this->db->where('id_rtrw', $id);
        $this->db->where('iuran.id_iuran', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function iuran_fas($id)
    {
        $this->db->select('iuran.id, iuran.id_iuran, iuran.id_rtrw, iuran.nominal');
        $this->db->from('iuran');
        $this->db->where('id_rtrw', $id);
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

        $this->db->select('*');
        $this->db->from('tagihan');
        $this->db->join('warga', 'warga.id_warga = tagihan.id_warga');
        $this->db->where('tagihan.id_rtrw', $id);
        $this->db->where('tagihan.status', 0);
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

    function approve($id,$troop_)
    {
        $this->db->where('id_warga', $id);
        $this->db->update('tagihan', $troop_);
    }


}