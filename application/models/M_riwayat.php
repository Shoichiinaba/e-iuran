<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_riwayat extends CI_Model
{
    function m_riwayat_anda($id_warga)
    {

        $this->db->select('*');
        $this->db->from('tagihan');
        $this->db->join('transaksi', 'transaksi.code_tagihan = tagihan.code_tagihan');
        $this->db->where('tagihan.id_warga', $id_warga);
        $query = $this->db->get();
        return $query->result();
    }
    function m_riwayat_warga($id_warga,$rt)
    {

        $this->db->select('*');
        $this->db->from('warga');
        $this->db->join('rt-rw', 'rt-rw.id_rtrw = warga.id_rtrw');
        $this->db->join('tagihan', 'warga.id_warga = tagihan.id_warga');
        $this->db->where('rt-rw.id_rtrw', $rt);
        // $this->db->order_by('tagihan.status', 'desc');
        $this->db->group_by('warga.id_warga');
        // $this->db->group_by('tagihan.status');
        $query = $this->db->get();
        return $query->result();
    }

    function m_unpaid($id)
    {
        $this->db->select('*, COUNT(tagihan.status = 0) as total');
        $this->db->from('tagihan');
        $this->db->join('warga', 'warga.id_warga = tagihan.id_warga');
        $this->db->where('tagihan.id_warga', $id);
        $this->db->where('status', '0');
        // $this->db->group_by('tagihan.id_warga');
        // $this->db->order_by('tagihan.id_tagihan');
        $query = $this->db->get();
        return $query->result();
    }
}