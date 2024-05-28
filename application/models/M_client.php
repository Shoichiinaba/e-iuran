<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_client extends CI_Model
{
    function m_biodata($id_warga)
    {
        $this->db->select('warga.id_warga, warga.id_perum, warga.id_rtrw, warga.nama,warga.no_rumah,warga.no_hp,warga.status_segel, perumahan.nama as nm_perum, rt-rw.rt,rt-rw.rw ');
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
        $query = $this->db->get();
        return $query->result();
    }
    function m_tagihan_air($id_warga, $status)
    {

        $this->db->select('*');
        $this->db->from('tagihan');
        $this->db->where('status', $status);
        $this->db->where('id_warga', $id_warga);
        $query = $this->db->get();
        return $query->result();
    }

    function m_bayar_tagihan_air($id_warga, $status)
    {

        $this->db->select('*');
        $this->db->from('tagihan');
        $this->db->where('status', $status);
        $this->db->where('id_warga', $id_warga);
        $query = $this->db->get();
        $q['result'] = $query->result();
        $q['num_rows'] = $query->num_rows();
        return $q;
    }

    function m_transaksi($id_warga, $status){

        $tagihan = $this->m_tagihan_air($id_warga, $status);
        if(count($tagihan) == 0){
            return null;
        }
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('code_tagihan', $tagihan[0]->code_tagihan);
        $query = $this->db->get();
        $result = $query->result();
        if(count($result) > 0){
            return $result;
        }
        return null;
    }

    function m_tagihan_warga($id_warga, $code_tagihan)
    {

        $this->db->select('*');
        $this->db->from('tagihan');
        $this->db->where('id_warga', $id_warga);
        $this->db->where('code_tagihan', $code_tagihan);
        $query = $this->db->get();
        return $query->result();
    }

    function m_upload_transaksi($data){
        $result = $this->db->insert('transaksi', $data);
        return $result;
    }

    function m_segel_saldo($segel_saldo){
        $result = $this->db->insert('segel_meteran', $segel_saldo);
        return $result;
    }

    function m_update_transaksi($code_tagihan, $foto_bukti)
    {
        $update = $this->db->set('foto_bukti', $foto_bukti)
            ->where('code_tagihan', $code_tagihan)
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

    function m_status_segel($id_warga)
    {
        $update = $this->db->set('status_segel', '2')
        ->where('id_warga', $id_warga)
        ->where('status_segel', '1')
        ->update('warga');
        return $update;
    }

    function m_pay($code_tagihan)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('warga', 'warga.id_warga = transaksi.id_warga');
        $this->db->where('transaksi.code_tagihan', $code_tagihan);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }


    function m_update_tagihan_pembayaran($code_tagihan, $status)
    {
        $update = $this->db->set('status', $status)
            ->where('code_tagihan', $code_tagihan)
            ->update('tagihan');
        return $update;
    }
    function m_update_tagihan_batal_pembayaran($code_tagihan, $status)
    {
        $update = $this->db->set('status', $status)
            ->set('code_tagihan', '')
            ->where('code_tagihan', $code_tagihan)
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