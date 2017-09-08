<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EnrollCourse extends CI_Controller {

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

	public function Course(){

		if(!$this->session->userdata('mydata')['user_id']):
			$this->session->set_userdata('message', 'INFO');
			$this->session->set_userdata('theMessage', 'Please sign in first');
			redirect($this->data['base_url'].'/'.$this->uri->segment(1));
		endif;

		$this->data['header'] = 'header_inner';
		$this->data['page'] = 'EnrollCourse';

		$getArr = explode('-', $this->uri->segment(3));
		$getId = $getArr[count($getArr)-1];

		$fields = array(
			'course_id' => $getId
		);
		
		$data = json_encode($fields);	

		$ch = curl_init();
		$headers = array(
		   'Content-Type: application/json',
		   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
		);
		curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/course/subscribe");
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, false);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$data = curl_exec($ch);
		curl_close($ch);

		$apidata = json_decode($data);
		
		if($apidata->response_code == 1000):

			$this->session->set_userdata('message', 'SUCCESS');
			$this->session->set_userdata('theMessage', 'Successfully Enrolled.');
			
			$fields = array(
				'course_id' => $getId
			);
			
			$data = json_encode($fields);

			$ch = curl_init();
			$headers = array(
			   'Content-Type: application/json',
			   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
			);
			curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/coursedetail?course_id=".$getId);
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

					$this->data['courseDesc'] = $apidata->data->coursedetails;
					$this->data['displaymsg'] = 'Successfully enrolled';
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
		else:
			$this->data['displaymsg'] = 'Not enrolled';
		endif;

		$this->load->view('layout/app', $this->data);
	}

	public function unroll(){

		$fields = array(
			'course_id' => $this->input->post('course_id')
		);
		
		$data = json_encode($fields);	

		$ch = curl_init();
		$headers = array(
		   'Content-Type: application/json',
		   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
		);
		curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/course/unsubscribe");
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, false);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$data = curl_exec($ch);
		curl_close($ch);

		$apidata = json_decode($data);
		
		if($apidata->response_code == 1000):

			$this->session->set_userdata('message', 'SUCCESS');
			$this->session->set_userdata('theMessage', 'Successfully removed.');
		else:

			$this->session->set_userdata('message', 'WARNING');
			$this->session->set_userdata('theMessage', 'Something went Wrong.');
		endif;

	}

	public function RefreshToken(){

		$value = RefreshToken($this->session->userdata('mytoken')['refreshtoken'], $this->data['ApiKey'], $this->data['api_url']);
		$this->session->set_userdata('mytoken', array('accesstoken' => $value['accesstoken'], 'refreshtoken' => $value['refreshtoken']));
	}
}
