<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyCourses extends CI_Controller {

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

        $ch = curl_init();
		$headers = array(
		   'Content-Type: application/json',
		   'ApiKey: '.$this->data['ApiKey']
		);
		curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/application/settings");
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, false);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, false);
		$data = curl_exec($ch);
		curl_close($ch);

		$apidata = json_decode($data);

		if($apidata->response_code == 1000):

			$this->data['android_url'] = $apidata->data->library->android_url;
			$this->data['ios_url'] = $apidata->data->library->ios_url;
		else:
			
			$this->data['android_url'] = '';
			$this->data['ios_url'] = '';
		endif;

		if($this->session->userdata('mydata')['user_id']):

	        $this->data['myCourse'] = $this->session->userdata('myCourse');
	    	$this->RefreshToken();
		else:
			
			$this->data['myCourse'] = array();
			redirect($this->data['base_url']);
		endif;
	}

	public function index(){		

		$this->data['header'] = 'header_inner';
		$this->data['page'] = 'MyCourses';

		$fields = array(
			'limit' => 20,
			'offset' => 0
		);
		
		$data = json_encode($fields);

		$ch = curl_init();
		$headers = array(
		   'Content-Type: application/json',
		   'ApiKey: '.$this->data['ApiKey'],
		   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
		);

		curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/websubscriptions?limit=20&offset=0");
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
			
			case 1003:
				$this->session->set_userdata('message', 'WARNING');
				$this->session->set_userdata('theMessage', 'Access Token expired');
				redirect($this->data['base_url'].'/Start');
				break;
			
			default:
				$this->session->set_userdata('message', 'WARNING');
				$this->session->set_userdata('theMessage', 'Something went wrong.');
				redirect($this->data['base_url'].'/Start');
				break;
		}
		
		$this->load->view('layout/app', $this->data);
	}

	public function RefreshToken(){

		if($this->session->userdata('mytoken')['refreshtoken'] != ''):
			$value = RefreshToken($this->session->userdata('mytoken')['refreshtoken'], $this->data['ApiKey'], $this->data['api_url']);
			$this->session->set_userdata('mytoken', array('accesstoken' => $value['accesstoken'], 'refreshtoken' => $value['refreshtoken']));
		endif;
	}
}
