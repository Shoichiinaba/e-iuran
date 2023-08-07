<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_adm extends AUTH_Controller {
	var $template = 'templates/index';

	public function __construct() {
		parent::__construct();
		$this->load->model('M_admin');
	}

	function index() {
		$data['userdata'] 		= $this->userdata;
		$data['content'] 		= "page/profile";
        $this->load->view($this->template, $data);
	}

	public function update() {
		$this->form_validation->set_rules('username', 'Usernane', 'trim');
		$this->form_validation->set_rules('nama', 'Nama', 'trim');

		$id = $this->userdata->id;
		$data = $this->input->post('');
		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/images/user/';
			$config['allowed_types'] = 'png|jpg';
			$config['max_size'] = 2048;
			$config['file_name'] = uniqid();

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('foto')){
				$error = array('gagal' => $this->upload->display_errors());
			}
			else{
				$data_foto = $this->upload->data();
				$data['foto'] = $data_foto['file_name'];
			}

			$oldImage = $this->M_admin->getFotoById_adm($id);
			$result = $this->M_admin->update_adm($data, $id);

			if ($result > 0) {
                if (!empty($oldImage)) {
                    $oldImagePath = './assets/images/user/' . $oldImage;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $this->updateProfil_adm();
                $this->session->set_flashdata('sukses', "Berhasil diubah");
                redirect('Profile_adm');
            } else {
                $this->session->set_flashdata('gagal', "Profile Gagal diubah");
                redirect('Profile_adm');
            }

		} else {
			$this->session->set_flashdata('gagal',(validation_errors()));
			redirect('Profile_adm');
		}
	}

	public function ubah_password() {
		$this->form_validation->set_rules('passLama', 'Password Lama', 'trim|required');
		$this->form_validation->set_rules('passBaru', 'Password Baru', 'trim|required');
		$this->form_validation->set_rules('passKonf', 'Password Konfirmasi', 'trim|required');

		$id = $this->userdata->id;
		if ($this->form_validation->run() == TRUE) {
			if (md5($this->input->post('passLama')) == $this->userdata->password) {
				if ($this->input->post('passBaru') != $this->input->post('passKonf')) {
					$this->session->set_flashdata('pas',"Password Baru dan Konfirmasi Password harus sama");
					redirect('Profile_adm');
				} else {
					$data = [
						'password' => md5($this->input->post('passBaru'))
					];

					$result = $this->M_admin->update_adm($data, $id);
					if ($result > 0) {
						$this->updateProfil_adm();
						$this->session->set_flashdata('sukses',"Berhasil diubah");
						redirect('Profile_adm');
					} else {
						$this->session->set_flashdata('gagal', "Password Gagal diubah");
						redirect('Profile_adm');
					}
				}
			} else {
				$this->session->set_flashdata('gagal', "Password Salah");
				redirect('Profile_adm');
			}
		} else {
			$this->session->set_flashdata('error',(validation_errors()));
			redirect('Profile_adm');
		}
	}

}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */