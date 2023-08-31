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
    function m_info_tunggakan($id_warga)
    {
        $this->db->select('*, COUNT(tagihan.status = 0) as bulan, SUM(lain_lain + nominal) as total');
        $this->db->from('tagihan');
        $this->db->where('tagihan.id_warga', $id_warga);
        $this->db->where('status', '0');
        // $this->db->group_by('tagihan.id_warga');
        // $this->db->order_by('tagihan.id_tagihan');
        $query = $this->db->get();
        return $query->result();
    }
    function m_info_konf_byr($id_warga)
    {
        $this->db->select('*, COUNT(tagihan.status = 1) as bulan, SUM(lain_lain + nominal) as total');
        $this->db->from('tagihan');
        $this->db->join('transaksi', 'transaksi.code_tagihan = tagihan.code_tagihan');
        $this->db->where('tagihan.id_warga', $id_warga);
        $this->db->where('status', '1');
        // $this->db->group_by('tagihan.id_warga');
        // $this->db->order_by('tagihan.id_tagihan');
        $query = $this->db->get();
        return $query->result();
    }
    function m_tagihan_air($id_warga, $status)
    {

        $this->db->select('*');
        $this->db->from('tagihan');
        // $this->db->where_in('id_iuran', '1');
        $this->db->where('status', $status);
        $this->db->where('id_warga', $id_warga);
        // $this->db->where('code_tagihan', $code_tagihan);
        $query = $this->db->get();
        return $query->result();
    }
    function m_tagihan_warga($id_warga, $code_tagihan)
    {

        $this->db->select('*');
        $this->db->from('tagihan');
        // $this->db->where_in('id_iuran', '1');
        // $this->db->where('status', '0');
        $this->db->where('id_warga', $id_warga);
        $this->db->where('code_tagihan', $code_tagihan);
        $query = $this->db->get();
        return $query->result();
    }
    function m_upload_transaksi($data){
        $result = $this->db->insert('transaksi', $data);
        return $result;
    }

    function m_update_transaksi($code_tagihan, $foto_bukti)
    {
        $update = $this->db->set('foto_bukti', $foto_bukti)
            ->where('code_tagihan', $code_tagihan)
            // ->where('status', '0')
            ->update('transaksi');
        return $update;
    }

    function m_update_tagihan($code_tagihan, $status, $id_tagihan)
    {
        if (is_array($id_tagihan)) {
            $id_tagihan = implode(",", $id_tagihan);
        }

        $update = $this->db->set('code_tagihan', $code_tagihan)
            ->set('status', $status)
            ->where_in('id_tagihan', explode(",", $id_tagihan))
            ->update('tagihan');
        return $update;
    }


    // function m_update_tagihan($code_tagihan, $status, $id_tagihan)
    // {
    //     $update = $this->db->set('code_tagihan', $code_tagihan)
    //         ->set('status', $status)
    //         ->where_in('id_tagihan', explode(",", $id_tagihan))
    //         // ->where('status', '0')
    //         ->update('tagihan');
    //     return $update;
    // }

    function m_update_tagihan_pembayaran($code_tagihan, $status)
    {
        $update = $this->db->set('status', $status)
            ->where('code_tagihan', $code_tagihan)
            // ->where('status', '0')
            ->update('tagihan');
        return $update;
    }
    function m_update_tagihan_batal_pembayaran($code_tagihan, $status)
    {
        $update = $this->db->set('status', $status)
            ->set('code_tagihan', '')
            ->where('code_tagihan', $code_tagihan)
            // ->where('status', '0')
            ->update('tagihan');
        return $update;
    }

    function m_delete_transaksi($code_tagihan)
    {
        $delete = $this->db->where('code_tagihan', $code_tagihan);
        $this->db->delete('transaksi');
        return $delete;
    }
}