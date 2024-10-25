<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_tagihan_adm extends CI_Model
{
    function get_filter_perum()
    {
        $this->db->select('*');
        $this->db->from('perumahan');
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    var $column_ordertrx = array(null, 'bln_tagihan', 'thn_tagihan');
    var $column_searchtrx = array('nama', 'no_rumah', 'bln_tagihan', 'thn_tagihan');
    var $ordertrx = array('tagihan.id_tagihan' => 'asc');

    private function _get_datatables_trx($filter_perum, $filter_periode) {
        $this->db->select('warga.id_warga, COUNT(tagihan.id_tagihan) as jumlah_tagihan, warga.nama as nama_warga,warga.no_rumah, perumahan.nama as nama_perum, tagihan.status');
        $this->db->from('tagihan');
        $this->db->join('warga', 'warga.id_warga = tagihan.id_warga');
        $this->db->join('perumahan', 'perumahan.id_perumahan = warga.id_perum');
        $this->db->where('tagihan.status', 0);

        if ($filter_perum !== '') {
            $this->db->where('perumahan.id_perumahan', $filter_perum);
        }

        $this->db->group_by('warga.id_warga');

        if ($filter_periode !== '') {
            $this->db->having('jumlah_tagihan >=', (int)$filter_periode);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_ordertrx[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('jumlah_tagihan', 'DESC');
        }
    }

    function get_datatablest($filter_perum, $filter_periode) {
        $this->_get_datatables_trx($filter_perum, $filter_periode);
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtereds($filter_perum, $filter_periode) {
        $this->_get_datatables_trx($filter_perum, $filter_periode);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all_trx() {
        $this->db->from('tagihan');
        return $this->db->count_all_results();
    }

    function count_tagihan_by_warga($id_warga) {
        $this->db->select('id_warga, COUNT(*) as total_tagihan');
        $this->db->from('tagihan');
        $this->db->where('id_warga', $id_warga);
        $this->db->where('status', 0);
         $this->db->group_by('id_rtrw');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->row()->total_tagihan;
            } else {
                return 0;
            }
    }

    function count_tagihan_nominal($id_warga) {
        $this->db->select_sum('nominal', 'total_nominal');
        $this->db->select_sum('lain_lain', 'total_lain');
        $this->db->select_sum('taxs', 'total_taxs');

        $this->db->from('tagihan');
        $this->db->where('id_warga', $id_warga);
        $this->db->where('status', 0);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->total_nominal + $result->total_lain + $result->total_taxs;
        } else {
            return 0;
        }
    }

    function count_tagihan_bulan($id_warga) {
        $this->db->select('bln_tagihan, COUNT(*) as total_tagihan');
        $this->db->from('tagihan');
        $this->db->where('id_warga', $id_warga);
        $this->db->where('status', 0);
        $this->db->group_by('bln_tagihan');
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
}