<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_saldo extends CI_Model
{

    function get_saldo($id_perumahan)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('tagihan', 'tagihan.code_tagihan = transaksi.code_tagihan');
        $this->db->join('warga', 'warga.id_warga = transaksi.id_warga');
        $this->db->where('transaksi.id_perum', $id_perumahan);
        $this->db->where('tagihan.status', 2);
        $this->db->where('transaksi.status_saldo', 1);
        $this->db->group_by('transaksi.code_tagihan');

        $query = $this->db->get();
        return $query->result();
    }

    function get_filter_saldo($id_perum, $id_rtrw, $startDate, $endDate)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('tagihan', 'tagihan.code_tagihan = transaksi.code_tagihan');
        $this->db->join('warga', 'warga.id_warga = transaksi.id_warga');
        $this->db->where('transaksi.id_perum', $id_perum);
        $this->db->where('transaksi.id_rtrw', $id_rtrw);
        $this->db->where('tagihan.status', 2);
        $this->db->where('transaksi.status_saldo', 1);

        // if ($startDate && $endDate) {
        //     // Konversi string tanggal ke format tanggal MySQL
        //     $this->db->where("STR_TO_DATE(transaksi.tgl_byr, '%d-%m-%Y') >=", $startDate, false);
        //     $this->db->where("STR_TO_DATE(transaksi.tgl_byr, '%d-%m-%Y') <=", $endDate, false);
        // }

        if ($startDate && $endDate) {
            $this->db->where('transaksi.tgl_byr >=', $startDate);
            $this->db->where('transaksi.tgl_byr <=', $endDate);
        }

        $this->db->group_by('transaksi.code_tagihan');

        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result();
    }

    public function no_tf() {

        $this->db->select("RIGHT(saldo.code_tranfer, 4) as kode", FALSE);
        $this->db->order_by('code_tranfer', 'DESC');
        $this->db->limit(1);

        $query_ = $this->db->get('saldo');
        if ($query_->num_rows() <> 0) {
            $data_ = $query_->row();
            $kode_ = intval($data_->kode) + 1;
        } else {
            $kode_ = 1;
        }

        $tahun = date("y");
        $bulan = date("m");
        $kode_max_ = str_pad($kode_, 4, "0", STR_PAD_LEFT);

        $no_invoice = "TF" . "SAL" . '-' . $bulan . '-' . $tahun . '-' . $kode_max_;
        return $no_invoice;
    }

    function save_data($data) {
        return $this->db->insert('saldo', $data);
    }

    function update_saldo($status, $id_perum, $id_rtrw)
    {
        $update = $this->db->set('status_saldo', $status)
            ->where('status_saldo', 1)
            ->where('id_perum', $id_perum)
            ->where('id_rtrw', $id_rtrw)
            ->update('transaksi');
        return $update;
    }


    // datatable serverside untuk transaksi histori
    var $column_order = array(null, 'code_tranfer', 'tanggal');
    var $column_search = array('code_tranfer', 'tanggal','saldo');
    var $ordertrx = array('transaksi.id_transaksi' => 'asc');

    private function _get_datatables_tf($id_perum, $id)
    {
            $this->db->select('*');
            $this->db->from('saldo');
            $this->db->join('perumahan', 'saldo.id_perum = perumahan.id_perumahan');
            $this->db->where('saldo.id_perum', $id_perum);
            $this->db->where('saldo.id_rtrw', $id);

            $i = 0;
            foreach ($this->column_search as $trx) {
                if(@$_POST['search']['value']) {
                    if($i===0) {
                        $this->db->group_start();
                        $this->db->like($trx, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($trx, $_POST['search']['value']);
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
    function get_datatablest($id_perum, $id) {
        $this->_get_datatables_tf($id_perum, $id);
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtereds($id_perum, $id) {
        $this->_get_datatables_tf($id_perum, $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all_tf() {
        $this->db->from('saldo');
        return $this->db->count_all_results();
    }
    // akhir datatable serverside untuk transaksi pembayaran

    // datatable serverside untuk transaksi tari saldo admin
    private function _get_datatables_sal($id_perum)
    {
            $this->db->select('*');
            $this->db->from('saldo');
            $this->db->join('perumahan', 'saldo.id_perum = perumahan.id_perumahan');
            $this->db->join('rt-rw', 'saldo.id_rtrw = rt-rw.id_rtrw');
            $this->db->where('saldo.id_perum', $id_perum);

            $i = 0;
            foreach ($this->column_search as $trx) {
                if(@$_POST['search']['value']) {
                    if($i===0) {
                        $this->db->group_start();
                        $this->db->like($trx, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($trx, $_POST['search']['value']);
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
    function get_datatables($id_perum) {
        $this->_get_datatables_sal($id_perum);
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered($id_perum) {
        $this->_get_datatables_sal($id_perum);
        $query = $this->db->get();
        return $query->num_rows();
    }
    // akhir datatable serverside untuk transaksi tari saldo admin
}