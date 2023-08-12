<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {
	var $template = 'templates/index';

	public function __construct() {
		parent::__construct();
	}

	function index() {
		// $data['userdata'] 		= $this->userdata;
		// $data['content'] 		= "warga/profile";
        $this->load->view('warga/index.php');
	}


}