<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


# User routes
$route['profile/edit/(:num)'] = 'profile/edit_profile/$1';

$route['products'] = 'products/products';
$route['products/(:num)'] = 'products/products/$1';

# Admin routes
$route['admin_dashboard'] = 'admin/admin_dashboard';
$route['admin_profile'] = 'admin/admin_profile';
$route['admin_profile/change_password/(:num)'] = 'admin/admin_profile/change_password/$1';

$route['admin_product'] = 'admin/admin_product';
$route['admin_product/add_product'] = 'admin/admin_product/add_product';
$route['admin_product/edit_product/(:num)'] = 'admin/admin_product/edit_product/$1';
$route['admin_product/delete_product/(:num)'] = 'admin/admin_product/delete_product/$1';
$route['admin_product/toggle_status/(:any)/(:num)'] = 'admin/admin_product/toggle_status/$1/$2';

$route['category'] = 'admin/admin_category';
$route['category/add_category'] = 'admin/admin_category/add_category';
$route['category/edit_category/(:num)'] = 'admin/admin_category/edit_category/$1';
$route['category/delete_category/(:num)'] = 'admin/admin_category/delete_category/$1';
