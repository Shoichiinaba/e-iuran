<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_cash extends CI_Model
{

    public function get_data_tagihan($limit, $start, $search = '')
    {
        $this->db->select('tagihan.*, warga.*, perumahan.nama AS nama_perum');
        $this->db->from('tagihan');
        $this->db->join('warga', 'warga.id_warga = tagihan.id_warga');
        $this->db->join('perumahan', 'perumahan.id_perumahan = warga.id_perum');
        $this->db->where('tagihan.status', 0);
        $this->db->group_by('tagihan.id_warga');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('warga.no_rumah', $search);
            $this->db->or_like('warga.nama', $search);
            $this->db->group_end();
        }

        $this->db->order_by("tagihan.id_tagihan", "ASC");
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        return $query;
    }


    function jlm_tagihan($id_warga) {
        $this->db->select('id_warga, COUNT(*) as total_tagihan');
        $this->db->from('tagihan');
        $this->db->where('id_warga', $id_warga);
        $this->db->where('status', 0);
         $this->db->group_by('id_warga');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->row()->total_tagihan;
            } else {
                return 0;
            }
    }

    function jml_tagihan_nominal($id_warga) {
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

    var $column_ordertrx = array(null, 'transaksi.code_tagihan', 'transaksi.code_tagihan');
    var $column_searchtrx = array('transaksi.code_tagihan', 'warga.nama', 'warga.no_rumah', 'transaksi.tgl_upload');
    var $ordertrx = array('transaksi.id_transaksi' => 'asc');

    private function _get_datatables_trx() {

        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('warga', 'warga.id_warga = transaksi.id_warga');
        $this->db->where('transaksi.status_saldo', 1);
        $this->db->where('transaksi.foto_bukti', 'CASH');
        $this->db->order_by('transaksi.id_transaksi', 'DESC');

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
        $this->db->from('transaksi');
        return $this->db->count_all_results();
    }



}