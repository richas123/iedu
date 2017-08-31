<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paging extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->data = array();
		$this->data['title'] = 'iEdu';
		$this->data['successClass'] = 'display-none';
		$this->data['notifyClass'] = 'display-none';
		$this->data['warningClass'] = 'display-none';
		$this->data['failClass'] = 'display-none';
		$this->data['theMessage'] = $this->session->userdata('theMessage');
		$this->data['api_url'] = $this->config->item('apidetail')['ApiUrl'];
		$this->data['ApiKey'] = $this->config->item('apidetail')['ApiKey'];
		$this->data['client_id'] = $this->config->item('glogdetail')['client_id'];
		$this->data['catlink'] = $this->config->item('cat-link');
		$this->data['fblink'] = '';
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
		
        if($this->facebook->is_authenticated()):
			
			// do nothing
		else:
			$this->data['fblink'] = $this->facebook->login_url();
		endif;

		if($this->session->userdata('mydata')['user_id']):
			$this->RefreshToken();
		endif;
	}

	public function Paging(){
		
		$cats = explode("-", $this->uri->segment(3));		
		$catId = $cats[count($cats)-1];

		$fields = array(
			'limit' => 20,
			'offset' => $this->input->post('offset'),
			'category_id' => $catId
		);

		$data = json_encode($fields);
		$ch = curl_init();

		if($this->session->userdata('mydata')['user_id']):

			$fields['AccessToken'] = $this->session->userdata('mytoken')['accesstoken'];
			$headers = array(
			   'Content-Type: application/json',
			   'ApiKey: '.$this->data['ApiKey'],
			   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken'].''
			);
			curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/courses?limit=20&offset=".$this->input->post('offset')."&category_id=".$catId);
		else:
			$headers = array(
			   'Content-Type: application/json',
			   'ApiKey: '.$this->data['ApiKey']
			);
			curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/preview_courses?limit=20&offset=".$this->input->post('offset')."&category_id=".$catId);
		endif;

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, false);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$data = curl_exec($ch);
		curl_close($ch);

		$apidata = json_decode($data);
		
		switch ($apidata->response_code) {

			case 1000:
				$this->data['course'] = $apidata->data->courses;
				break;

			default:
				$this->data['course'] = array();
				break;
		}

		$this->load->view('Listing', $this->data);
	}

	public function mycourse(){

		$fields = array(
			'limit' => 20,
			'offset' => $this->input->post('offset')
		);
		
		$data = json_encode($fields);

		$ch = curl_init();
		$headers = array(
		   'Content-Type: application/json',
		   'ApiKey: '.$this->data['ApiKey'],
		   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
		);

		curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/websubscriptions?limit=20&offset=".$this->input->post('offset'));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, false);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$data = curl_exec($ch);
		curl_close($ch);

		$apidata = json_decode($data);
		
		switch ($apidata->response_code) {
			case 1000:
				$this->data['theCourse'] = $apidata->data->subscriptions;
				break;
			
			default:
				$this->data['theCourse'] = array();
				break;
		}

		$this->load->view('MyListing', $this->data);
	}

	public function RefreshToken(){

		if($this->session->userdata('mytoken')['refreshtoken'] != ''):
			$value = RefreshToken($this->session->userdata('mytoken')['refreshtoken'], $this->data['ApiKey'], $this->data['api_url']);
			$this->session->set_userdata('mytoken', array('accesstoken' => $value['accesstoken'], 'refreshtoken' => $value['refreshtoken']));
		endif;
	}
}
