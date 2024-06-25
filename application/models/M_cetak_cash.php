<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_cetak_cash extends CI_Model
{
    function get_pembayaran_cash() {

        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('warga', 'warga.id_warga = transaksi.id_warga');
        $this->db->where('transaksi.status_saldo', 1);
        $this->db->where('transaksi.foto_bukti', 'CASH');
        $this->db->order_by('transaksi.id_transaksi', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }
}