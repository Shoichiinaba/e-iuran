<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
	public function update($data, $id)
	{
		$this->db->where("id_warga", $id);
		$this->db->set($data);
		$this->db->update("warga", $data);
		return $this->db->affected_rows();
	}
	public function update_adm($data, $id)
	{
		$this->db->where("id", $id);
		$this->db->set($data);
		$this->db->update("admin", $data);
		return $this->db->affected_rows();
	}

	// Update Profil
	public function select($id = '')
	{
		if ($id != '') {
			$this->db->where('id_warga', $id);
		}

		$data = $this->db->get('warga');

		return $data->row();
	}

	public function select1($id = '')
	{
		if ($id != '') {
			$this->db->where('id', $id);
		}

		$data = $this->db->get('admin');

		return $data->row();
	}

	public function getFotoById($id) {
        $this->db->select('foto');
        $this->db->from('warga');
        $this->db->where('id_warga', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->foto;
        } else {
            return null;
        }
    }

	public function getFotoById_adm($id) {
        $this->db->select('foto');
        $this->db->from('admin');
        $this->db->where('id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->foto;
        } else {
            return null;
        }
    }

}



/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */