<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
	public function update($data, $id)
	{
		$this->db->where("id", $id);
		$this->db->update("admin", $data);

		return $this->db->affected_rows();
	}
	// Update Profil
	public function select($id = '')
	{
		if ($id != '') {
			$this->db->where('id', $id);
		}

		$data = $this->db->get('admin');

		return $data->row();
	}

	function hapus($params = '')
	{
		$sql = "DELETE  FROM admin WHERE id = ? ";
		return $this->db->query($sql, $params);
	}

	function get_data_admin()
	{
		return $this->db->get('admin')->result();
	}

	function m_perumahan($id, $role)
	{
		if ($role == 'Admin') {
			$this->db->select('*');
			$this->db->from('perumahan');
			$query = $this->db->get();
			return $query->result();
		} else if ($role == 'Marketing') {

			$this->db->select('*');
			$this->db->from('marketing_perum');
			$this->db->Join('admin', 'admin.id = marketing_perum.id_admin_marketing');
			$this->db->Join('perumahan', 'perumahan.id_perum = marketing_perum.id_perum_marketing');
			$this->db->where('id', $id);
			$query = $this->db->get();
			return $query->result();
		}
	}

}



/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */