<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignOut extends CI_Controller {

	public function __construct(){

		 parent::__construct();

		$this->data = array();
		$this->data['title'] = 'iEdu';
		$this->data['successClass'] = 'display-none';
		$this->data['notifyClass'] = 'display-none';
		$this->data['warningClass'] = 'display-none';
		$this->data['failClass'] = 'display-none';
		$this->data['theMessage'] = $this->session->userdata('theMessage');
		$this->data['ApiKey'] = $this->config->item('apidetail')['ApiKey'];
		$this->data['base_url'] = $this->config->item('url')['baseUrl'];

		switch ($this->session->userdata('message')):
			case 'SUCCESS':
				$this->data['successClass'] = 'display-block';
				break;
			
			case 'FAIL':
				$this->data['failClass'] = 'display-block';
				break;

			case 'INFO':
				$this->data['notifyClass'] = 'display-block';
				break;
			
			case 'WARNING':
				$this->data['warningClass'] = 'display-block';
				break;
		endswitch;
	}

	public function index(){

		$this->data['header'] = 'header_inner';
		
		$this->session->unset_userdata('mydata');
		$this->session->unset_userdata('mytoken');
		$this->session->unset_userdata('fb_expire');
		$this->session->unset_userdata('fb_access_token');
		$this->session->set_userdata('message', 'SUCCESS');
		$this->session->set_userdata('theMessage', 'Successfully Sign Out.');
		
		redirect($this->data['base_url']);
	}
}
