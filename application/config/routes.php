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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['api/user_master']['GET'] = 'UserController/index/';
$route['api/user_master']['POST'] = 'UserController/create/';
$route['api/user_master']['OPTIONS'] = 'HttpOptionsController/http_options/';
$route['api/user_master/login']['POST'] = 'UserController/login/';
$route['api/user_master/login']['OPTIONS'] = 'HttpOptionsController/http_options/';
$route['api/user_master/check_username']['POST'] = 'UserController/check_username/';
$route['api/user_master/check_username']['OPTIONS'] = 'HttpOptionsController/http_options/';
$route['api/user_master/check_email']['POST'] = 'UserController/check_email/';
$route['api/user_master/check_email']['OPTIONS'] = 'HttpOptionsController/http_options/';
$route['api/user_master/fb_login']['POST'] = 'UserController/fb_login/';
$route['api/user_master/fb_login']['OPTIONS'] = 'HttpOptionsController/http_options/';
$route['api/user_master/gp_login']['POST'] = 'UserController/gp_login/';
$route['api/user_master/gp_login']['OPTIONS'] = 'HttpOptionsController/http_options/';

$route['api/post_master']['GET'] = 'PostController/index/';
$route['api/post_master/(:num)']['GET'] = 'PostController/getOne/$1';

$route['api/comment_master/(:num)']['GET'] = 'CommentController/index/$1';
$route['api/comment_master/insert']['POST'] = 'CommentController/insert/';
$route['api/comment_master/insert']['OPTIONS'] = 'HttpOptionsController/http_options/';

$route['api/reply_master/(:num)']['GET'] = 'ReplyController/index/$1';