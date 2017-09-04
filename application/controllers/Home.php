<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$this->data['client_secret'] = $this->config->item('glogdetail')['client_secret'];
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

		if($this->session->userdata('mydata')['user_id']):
	        $this->RefreshToken();
		endif;
	}

	public function index(){
		
		if(isset($_GET['code'])):

			if(isset($_GET['state'])):

				if($this->facebook->is_authenticated()):
										
					$userfb = $this->facebook->request('get', '/me?fields=id,name,email,picture,first_name,last_name', [], $this->session->userdata('fb_access_token'));						
					$fields = array(
						'email_id' => $userfb['email'],
						'first_name' => $userfb['first_name'],
						'last_name' => $userfb['last_name'],
						'image_url' => $userfb['picture']['data']['url']
					);

					$data = json_encode($fields);	
					$ch = curl_init();
					$headers = array(
					   'Content-Type: application/json',
					   'ApiKey: '.$this->data['ApiKey'],
					   'FacebookToken: '.$this->session->userdata('fb_access_token')
					);
					curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/user/facebook/signin");
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
						$this->session->set_userdata('theMessage', 'Successfully Sign In.');

						$signdata['mydata'] = array(
			               'user_id'  => $apidata->data->user->user_id,
			               'first_name'  => $apidata->data->user->first_name,
			               'last_name'  => $apidata->data->user->last_name,
			               'image_id'  => $apidata->data->user->image_id,
			               'image_url'  => $apidata->data->user->image_url,
			               'email_id'  => $apidata->data->user->email_id,
			               'role_id'  => $apidata->data->user->role_id,
			               'role_title'  => $apidata->data->user->role_title,
			            );
			            $signdata['mytoken'] = array(
			               'accesstoken'  => $apidata->data->user->accesstoken,
			               'refreshtoken'  => $apidata->data->user->refreshtoken
			           	);
						$this->session->set_userdata($signdata);

						$fields = array(
							'limit' => 10,
							'offset' => 0
						);
						
						$data = json_encode($fields);

						$ch = curl_init();
						$headers = array(
						   'Content-Type: application/json',
						   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
						);
						curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/notifications?limit=10&offset=0");
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
						$this->session->set_userdata('notifys', $apidata->data->unread_totalnotifications);

						$fields = array(
							'limit' => 10,
							'offset' => 0
						);
						
						$data = json_encode($fields);

						$ch = curl_init();
						$headers = array(
						   'Content-Type: application/json',
						   'ApiKey: '.$this->data['ApiKey'],
						   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
						);

						curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/websubscriptions?limit=10&offset=0");
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
						if($apidata->response_code == 1000):
							$this->data['myCourse'] = $apidata->data->subscriptions;			
							
							if(count($this->data['myCourse']) > 3):
								$ct = 3;
							else:
								$ct = count($this->data['myCourse']);
							endif;
							
							for($z=0;$z<$ct;$z++):					
								$this->data['myCourse'][$z]->url = 'courses/'.strtolower(str_replace(' ', '-', trim($this->data['myCourse'][$z]->category_title))).'-'.$this->data['myCourse'][$z]->category_id.'/'.strtolower(str_replace(' ', '-', trim($this->data['myCourse'][$z]->title))).'-'.$this->data['myCourse'][$z]->course_id;
							endfor;	
						else:
							$this->data['myCourse'] = array();
						endif;
						$this->session->set_userdata('myCourse', $this->data['myCourse']);
						redirect($this->data['base_url']);
					else:
						$this->session->set_userdata('message', 'FAIL');
						$this->session->set_userdata('theMessage', 'Invalid Sign In credentials.');			
					endif;					
				else:						

					$this->data['fblink'] = $this->facebook->login_url();
				endif;

				$this->data['header'] = 'header';
				$this->data['page'] = 'home';				

				$fields = array(
					'limit' => 10,
					'offset' => 0
				);
				
				$data = json_encode($fields);
				$ch = curl_init();		
				if($this->session->userdata('mydata')['user_id']):
					
					$headers = array(
					   'Content-Type: application/json',
					   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
					);
					curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/webcategoriesdetail?limit=10&offset=0");
				else:
					
					$headers = array(
					   'Content-Type: application/json',
					   'ApiKey: '.$this->data['ApiKey']
					);
					curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/preview/webcategoriesdetail?limit=10&offset=0");
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
				
				$this->data['categories'] = $apidata->data->category;

				for($z=0;$z<count($this->data['categories']);$z++):
					switch ($this->data['categories'][$z]->category_id) {
						case 4:
							$this->data['profession'][0] = $this->data['categories'][$z]->courses[0];
							break;

						case 5:
							$this->data['school'][0] = $this->data['categories'][$z]->courses[0];
							break;

						case 6:
							$this->data['college'][0] = $this->data['categories'][$z]->courses[0];
							break;

						case 8:
							$this->data['language'][0] = $this->data['categories'][$z]->courses[0];
							break;

						case 33:
							$this->data['profession'][0] = $this->data['categories'][$z]->courses[0];
							break;

						case 35:
							$this->data['school'][0] = $this->data['categories'][$z]->courses[0];
							break;

						case 34:
							$this->data['college'][0] = $this->data['categories'][$z]->courses[0];
							break;

						case 36:
							$this->data['language'][0] = $this->data['categories'][$z]->courses[0];
							break;
						
						default:
							# code...
							break;
					}
				endfor;
				$this->load->view('layout/app', $this->data);
			else:

				$this->GetAccessToken($this->data['client_id'], $this->data['client_redirect_url'], $this->data['client_secret'], $_GET['code']);
			endif;
		else:

			$this->data['header'] = 'header';
			$this->data['page'] = 'home';

			$fields = array(
				'limit' => 10,
				'offset' => 0
			);
			
			$data = json_encode($fields);
			$ch = curl_init();		
			if($this->session->userdata('mydata')['user_id']):
				
				$headers = array(
				   'Content-Type: application/json',
				   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
				);
				curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/webcategoriesdetail?limit=10&offset=0");
			else:
				
				$headers = array(
				   'Content-Type: application/json',
				   'ApiKey: '.$this->data['ApiKey']
				);
				curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/preview/webcategoriesdetail?limit=10&offset=0");
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
			
			$this->data['categories'] = $apidata->data->category;

			for($z=0;$z<count($this->data['categories']);$z++):
				switch ($this->data['categories'][$z]->category_id) {
					case 4:
						$this->data['profession'][0] = $this->data['categories'][$z]->courses[0];
						break;

					case 5:
						$this->data['school'][0] = $this->data['categories'][$z]->courses[0];
						break;

					case 6:
						$this->data['college'][0] = $this->data['categories'][$z]->courses[0];
						break;

					case 8:
						$this->data['language'][0] = $this->data['categories'][$z]->courses[0];
						break;

					case 33:
						$this->data['profession'][0] = $this->data['categories'][$z]->courses[0];
						break;

					case 35:
						$this->data['school'][0] = $this->data['categories'][$z]->courses[0];
						break;

					case 34:
						$this->data['college'][0] = $this->data['categories'][$z]->courses[0];
						break;

					case 36:
						$this->data['language'][0] = $this->data['categories'][$z]->courses[0];
						break;
					
					default:
						# code...
						break;
				}
			endfor;

			$this->load->view('layout/app', $this->data);
		 endif;
	}

	public function login(){
		$this->load->view('sign-in', $this->data);
	}

	public function logup(){
		$this->load->view('sign-up', $this->data);
	}

	public function forPass(){
		$this->load->view('forget-password', $this->data);
	}

	public function signup(){
		
		$fields = array(
			'first_name' => $_POST['first_name'],
			'last_name' => $_POST['last_name'],			
			'email_id' => $_POST['email_id'],
			'password' => $_POST['password']
		);

		$data = json_encode($fields);

		$ch = curl_init();
		$headers = array(
		   'Content-Type: application/json',
		   'ApiKey: '.$this->data['ApiKey']
		);
		curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/user/signup");
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$data = curl_exec($ch);
		curl_close($ch);

		$apidata = json_decode($data);

		switch ($apidata->response_code) {
			case 1000: echo true;
				//$this->session->set_userdata('message', 'SUCCESS');
				//$this->session->set_userdata('theMessage', 'Successfully Sign Up.');

				$fields = array(
					'email_id' => $_POST['email_id'],
					'password' => $_POST['password'],
					'keep_login' => 1
				);
				
				$data = json_encode($fields);

				$ch = curl_init();
				$headers = array(
				   'Content-Type: application/json',
				   'ApiKey: '.$this->data['ApiKey']
				);
				curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/user/signin");
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				$data = curl_exec($ch);
				curl_close($ch);

				$apidata = json_decode($data);

				if($apidata->response_code == 1000):			
						
					$signdata['mydata'] = array(
		               'user_id'  => $apidata->data->user->user_id,
		               'first_name'  => $apidata->data->user->first_name,
		               'last_name'  => $apidata->data->user->last_name,
		               'image_id'  => $apidata->data->user->image_id,
		               'image_url'  => $apidata->data->user->image_url,
		               'email_id'  => $apidata->data->user->email_id,
		               'role_id'  => $apidata->data->user->role_id,
		               'role_title'  => $apidata->data->user->role_title,
		            );
		            $signdata['mytoken'] = array(
		               'accesstoken'  => $apidata->data->user->accesstoken,
		               'refreshtoken'  => $apidata->data->user->refreshtoken
		           	);
					$this->session->set_userdata($signdata);

					$fields = array(
						'limit' => 10,
						'offset' => 0
					);
					
					$data = json_encode($fields);

					$ch = curl_init();
					$headers = array(
					   'Content-Type: application/json',
					   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
					);
					curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/notifications?limit=10&offset=0");
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
					$this->session->set_userdata('notifys', $apidata->data->unread_totalnotifications);

					$fields = array(
						'limit' => 10,
						'offset' => 0
					);
					
					$data = json_encode($fields);

					$ch = curl_init();
					$headers = array(
					   'Content-Type: application/json',
					   'ApiKey: '.$this->data['ApiKey'],
					   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
					);

					curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/websubscriptions?limit=10&offset=0");
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
					if($apidata->response_code == 1000):
						$this->data['myCourse'] = $apidata->data->subscriptions;			
						
						if(count($this->data['myCourse']) > 3):
							$ct = 3;
						else:
							$ct = count($this->data['myCourse']);
						endif;
						
						for($z=0;$z<$ct;$z++):					
							$this->data['myCourse'][$z]->url = 'courses/'.strtolower(str_replace(' ', '-', trim($this->data['myCourse'][$z]->category_title))).'-'.$this->data['myCourse'][$z]->category_id.'/'.strtolower(str_replace(' ', '-', trim($this->data['myCourse'][$z]->title))).'-'.$this->data['myCourse'][$z]->course_id;
						endfor;	
					else:
						$this->data['myCourse'] = array();
					endif;
					$this->session->set_userdata('myCourse', $this->data['myCourse']);		
				endif;
				break;

			case 1002: echo 'exist';
				//$this->session->set_userdata('message', 'FAIL');
				//$this->session->set_userdata('theMessage', 'User already exists.');
				break;
			
			default: echo false;
				//$this->session->set_userdata('message', 'WARNING');
				//$this->session->set_userdata('theMessage', 'Something went wrong.');
				break;
		}
		
		//redirect($_POST['curr_url']);
	}

	public function signin(){

		if(!$this->input->post('keep_login')):
			$_POST['keep_login'] = 0;
		endif;

		$fields = array(
			'email_id' => $_POST['email_id'],
			'password' => $_POST['password'],
			'keep_login' => $_POST['keep_login']
		);
		
		$data = json_encode($fields);

		$ch = curl_init();
		$headers = array(
		   'Content-Type: application/json',
		   'ApiKey: '.$this->data['ApiKey']
		);
		curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/user/signin");
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$data = curl_exec($ch);
		curl_close($ch);

		$apidata = json_decode($data);

		if($apidata->response_code == 1000):			
				
			//$this->session->set_userdata('message', 'SUCCESS');
			//$this->session->set_userdata('theMessage', 'Successfully Sign In.');
			echo true;
			
			$signdata['mydata'] = array(
               'user_id'  => $apidata->data->user->user_id,
               'first_name'  => $apidata->data->user->first_name,
               'last_name'  => $apidata->data->user->last_name,
               'image_id'  => $apidata->data->user->image_id,
               'image_url'  => $apidata->data->user->image_url,
               'email_id'  => $apidata->data->user->email_id,
               'role_id'  => $apidata->data->user->role_id,
               'role_title'  => $apidata->data->user->role_title,
            );
            $signdata['mytoken'] = array(
               'accesstoken'  => $apidata->data->user->accesstoken,
               'refreshtoken'  => $apidata->data->user->refreshtoken
           	);
			$this->session->set_userdata($signdata);

			$fields = array(
				'limit' => 10,
				'offset' => 0
			);
			
			$data = json_encode($fields);

			$ch = curl_init();
			$headers = array(
			   'Content-Type: application/json',
			   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
			);
			curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/notifications?limit=10&offset=0");
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
			$this->session->set_userdata('notifys', $apidata->data->unread_totalnotifications);

			$fields = array(
				'limit' => 10,
				'offset' => 0
			);
			
			$data = json_encode($fields);

			$ch = curl_init();
			$headers = array(
			   'Content-Type: application/json',
			   'ApiKey: '.$this->data['ApiKey'],
			   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
			);

			curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/websubscriptions?limit=10&offset=0");
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
			if($apidata->response_code == 1000):
				$this->data['myCourse'] = $apidata->data->subscriptions;			
				
				if(count($this->data['myCourse']) > 3):
					$ct = 3;
				else:
					$ct = count($this->data['myCourse']);
				endif;
				
				for($z=0;$z<$ct;$z++):					
					$this->data['myCourse'][$z]->url = 'courses/'.strtolower(str_replace(' ', '-', trim($this->data['myCourse'][$z]->category_title))).'-'.$this->data['myCourse'][$z]->category_id.'/'.strtolower(str_replace(' ', '-', trim($this->data['myCourse'][$z]->title))).'-'.$this->data['myCourse'][$z]->course_id;
				endfor;	
			else:
				$this->data['myCourse'] = array();
			endif;
			$this->session->set_userdata('myCourse', $this->data['myCourse']);
		else:
			echo 'false';
			//$this->session->set_userdata('message', 'FAIL');
			//$this->session->set_userdata('theMessage', 'Invalid Sign In credentials.');			
		endif;
		
		//redirect($_POST['curr_url']);
	}

	public function shareProgress(){

		$fields = array(
			'flag' => $this->input->post('value'),
			'user_id' => $this->session->userdata('mydata')['user_id']
		);
		
		$data = json_encode($fields);	

		$ch = curl_init();
		$headers = array(
		   'Content-Type: application/json',
		   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
		);
		curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/user/sharescore");
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
			if($this->input->post('value') == 0):
				$this->session->set_userdata('theMessage', 'Your progress is not shared in leaderboard.');
			endif;
			if($this->input->post('value') == 1):
				$this->session->set_userdata('theMessage', 'Your progress is shared in leaderboard.');
			endif;
		else:
			$this->session->set_userdata('message', 'WARNING');
			$this->session->set_userdata('theMessage', 'Something went wrong.');
		endif;
	}

	public function Rates(){

		$this->RefreshToken();

		$fields = array(
			'course_id' => $this->input->post('course_id'),
			'points' => $this->input->post('points'),
			'message' => $this->input->post('message')
		);
		
		$data = json_encode($fields);	

		$ch = curl_init();
		$headers = array(
		   'Content-Type: application/json',
		   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
		);
		curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/course/rating");
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
			$this->session->set_userdata('theMessage', 'Thanks for your feedback.');
		else:
			$this->session->set_userdata('message', 'WARNING');
			$this->session->set_userdata('theMessage', 'Something went wrong.');
		endif;
	}

	public function readState(){

		$this->RefreshToken();

		$fields = array(
			'relation_id' => $this->input->post('relation_id')
		);
		
		$data = json_encode($fields);	

		$ch = curl_init();
		$headers = array(
		   'Content-Type: application/json',
		   'ApiKey: '.$this->data['ApiKey'],
		   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
		);
		curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/notifications/read");
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
	}

	public function delNotify(){

		$this->RefreshToken();

		$fields = array(
			'relation_id' => $this->input->post('relation_id')
		);
		
		$data = json_encode($fields);	

		$ch = curl_init();
		$headers = array(
		   'Content-Type: application/json',
		   'ApiKey: '.$this->data['ApiKey'],
		   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
		);
		curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/notifications/delete");
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
			$this->session->set_userdata('theMessage', 'Notification successfully deleted.');
		else:
			$this->session->set_userdata('message', 'WARNING');
			$this->session->set_userdata('theMessage', 'Something went wrong.');
		endif;
	}



	public function shareApp(){
       $this->load->library('My_PHPMailer');    
       $mail = new PHPMailer();
       $mails = explode(',', $this->input->post('mail-5'));
       $mail->IsSMTP(); // we are going to use SMTP
       $mail->SMTPAuth   = true; // enabled SMTP authentication
       $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
       $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
       $mail->Port       = 465;                   // SMTP port to connect to GMail
       $mail->Username   = "team@iedu.io";  // user email address
       $mail->Password   = "10EDcast*";            // password in GMail
       $mail->SetFrom('team@iedu.io', 'iEdu');  //Who is sending the email
      $mail->Subject    = "Email subject";
    if($this->input->post('mail-msg')):
       $mail->Body      = "HTML message";
    else:
   	$mail->Body    = "Access all 300 apps for only $9.99 for a lifetime. Download GoLearningBus Library to take the benefit of new features. In future we are not going to update this app, please install our library app.";
    endif;

       foreach($mails as $mymail)
		{
		   $mail->AddAddress($mymail);
		}
      
       if(!$mail->Send()) {
          $data["message"] = "Error: " . $mail->ErrorInfo;
          $this->session->set_userdata('theMessage', $mail->ErrorInfo);
			$this->session->set_userdata('message', 'FAIL');
           
      } else {
           $data["message"] = "Message sent correctly!";
           $this->session->set_userdata('theMessage', 'Mail successfully send.');
			$this->session->set_userdata('message', 'SUCCESS');
           
      }
   }

	public function forgetPass(){

		if($this->input->post('email_id')):
			$fields = array(
				'email_id' => $this->input->post('email_id')
			);
			
			$data = json_encode($fields);	

			$ch = curl_init();
			$headers = array(
			   'Content-Type: application/json',
			   'ApiKey: '.$this->data['ApiKey']
			);
			curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/user/forgot/password");
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
				
				$this->session->set_userdata('theMessage', 'Your request is successfully sent.');
				$this->session->set_userdata('message', 'SUCCESS');
				redirect($this->data['base_url'].'/ResetPassword');
			else:
				
				$this->session->set_userdata('theMessage', 'Something went wrong.');
				$this->session->set_userdata('message', 'WARNING');
				redirect($this->data['base_url']);
			endif;
		else:

			redirect($this->data['base_url']);
		endif;
	}

	public function GetAccessToken($client_id, $redirect_uri, $client_secret, $code) {	
		$url = 'https://accounts.google.com/o/oauth2/token';			
		
		$curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&code='. $code . '&grant_type=authorization_code';
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		curl_setopt($ch, CURLOPT_POST, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		

		if($http_code == 200):

			$this->GetUserProfileInfo($data['access_token'], $data['id_token']);
		else:
			
			redirect('https://accounts.google.com');
		endif;
	}

	public function GetUserProfileInfo($access_token, $id_token) {	

		$url = 'https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token='.$access_token;

		$ch = curl_init();
		$headers = array(
		   'Content-Type: application/json'
		);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, false);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, false);
		$data = curl_exec($ch);
		curl_close($ch);

		$apidata = json_decode($data);

		if($apidata->email):
			
			$fields = array(
				'email_id' => $apidata->email,
				'first_name' => $apidata->given_name,
				'last_name' => $apidata->family_name,
				'image_url' => $apidata->picture				
			);
			
			$data = json_encode($fields);	

			$ch = curl_init();
			$headers = array(
			   'Content-Type: application/json',
			   'ApiKey: '.$this->data['ApiKey'],
			   'GoogleToken: '.$id_token
			);
			curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/user/google/signin");
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
				$this->session->set_userdata('theMessage', 'Successfully Sign In.');

				$signdata['mydata'] = array(
	               'user_id'  => $apidata->data->user->user_id,
	               'first_name'  => $apidata->data->user->first_name,
	               'last_name'  => $apidata->data->user->last_name,
	               'image_id'  => $apidata->data->user->image_id,
	               'image_url'  => $apidata->data->user->image_url,
	               'email_id'  => $apidata->data->user->email_id,
	               'role_id'  => $apidata->data->user->role_id,
	               'role_title'  => $apidata->data->user->role_title,
	            );
	            $signdata['mytoken'] = array(
	               'accesstoken'  => $apidata->data->user->accesstoken,
	               'refreshtoken'  => $apidata->data->user->refreshtoken
	           	);
				$this->session->set_userdata($signdata);

				$fields = array(
					'limit' => 10,
					'offset' => 0
				);
				
				$data = json_encode($fields);

				$ch = curl_init();
				$headers = array(
				   'Content-Type: application/json',
				   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
				);
				curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/notifications?limit=10&offset=0");
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
				$this->session->set_userdata('notifys', $apidata->data->unread_totalnotifications);

				$fields = array(
					'limit' => 10,
					'offset' => 0
				);
				
				$data = json_encode($fields);

				$ch = curl_init();
				$headers = array(
				   'Content-Type: application/json',
				   'ApiKey: '.$this->data['ApiKey'],
				   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
				);

				curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/websubscriptions?limit=10&offset=0");
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
				if($apidata->response_code == 1000):
					$this->data['myCourse'] = $apidata->data->subscriptions;			
					
					if(count($this->data['myCourse']) > 3):
						$ct = 3;
					else:
						$ct = count($this->data['myCourse']);
					endif;
					
					for($z=0;$z<$ct;$z++):					
						$this->data['myCourse'][$z]->url = 'courses/'.strtolower(str_replace(' ', '-', trim($this->data['myCourse'][$z]->category_title))).'-'.$this->data['myCourse'][$z]->category_id.'/'.strtolower(str_replace(' ', '-', trim($this->data['myCourse'][$z]->title))).'-'.$this->data['myCourse'][$z]->course_id;
					endfor;	
				else:
					$this->data['myCourse'] = array();
				endif;
				$this->session->set_userdata('myCourse', $this->data['myCourse']);
			else:
				$this->session->set_userdata('message', 'FAIL');
				$this->session->set_userdata('theMessage', 'Invalid Sign In credentials.');			
			endif;

			redirect($this->data['base_url']);
		else:

			redirect('https://accounts.google.com');
		endif;
	}

	public function unsetSess(){

		$this->session->set_userdata('theMessage', '');
		$this->session->set_userdata('message', '');
	}

	public function RefreshToken(){

		if($this->session->userdata('mytoken')['refreshtoken'] != ''):
			$value = RefreshToken($this->session->userdata('mytoken')['refreshtoken'], $this->data['ApiKey'], $this->data['api_url']);
			$this->session->set_userdata('mytoken', array('accesstoken' => $value['accesstoken'], 'refreshtoken' => $value['refreshtoken']));
		endif;
	}
}
