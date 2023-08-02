<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	var $template = 'templates/index';

	public $session;
	public $form_validation;
	public $M_auth;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_auth');
	}

	// function login Warga
	public function index()
	{
		$session = $this->session->userdata('status');

		if ($session == '') {
			$this->load->view('warga/login');
		} else {
			redirect('Dashboard');
			// $role = $this->session->userdata('status')->role;
			// if ($role == 'Warga') {

			// } else {
			// 	redirect('Client_dash');
			// }
		}
	}

	public function client_login()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[2]|max_length[15]');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == TRUE) {
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);

			$data = $this->M_auth->m_client_login($username, $password);

			if ($data == false) {
				$this->session->set_flashdata('result_login', '<br>Email atau Password yang anda masukkan salah.');
				redirect('Auth');
			} else {
				$session = [
					'userdata' => $data,
					'status' => "Loged in"
				];
				$this->session->set_userdata($session);
				redirect('Dashboard');
			}
		} else {
			$this->session->set_flashdata('result_login', '<br>email Dan Password Harus Diisi.');
			redirect('Auth');
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('sukses', 'Anda Telah Keluar dari Aplikasi');
		redirect('Auth');
	}

	// function login Admin
	public function admin()
	{
		$session = $this->session->userdata('status');

		if ($session == '') {
			$this->load->view('page/login');
		} else {
			redirect('Dashboard');
		}
	}

	public function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[15]');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == TRUE) {
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);

			$data = $this->M_auth->login($username, $password);

			if ($data == false) {
				$this->session->set_flashdata('result_login', '<br>Email atau Password yang anda masukkan salah.');
				redirect('Auth');
			} else {
				$session = [
					'userdata' => $data,
					'status' => "Loged in"
				];
				$this->session->set_userdata($session);
				redirect('Dashboard');
			}
		} else {
			$this->session->set_flashdata('result_login', '<br>email Dan Password Harus Diisi.');
			redirect('Auth');
		}
	}
}
