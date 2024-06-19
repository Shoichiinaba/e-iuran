<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_cetak_keuangan extends CI_Model
{
    var $column_ordertrx = array(null, 'no_transaksi', 'tanggal', 'type_transaksi', 'keterangan', 'jenis_pemasukan');
    var $column_searchtrx = array('no_transaksi', 'tanggal', 'type_transaksi', 'keterangan', 'jenis_pemasukan');
    var $ordertrx = array('keuangan.tanggal' => 'ASC');

    public function get_filtered_data($filter_bulan, $filter_tahun, $filter_daterange) {
        $this->db->select('*');
        $this->db->from('keuangan');
        $this->db->join('saldo_awal', 'saldo_awal.id_saldo_awal = keuangan.id_saldo_awal');
        $this->db->order_by('keuangan.tanggal', 'ASC');

        if ($filter_bulan) {
            $this->db->where("MONTH(keuangan.tanggal)", $filter_bulan);
        }
        if ($filter_tahun) {
            $this->db->where("YEAR(keuangan.tanggal)", $filter_tahun);
        }

        if ($filter_daterange) {
            $date_range = explode(' - ', $filter_daterange);
            $start_date = date('Y-m-d', strtotime($date_range[0]));
            $end_date = date('Y-m-d', strtotime($date_range[1]));
            $this->db->where('keuangan.tanggal >=', $start_date);
            $this->db->where('keuangan.tanggal <=', $end_date);
        }

        $i = 0;
        foreach ($this->column_searchtrx as $trx) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($trx, $_POST['search']['value']);
                } else {
                    $this->db->or_like($trx, $_POST['search']['value']);
                }
                if (count($this->column_searchtrx) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }

        $query = $this->db->get();
        return $query->result();
    }

    function get_saldo_lalu($filter_bulan, $filter_tahun)
    {
        $prev_bulan = $filter_bulan - 1;
        $prev_tahun = $filter_tahun;

        if ($prev_bulan == 0) {
            $prev_bulan = 12;
            $prev_tahun -= 1;
        }

        $this->db->select_sum('credit', 'total_credit');
        $this->db->select_sum('debit', 'total_debit');
        $this->db->from('keuangan');
        $this->db->where("keuangan.tanggal <=", date("Y-m-t", strtotime("$prev_tahun-$prev_bulan")));
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->total_credit - $result->total_debit;
        } else {
            return 0;
        }
    }
}