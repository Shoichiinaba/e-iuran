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
}