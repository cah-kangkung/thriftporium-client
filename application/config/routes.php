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
$route['products/latest'] = 'products/latest_products';
$route['products/search'] = 'products/search_products';
$route['products/category/(:any)'] = 'products/filter_category_product/$1';

$route['order/order_finished/(:num)'] = 'order/order_finished/$1';

$route['payment'] = 'payment/payment_list';
$route['payments/change_transferto'] = 'payment/change_transferto';
$route['payments/invoice/(:num)'] = 'invoice/report/$1';
$route['payments/canceled/(:num)'] = 'payment/canceled/$1';

# Admin routes
$route['admin_dashboard'] = 'Admin/admin_dashboard';
$route['admin_profile'] = 'Admin/admin_profile';
$route['admin_profile/change_password/(:num)'] = 'Admin/admin_profile/change_password/$1';

$route['admin_product'] = 'Admin/admin_product';
$route['admin_product/add_product'] = 'Admin/admin_product/add_product';
$route['admin_product/edit_product/(:num)'] = 'Admin/admin_product/edit_product/$1';
$route['admin_product/delete_product/(:num)'] = 'Admin/admin_product/delete_product/$1';
$route['admin_product/toggle_status/(:any)/(:num)'] = 'Admin/admin_product/toggle_status/$1/$2';

$route['category'] = 'Admin/admin_category';
$route['category/add_category'] = 'Admin/admin_category/add_category';
$route['category/edit_category/(:num)'] = 'Admin/admin_category/edit_category/$1';
$route['category/delete_category/(:num)'] = 'Admin/admin_category/delete_category/$1';

$route['admin_order'] = 'Admin/admin_order';
$route['admin_order/upload_resi'] = 'Admin/admin_order/upload_resi';
$route['admin_order/order_finished/(:num)'] = 'Admin/admin_order/order_finished/$1';
$route['admin_order/cancel_order'] = 'Admin/admin_order/cancel_order';

$route['admin_payment'] = 'Admin/admin_payment';
$route['admin_payment/verify_payment'] = 'Admin/admin_payment/verify_payment';
$route['admin_payment/reject_receipt'] = 'Admin/admin_payment/reject_receipt';
$route['admin_payment/cancel_payment'] = 'Admin/admin_payment/cancel_payment';
