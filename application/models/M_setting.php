<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_setting extends CI_Model
{

	public function get_key()
	{
		$this->db->select('*');
		$this->db->from('pengaturan');
		$query = $this->db->get();
		return $query->result();
	}

	public function add_key($data) {
        if (!empty($data)) {
            $this->db->insert_batch('pengaturan', $data);
            return $this->db->affected_rows();
        }
        return 0;
    }

	public function update_key($id,$troop_)
	{
		$this->db->where('id', $id);
        $this->db->update('pengaturan', $troop_);
	}

	function hapus_api($params ='')
    {
        $sql = "DELETE  FROM pengaturan WHERE id = ? ";
        return $this->db->query($sql, $params);
    }

}