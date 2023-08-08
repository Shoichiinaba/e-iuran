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

}