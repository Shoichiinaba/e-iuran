<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model
{

    public function jumlah_blm( $id)
	{
		$this->db->select('tagihan.status, COUNT(*) as jumlah_record');
		$this->db->from('tagihan');
		$this->db->where('tagihan.status', 0);
        $this->db->where('id_rtrw', $id);
    	return $this->db->count_all_results();
	}

    public function jumlah_app( $id)
	{
		$this->db->select('tagihan.status, COUNT(*) as jumlah_record');
		$this->db->from('tagihan');
		$this->db->where('tagihan.status', 1);
        $this->db->where('id_rtrw', $id);
    	return $this->db->count_all_results();
	}

    public function jumlah_lnas( $id)
	{
		$this->db->select('tagihan.status, COUNT(*) as jumlah_record');
		$this->db->from('tagihan');
		$this->db->where('tagihan.status', 2);
        $this->db->where('id_rtrw', $id);
    	return $this->db->count_all_results();
	}

    public function jumlah_warga( $id)
	{
		$this->db->select('warga.id_warga, COUNT(*) as jumlah_record');
		$this->db->from('warga');
        $this->db->where('id_rtrw', $id);
    	return $this->db->count_all_results();
	}

	public function saldo($id)
	{
		$this->db->select('*');
		$this->db->from('saldo');
        $this->db->where('id_rtrw', $id);
		$query = $this->db->get();
        return $query->result();
	}

// notif warga sudah melakukan upload bukti tf
	public function jumlah_byr( $id_rtrw)
	{
		$this->db->select('tagihan.status, COUNT(*) as jumlah_record');
		$this->db->from('tagihan');
		$this->db->where('tagihan.status', 1);
        $this->db->where('id_rtrw', $id_rtrw);
    	return $this->db->count_all_results();
	}
// notif warga sudah melakukan upload bukti tf

}