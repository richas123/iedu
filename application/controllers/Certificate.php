<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificate extends CI_Controller {

	public function __construct(){

		 parent::__construct();

		$this->data = array();
		$this->data['title'] = 'iEdu';
		$this->data['base_url'] = $this->config->item('url')['baseUrl'];
	}

	public function index(){
		
		$this->data['header'] = 'header_inner';
		$this->load->view('Certificate', $this->data);
	}
}
