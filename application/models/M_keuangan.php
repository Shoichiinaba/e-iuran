<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Keuangan extends CI_Model
{
    var $column_ordertrx = array(null, 'no_transaksi', 'tanggal', 'type_transaksi', 'keterangan','jenis_pemasukan');
    var $column_searchtrx = array('no_transaksi', 'tanggal', 'type_transaksi', 'keterangan','jenis_pemasukan');
    var $ordertrx = array('keuangan.tanggal' => 'ASC');

    private function _get_datatables_trx() {
        $this->db->select('*');
        $this->db->from('keuangan');
        $this->db->join('saldo_awal', 'saldo_awal.id_saldo_awal = keuangan.id_saldo_awal');
        $this->db->order_by('keuangan.tanggal', 'ASC');

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
            $order_column = $this->column_ordertrx[$_POST['order']['0']['column']];
            if($order_column === 'tanggal') {
                $this->db->order_by('keuangan.tanggal', $_POST['order']['0']['dir']);
            } else {
                $this->db->order_by($order_column, $_POST['order']['0']['dir']);
            }
        } else if(isset($this->ordertrx)) {
            $order = $this->ordertrx;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatablest() {
        $this->_get_datatables_trx();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtereds() {
        $this->_get_datatables_trx();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all_trx() {
        $this->db->from('keuangan');
        return $this->db->count_all_results();
    }

    function count_tagihan_by_warga($id_warga, $id) {
        $this->db->select('id_warga, COUNT(*) as total_tagihan');
        $this->db->from('tagihan');
        $this->db->where('id_warga', $id_warga);
        $this->db->where('id_rtrw', $id);
        $this->db->where('status', 0);
         $this->db->group_by('id_rtrw');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->row()->total_tagihan;
            } else {
                return 0;
            }
    }

    function count_tagihan_nominal($id_warga, $id) {
        $this->db->select_sum('nominal', 'total_nominal');
        $this->db->select_sum('lain_lain', 'total_lain');
        $this->db->select_sum('taxs', 'total_taxs');

        $this->db->from('tagihan');
        $this->db->where('id_warga', $id_warga);
        $this->db->where('id_rtrw', $id);
        $this->db->where('status', 0);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->total_nominal + $result->total_lain + $result->total_taxs;
        } else {
            return 0;
        }
    }

    function count_tagihan_bulan($id_warga, $id) {
        $this->db->select('bln_tagihan, COUNT(*) as total_tagihan');
        $this->db->from('tagihan');
        $this->db->where('id_warga', $id_warga);
        $this->db->where('id_rtrw', $id);
        $this->db->where('status', 0);
        $this->db->group_by('no_rumah');
        $this->db->order_by('id_tagihan', 'ASC');
        $query = $this->db->get();

        $tagihan_by_bulan = array();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $tagihan_by_bulan[$row->bln_tagihan] = $row->total_tagihan;
            }
        }

        return $tagihan_by_bulan;
    }

    public function no_pembayaran() {
        $this->db->select("MAX(CAST(RIGHT(keuangan.no_transaksi, 4) AS UNSIGNED)) as max_kode", FALSE);
        $this->db->where('type_transaksi', 'Pembayaran');
        $this->db->order_by('no_transaksi', 'DESC');
        $this->db->limit(1);

        $query_ = $this->db->get('keuangan');
        if ($query_->num_rows() > 0) {
            $data_ = $query_->row();
            $max_kode = intval($data_->max_kode) + 1;
        } else {
            $max_kode = 1;
        }

        $tanggal = date("d");
        $tahun   = date("y");
        $bulan   = date("m");
        $kode_max_ = str_pad($max_kode, 4, "0", STR_PAD_LEFT);

        $no_invoice = "PAY" . '/' .$tanggal. '-' . $bulan . '-' . $tahun . '-' . $kode_max_;
        return $no_invoice;
    }

    public function no_penerimaan() {
        $this->db->select("MAX(CAST(RIGHT(keuangan.no_transaksi, 4) AS UNSIGNED)) as max_kode", FALSE);
        $this->db->where('type_transaksi', 'Penerimaan');
        $this->db->order_by('no_transaksi', 'DESC');
        $this->db->limit(1);

        $query_ = $this->db->get('keuangan');

        if ($query_->num_rows() > 0) {
            $data_ = $query_->row();
            $max_kode = intval($data_->max_kode) + 1;
        } else {
            $max_kode = 1;
        }

        $tanggal = date("d");
        $tahun   = date("y");
        $bulan   = date("m");
        $kode_max_ = str_pad($max_kode, 4, "0", STR_PAD_LEFT);
        $no_invoice = "RECEPT" . '/' .$tanggal. '-' . $bulan . '-' . $tahun . '-' . $kode_max_;
        return $no_invoice;
    }

    function save_data($data) {
        return $this->db->insert('keuangan', $data);
    }

    function saldo_hutang()
    {
        $this->db->select_sum('credit', 'total_hutang');
        $this->db->from('keuangan');
        $this->db->where('jenis_pemasukan', 'Hutang');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->total_hutang;
        } else {
            return 0;
        }
    }

    function saldo_bln_lalu()
    {
        $this->db->select('MAX(tanggal) as max_date');
        $this->db->from('keuangan');
        $query = $this->db->get();
        $result = $query->row();
        $maxDate = date('Y-m-d', strtotime('-1 month', strtotime($result->max_date)));

        $this->db->select_sum('credit', 'total_credit');
        $this->db->select_sum('debit', 'total_debit');
        $this->db->from('keuangan');
        $this->db->where("DATE(tanggal) >= DATE('$maxDate')");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->total_credit - $result->total_debit;
        } else {
            return 0;
        }
    }

    function get_cash() {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('tagihan', 'tagihan.code_tagihan = transaksi.code_tagihan');
        $this->db->where('tagihan.status', 2);
        $this->db->where('transaksi.status_saldo', 1);
        $this->db->where('transaksi.foto_bukti', 'CASH');
        $this->db->group_by('transaksi.code_tagihan');

        $query = $this->db->get();
        return $query->result();
    }

}