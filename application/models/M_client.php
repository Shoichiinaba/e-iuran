<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_client extends CI_Model
{
    function m_biodata($id_warga)
    {

        $this->db->select('warga.nama,warga.no_rumah,warga.no_hp, perumahan.nama as nm_perum, rt-rw.rt,rt-rw.rw ');
        $this->db->from('warga');
        $this->db->join('perumahan', 'perumahan.id_perumahan = warga.id_perum');
        $this->db->join('rt-rw', 'rt-rw.id_rtrw = warga.id_rtrw');
        $this->db->where('warga.id_warga', $id_warga);
        $query = $this->db->get();
        return $query->result();
    }
    function m_riwayat_anda($id_warga)
    {

        $this->db->select('*');
        $this->db->from('tagihan');
        $this->db->where('tagihan.id_warga', $id_warga);
        $query = $this->db->get();
        return $query->result();
    }
    function m_riwayat_warga($id_warga)
    {

        $this->db->select('*');
        $this->db->from('warga');
        $this->db->join('tagihan', 'warga.id_warga = tagihan.id_warga');
        // $this->db->where_not_in('tagihan.id_warga', $id_warga);
        // $this->db->where('status', '0');
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
    function m_tagihan_air($id_warga)
    {

        $this->db->select('*');
        $this->db->from('tagihan');
        // $this->db->where_in('id_iuran', '1');
        $this->db->where('status', '0');
        $this->db->where('id_warga', $id_warga);
        $query = $this->db->get();
        return $query->result();
    }
    function m_upload_bukti($data)
    {
        $result = $this->db->insert('transaksi', $data);
        return $result;
    }
    function m_update_tagihan($code_tagihan, $id_tagihan)
    {
        $update = $this->db->set('code_tagihan', $code_tagihan)
            ->set('status', '1')
            ->where_in('id_tagihan', explode(",", $id_tagihan))
            // ->where('status', '0')
            ->update('tagihan');
        return $update;
    }
}
