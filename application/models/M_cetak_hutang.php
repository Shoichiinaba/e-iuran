<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_cetak_hutang extends CI_Model
{
    var $column_ordertrx = array(null, 'no_transaksi', 'tanggal', 'type_transaksi', 'keterangan','jenis_pemasukan');
    var $column_searchtrx = array('no_transaksi', 'tanggal', 'type_transaksi', 'keterangan','jenis_pemasukan');
    var $ordertrx = array('keuangan.tanggal' => 'ASC');

    function get_data_hutang() {

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

        $query = $this->db->get();
        return $query->result();
    }
}