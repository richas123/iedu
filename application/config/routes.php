<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['default_controller'] = 'welcome';
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['sign-in'] = 'Home/login';
$route['sign-up'] = 'Home/logup';
$route['forgot-password'] = 'Home/forPass';

$route['school/(:any)'] = 'School/Course/(:any)';
$route['school/(:any)/(:any)'] = 'School/Course/(:any)/(:any)';

$route['college/(:any)'] = 'College/Course/(:any)';
$route['college/(:any)/(:any)'] = 'College/Course/(:any)/(:any)';

$route['professional/(:any)'] = 'Professional/Course/(:any)';
$route['professional/(:any)/(:any)'] = 'Professional/Course/(:any)/(:any)';

$route['languages/(:any)'] = 'Languages/Course/(:any)';
$route['languages/(:any)/(:any)'] = 'Languages/Course/(:any)/(:any)';

$route['enroll-course/(:any)/(:any)'] = 'EnrollCourse/Course/(:any)/(:any)';
$route['leaderboard/(:any)/(:any)'] = 'Courses/Leaderboard/(:any)/(:any)';

$route['courses/(:any)'] = 'Courses/Course/(:any)';
$route['courses/(:any)/(:any)'] = 'Courses/Course/(:any)/(:any)';
$route['courses/(:any)/(:any)/(:any)'] = 'Courses/Course/(:any)/(:any)/(:any)';
$route['courses/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Courses/Course/(:any)/(:any)/(:any)/(:any)/(:any)';

$route['change-password'] = 'ChangePass';
$route['my-courses'] = 'MyCourses';

$route['profile/setting'] = 'Profile/Setting';
$route['profile'] = 'Profile';
$route['notification'] = 'Notification';
$route['certificate'] = 'Certificate';

$route['get-start'] = 'start';
$route['get-start/getResponse'] = 'start/getResponse';
$route['get-start/cancelPay'] = 'start/cancelPay';