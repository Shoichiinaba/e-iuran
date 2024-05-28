<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_chat extends CI_Model
{
    var $column_ordertrx = array(null, 'bln_tagihan', 'thn_tagihan');
    var $column_searchtrx = array('nama', 'no_rumah', 'bln_tagihan', 'thn_tagihan');
    var $ordertrx = array('tagihan.id_tagihan' => 'asc');

    private function _get_datatables_trx($id, $filter_segel) {

        $this->db->select('*');
        $this->db->from('tagihan');
        $this->db->join('warga', 'warga.id_warga = tagihan.id_warga');
        $this->db->where('tagihan.id_rtrw', $id);
        $this->db->where('(tagihan.status = 0 OR (tagihan.status = 0 AND warga.status_segel > 0) OR(tagihan.status= 2 AND warga.status_segel = 2))');
        $this->db->group_by('tagihan.id_warga');


        if ($filter_segel == 1 || $filter_segel == 2) {
            $this->db->where('warga.status_segel', $filter_segel);
        }
        elseif ($filter_segel !== '') {
            $this->db->where('tagihan.status = 0 AND warga.status_segel = 0');
            $this->db->having('COUNT(tagihan.bln_tagihan) >', 2);
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
    function get_datatablest($id, $filter_segel) {
        $this->_get_datatables_trx($id, $filter_segel);
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtereds($id, $filter_segel) {
        $this->_get_datatables_trx($id, $filter_segel);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all_trx() {
        $this->db->from('tagihan');
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

    public function segel($id_warga)
    {
        $this->db->where('id_warga', $id_warga);
        $this->db->set('status_segel', 1);
        $updated = $this->db->update('warga');

        return $updated;
    }

    public function buka_segel($id_warga)
    {
        $this->db->where('id_warga', $id_warga);
        $this->db->set('status_segel', 0);
        $updated = $this->db->update('warga');

        return $updated;
    }
}