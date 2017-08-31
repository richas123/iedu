<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {

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

	public function Course(){

		$this->data['header'] = 'header_inner';

		if($this->uri->segment(4)):

			$assArr = explode('-', $this->uri->segment(4));
			$assId = $assArr[count($assArr)-1];

			$fields = array(
				'subsection_id' => $assId
			);
			
			$data = json_encode($fields);
			$ch = curl_init();

			$headers = array(
			   'Content-Type: application/json',
			   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
			);
			curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/assignments?subsection_id=".$assId);

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

					$this->data['assignments'] = $apidata->data->assignments;

					if($this->uri->segment(5)):

						$asstArr = explode('-', $this->uri->segment(5));
						$asstId = $asstArr[count($asstArr)-1];
					else:

						$asstId = $apidata->data->assignments[0]->assignment_id;
					endif;

					$fields = array(
						'assignment_id' => $asstId
					);
					
					$data = json_encode($fields);
					$ch = curl_init();

					$headers = array(
					   'Content-Type: application/json',
					   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
					);
					curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/assignment?assignment_id=".$assId);

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

					$this->data['assignment'] = $apidata->data->assignment;
					if(isset($this->data['assignment']->total_marks)):
						$this->data['assignment']->per_que_mark = $this->data['assignment']->total_marks/$this->data['assignment']->show_questions;
						
						$dec = 	$this->data['assignment']->duration/$this->data['assignment']->show_questions;
						$seconds = $dec * 60;
						if($seconds > 59):							
							$minutes = (int)($seconds / 60);
							$rems = $seconds % 60;							
							if($rems == 0):
								$seconds = '00';
							else:
								$seconds = $rems;
							endif;
						else:
							$minutes = '00';
						endif;
						
						$this->data['assignment']->per_que_duration = $minutes.':'.$seconds;
					endif;

					$assArr = explode('-', $this->uri->segment(4));
					$assId = $assArr[count($assArr)-1];

					$fields = array(
						'assignment_id' => $asstId
					);
					
					$data = json_encode($fields);
					$ch = curl_init();

					$headers = array(
					   'Content-Type: application/json',
					   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
					);
					curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/assignment/status");

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

			$catArr = explode('-', $this->uri->segment(2));
			$catId = $catArr[count($catArr)-1];

			if($this->uri->segment(3)):

				$getArr = explode('-', $this->uri->segment(3));
				$getId = $getArr[count($getArr)-1];

				$fields = array(
					'course_id' => $getId
				);
			else:
				
				$fields = array(
					'limit' => 20,
					'offset' => 0,
					'category_id' => $catId
				);
			endif;
			
			$data = json_encode($fields);
			$ch = curl_init();

			if($this->uri->segment(3)):

				if($this->session->userdata('mydata')['user_id']):
					
					$headers = array(
					   'Content-Type: application/json',
					   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
					);
					curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/coursedetail?course_id=".$getId);
				else:
					$headers = array(
					   'Content-Type: application/json',
					      'ApiKey: '.$this->data['ApiKey']
					);
					curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/preview/webcourse?course_id=".$getId);
				endif;
			else:

				if($this->session->userdata('mydata')['user_id']):
					
					$fields['AccessToken'] = $this->session->userdata('mytoken')['accesstoken'];
					$headers = array(
					   'Content-Type: application/json',
					   'ApiKey: '.$this->data['ApiKey'],
					   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
					);
					curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/courses?limit=10&offset=0&category_id=".$catId);
				else:
					$headers = array(
					   'Content-Type: application/json',
					   'ApiKey: '.$this->data['ApiKey']
					);
					curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/preview_courses?limit=20&offset=0&category_id=".$catId);
				endif;
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

					if($this->uri->segment(3)):
						$this->data['courseDesc'] = $apidata->data->coursedetails;
						$this->data['courseDetail'] = $apidata->data->sections;

						$ch = curl_init();
						$headers = array(
						   'Content-Type: application/json',
						   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
						);
						curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/user/payment");
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

							$this->data['master_subscription'] = $apidata->message->has_master_subscription;
						else:

							$this->data['master_subscription'] = 0;
						endif;
						
					else:
						$this->data['course'] = $apidata->data->courses;
					endif;
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
		endif;

		if($this->uri->segment(4)):
			$this->data['page'] = 'assignment';
		else:
			if($this->uri->segment(3)):
				$this->data['page'] = 'CourseDetail';
			else:
				$this->data['page'] = 'Course';
			endif;
		endif;
		
		$this->load->view('layout/app', $this->data);
	}

	public function Leaderboard(){

		$this->data['header'] = 'header_inner';
		$this->data['page'] = 'LeaderBoard';

		$catArr = explode('-', $this->uri->segment(2));
		$catId = $catArr[count($catArr)-1];

		if($this->session->userdata('mydata')['user_id']):
			// do nothing
		else:
			$this->session->set_userdata('message', 'INFO');
			$this->session->set_userdata('theMessage', 'Please sign in first');
			redirect($this->data['base_url'].'/Courses/'.$this->uri->segment(2));
		endif;

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
				$this->data['courseDetail'] = $apidata->data->sections;

				$fields = array(
					'course_id' => $getId
				);
				
				$data = json_encode($fields);
				$ch = curl_init();

				$headers = array(
				   'Content-Type: application/json',
				   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
				);

				curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/course/leaderboard?course_id=".$getId);

				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_HEADER, false);

				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, false);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				$data = curl_exec($ch);
				curl_close($ch);

				$apidataLead = json_decode($data);
				$this->data['leaderboard'] = $apidataLead->data->leaderboard;
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

	public function RefreshToken(){

		if($this->session->userdata('mytoken')['refreshtoken'] != ''):
			$value = RefreshToken($this->session->userdata('mytoken')['refreshtoken'], $this->data['ApiKey'], $this->data['api_url']);
			$this->session->set_userdata('mytoken', array('accesstoken' => $value['accesstoken'], 'refreshtoken' => $value['refreshtoken']));
		endif;
	}
}
