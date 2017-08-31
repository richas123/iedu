<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

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
        $this->data['client_redirect_url'] = $this->config->item('url')['baseUrl'];

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

		if($this->session->userdata('mydata')['user_id']):

	        $this->data['myCourse'] = $this->session->userdata('myCourse');
	    	$this->RefreshToken();
		else:
			
			$this->data['myCourse'] = array();
		endif;

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

		if($this->facebook->is_authenticated()):
			
			// do nothing
		else:
			$this->data['fblink'] = $this->facebook->login_url();
		endif;
	}

	public function index(){

		$this->data['header'] = 'header_inner';
		$this->data['page'] = 'Search';

		$fields = array(
			'query' => $_POST['top-search'],
			'limit' => 20,
			'offset' => 0
		);
		
		$data = json_encode($fields);
		$ch = curl_init();

		if($this->session->userdata('mydata')['user_id']):
			
			$headers = array(
			   'Content-Type: application/json',
			   'AccessToken :'.$this->session->userdata('mytoken')['accesstoken']
			);
			curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/courses/websearch?query=".urlencode($_POST['top-search'])."&limit=20&offset=0");
		else:
			$headers = array(
			   'Content-Type: application/json',
			   'ApiKey :'.$this->data['ApiKey']
			);
			curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/previewcourses/websearch?query=".urlencode($_POST['top-search'])."&limit=20&offset=0");
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

				$this->data['courseDetail'] = $apidata->data->courses;
				break;

			case 1003:

				$this->session->set_userdata('message', 'WARNING');
				$this->session->set_userdata('theMessage', 'Access Token expired');
				redirect($this->data['base_url']);
				break;
			
			default:

				$this->session->set_userdata('message', 'WARNING');
				$this->session->set_userdata('theMessage', 'Something went wrong.');
				redirect($this->data['base_url']);
				break;
		}	

		$this->load->view('layout/app', $this->data);
	}

	public function Search(){

		$fields = array(
			'query' => $this->input->post('value'),
			'limit' => 20,
			'offset' => $this->input->post('offset')
		);
		
		$data = json_encode($fields);
		$ch = curl_init();

		if($this->session->userdata('mydata')['user_id']):
			
			$headers = array(
			   'Content-Type: application/json',
			   'AccessToken :'.$this->session->userdata('mytoken')['accesstoken']
			);
			curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/courses/websearch?query=".$this->input->post('value')."&limit=20&offset=".$this->input->post('offset'));
		else:
			$headers = array(
			   'Content-Type: application/json',
			   'ApiKey :'.$this->data['ApiKey']
			);
			curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/previewcourses/websearch?query=".$this->input->post('value')."&limit=20&offset=".$this->input->post('offset'));
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

				$this->data['courseDetail'] = $apidata->data->courses;
				break;

			default:

				$this->data['courseDetail'] = array();
				break;
		}

		$this->load->view('SearchListing', $this->data);
	}

	public function RefreshToken(){

		if($this->session->userdata('mytoken')['refreshtoken'] != ''):
			$value = RefreshToken($this->session->userdata('mytoken')['refreshtoken'], $this->data['ApiKey'], $this->data['api_url']);
			$this->session->set_userdata('mytoken', array('accesstoken' => $value['accesstoken'], 'refreshtoken' => $value['refreshtoken']));
		endif;
	}
}
