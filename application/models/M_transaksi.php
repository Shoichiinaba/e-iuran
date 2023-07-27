<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model
{

    public function get_warga($id)
    {
        $this->db->select('id_warga, nama, id_rtrw, no_rumah');
        $this->db->from('warga');
        $this->db->where('id_rtrw', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_iuran($id)
    {
        $this->db->select('id_iuran, nama_iuran, id_rtrw, nominal, perawatan, abunament');
        $this->db->from('iuran');
        $this->db->where('id_rtrw', $id);
        $this->db->where('id_iuran', 3);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_meter()
    {
        $this->db->select('id_tagihan, id_warga, kubik_in');
        $this->db->from('tagihan');
        // $this->db->where('id_warga', $id_warga);
        $query = $this->db->get();
        return $query->result();
    }

}