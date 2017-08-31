<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//error_reporting(0);

$protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$config['url'] = array('baseUrl' => $protocol . "://" . $_SERVER['HTTP_HOST']);

$config['gender'] = array('Male', 'Female');

$config['glogdetail'] = array('client_id' => '373735924237-0gt1378o26il29fiuvhlr1t5ekejk087.apps.googleusercontent.com', 'client_secret' => 'VvJg2aKP6exs0_OVURAzoUEs'); 


switch ($_SERVER['HTTP_HOST']) {

	/*case 'localhost:2000':
		$config['apidetail'] = array('ApiKey' => '19b75efe43c95a2b66319d6e6529a27c233e101ccb70c32bd785880b35ed9247', 'ApiUrl' => 'https://api-v1stage.wagmob.com');
		$config['cat-link'] = array('school' => 'school-35', 'college' => 'college-34', 'language' => 'languages-36', 'professional' => 'professional-33');
		break;*/

	case 'ieduweb-stage.azurewebsites.net':
		$config['apidetail'] = array('ApiKey' => '19b75efe43c95a2b66319d6e6529a27c233e101ccb70c32bd785880b35ed9247', 'ApiUrl' => 'https://api-v1stage.wagmob.com');
		$config['cat-link'] = array('school' => 'school-35', 'college' => 'college-34', 'language' => 'languages-36', 'professional' => 'professional-33');
		break;

	default:
		$config['apidetail'] = array('ApiKey' => '7e63d36f03f3d5508ff03e3fb55d2d1f7467d32ca2c2d449d14c332364bdb925', 'ApiUrl' => 'https://api-v1.wagmob.com');
		$config['cat-link'] = array('school' => 'school-5', 'college' => 'college-6', 'language' => 'languages-8', 'professional' => 'professional-4');
		break;
}