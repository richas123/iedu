<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function test_method($var = '')
    {
       return $var;
    }  

    function RefreshToken($refreshtoken = '', $apiKey = '', $url = ''){

    	if($refreshtoken != ''):
	    	$fields = array(
				'RefreshToken' => $refreshtoken
			);
			
			$data = json_encode($fields);	

			$ch = curl_init();
			$headers = array(
			   'Content-Type: application/json',
			   'ApiKey: '.$apiKey,
			   'RefreshToken: '.$refreshtoken
			);
			curl_setopt($ch, CURLOPT_URL, $url."/client/v1/user/refreshtoken");
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_HEADER, false);

			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, []);
			$data = curl_exec($ch);
			curl_close($ch);

			$apidata = json_decode($data);

			return(array('accesstoken' => $apidata->data->session->accesstoken, 'refreshtoken' => $apidata->data->session->refreshtoken));
		endif;
	} 
}