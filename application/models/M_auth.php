<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{

	public function m_client_login($username, $password)
	{
		$this->db->select('*');
		$this->db->from('warga');
		$this->db->where('no_rumah', $username);
		$this->db->where(
			'password',
			md5($password)
		);

		$data = $this->db->get();

		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			return false;
		}
	}
	public function login($user, $pass)
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('username', $user);
		$this->db->where(
			'password',
			md5($pass)
		);

		$data = $this->db->get();

		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			return false;
		}
	}
}

/* End of file M_auth.php */
/* Location: ./application/models/M_auth.php */