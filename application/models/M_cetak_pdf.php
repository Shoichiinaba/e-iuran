<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_cetak_pdf extends CI_Model
{
    function m_data_invoice($no_invoice, $id_warga)
    {
        $this->db->select('*, perumahan.nama as perum, warga.nama as nm_warga');
        $this->db->from('tagihan');
        $this->db->join('warga', 'warga.id_warga = tagihan.id_warga');
        $this->db->join('perumahan', 'perumahan.id_perumahan = warga.id_perum');
        $this->db->join('rt-rw', 'rt-rw.id_rtrw = warga.id_rtrw');
        $this->db->join('transaksi', 'tagihan.code_tagihan = transaksi.code_tagihan');
        $this->db->where('no_invoice', $no_invoice);
        $query = $this->db->get();
        return $query->result();
    }

    function m_bukti_tarik($id_perum)
    {
        $this->db->select('*');
        $this->db->from('saldo');
        $this->db->join('perumahan', 'saldo.id_perum = perumahan.id_perumahan');
        // $this->db->where('saldo.id_perum', $id_perum);
        $query = $this->db->get();
        return $query->result();
    }
}