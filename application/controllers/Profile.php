<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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

		echo "<pre>";
		print_r($this->session->userdata());
		echo "</pre>";
	}

	public function index(){

		$this->data['header'] = 'header_inner';
		$this->data['page'] = 'Profile';
		
		$fields = array(
			'AccessToken' => $this->session->userdata('mytoken')['accesstoken']
		);
		
		$data = json_encode($fields);

		$ch = curl_init();
		$headers = array(
		   'Content-Type: application/json',
		   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken'].''
		);
		curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/user/profile");
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

				$this->data['profile'] = $apidata->data->profile;

				$fields_certi = array(
					'AccessToken' => $this->session->userdata('mytoken')['accesstoken'],
					'limit' => 10,
					'offset' => 0
				);
				
				$data_certi = json_encode($fields_certi);

				$ch = curl_init();
				$headers = array(
				   'Content-Type: application/json',
				   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken'].''
				);
				curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/myachievements?limit=10&offset=0");
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_HEADER, false);

				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, false);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_certi);
				$data_certi = curl_exec($ch);
				curl_close($ch);

				$apidata_certi = json_decode($data_certi);
				$this->data['courseDetail'] = $apidata_certi->data->certificate;				
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

	public function Setting(){		

		$this->data['header'] = 'header_inner';
		$this->data['page'] = 'Setting';

		$image_idss = 0;
		
		if($this->input->post('first_name')){
						
			if($_FILES['file-upload']['name']):

				$get_ext = explode('.', $_FILES['file-upload']['name']);
				$_FILES['file-upload']['name'] = uniqid().".".$get_ext[1];

				$config['upload_path']   = './uploads/'; 
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']      = 100; 
				$config['max_width']     = 1024; 
				$config['max_height']    = 768;  

				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('file-upload')):
					
					$error = array('error' => $this->upload->display_errors()); 					
				else: 
					
					$data = array('upload_data' => $this->upload->data()); 
					$_FILES['file-upload']['tmp_name'] = $this->data['base_url']."/uploads/".$_FILES['file-upload']['name'];
				endif;
								
				$fields = array(
					'image' => $_FILES['file-upload']
				);
				
				$data = json_encode($fields);	

				$ch = curl_init();
				$headers = array(
				   'Content-Type: application/json',
				   'ApiKey: '.$this->data['ApiKey'],
				   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
				);
				curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/file/image");
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
					$image_idss = $apidata->data->image->image_id;	
					$imagedata = array(
		               'user_id'  => $this->session->userdata('mydata')['user_id'],
		               'first_name'  => $this->session->userdata('mydata')['first_name'],
		               'last_name'  => $this->session->userdata('mydata')['last_name'],
		               'image_id'  => $apidata->data->image->image_id,
		               'image_url'  => $apidata->data->image->image_url,
		               'email_id'  => $this->session->userdata('mydata')['email_id'],
		               'role_id'  => $this->session->userdata('mydata')['role_id'],
		               'role_title'  => $this->session->userdata('mydata')['role_title'],
		            ); 

		            $this->session->set_userdata('mydata', $imagedata);
				else:
					// do nothing 
				endif;		
			else:
				// do nothing
			endif;

			if($image_idss == 0):
				$fields = array(
					'first_name' => $_POST['first_name'],
					'last_name' => $_POST['last_name'],
					'image_id' => $_POST['image_id']
				);
			else:
				$fields = array(
					'first_name' => $_POST['first_name'],
					'last_name' => $_POST['last_name'],
					'image_id' => $image_idss
				);
			endif;
			
			$data = json_encode($fields);	

			$ch = curl_init();
			$headers = array(
			   'Content-Type: application/json',
			   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
			);

			curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/user/profile");
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
			redirect($this->data['base_url']."/profile/setting");
		}

		$fields = array(
			'AccessToken' => $this->session->userdata('mytoken')['accesstoken']
		);
		
		$data = json_encode($fields);

		$ch = curl_init();
		$headers = array(
		   'Content-Type: application/json',
		   'AccessToken: '.$this->session->userdata('mytoken')['accesstoken']
		);
		curl_setopt($ch, CURLOPT_URL, $this->data['api_url']."/client/v1/user/profile");
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
				$this->data['profile'] = $apidata->data->profile;
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
			echo "iffff";
			$value = RefreshToken($this->session->userdata('mytoken')['refreshtoken'], $this->data['ApiKey'], $this->data['api_url']);
			$this->session->set_userdata('mytoken', array('accesstoken' => $value['accesstoken'], 'refreshtoken' => $value['refreshtoken']));
		else:
			echo "elseeeeee";
		endif;
	}
}
