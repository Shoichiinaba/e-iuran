<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hutang extends CI_Model
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

    var $column_ordertrx = array(null, 'no_transaksi', 'tanggal', 'type_transaksi', 'keterangan','jenis_pemasukan');
    var $column_searchtrx = array('no_transaksi', 'tanggal', 'type_transaksi', 'keterangan','jenis_pemasukan');
    var $ordertrx = array('keuangan.tanggal' => 'ASC');

    private function _get_datatables_trx() {
        $this->db->select('*');
        $this->db->from('keuangan');
        $this->db->where('jenis_pemasukan', 'Hutang');
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
        $this->db->from('keuangan');
        return $this->db->count_all_results();
    }



}