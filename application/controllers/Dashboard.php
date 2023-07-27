<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends AUTH_Controller
{
    var $template = 'templates/index';

	public function __construct()
    {
        parent::__construct();

    }

	public function index()
	{
        $data['userdata'] 		= $this->userdata;
        $data['content']        = 'page/dashboard_v';
        $this->load->view($this->template, $data);
    }

}