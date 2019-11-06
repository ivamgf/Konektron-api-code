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

// Routes to Sign Methods
$route['signin']['POST'] = 'sign/signin';
$route['signup']['POST'] = 'sign/signup';
$route['forgot']['POST'] = 'sign/forgot';
$route['contact']['POST'] = 'sign/contact';

// Routes to Address Methods
$route['consultAddress/(:num)']['GET'] = 'address/consultAddress/$1';
$route['registerAddress']['POST'] = 'address/registerAddress';
$route['updateAddress/(:num)']['PATCH'] = 'address/updateAddress/$1';
$route['deleteAddress/(:num)']['DEL'] = 'address/deleteAddress/$1';

// Routes to Cards Methods
$route['consultCards/(:num)']['GET'] = 'cards/consultCards/$1';
$route['registerCards']['POST'] = 'cards/register/Cards';
$route['updateCards/(:num)']['PATCH'] = 'cards/updateCards/$1';
$route['deleteCards/(:num)']['DEL'] = 'cards/deleteCards/$1';

// Routes to Carts Methods
$route['cart']['POST'] = 'carts/cart';
$route['consultCart/(:num)']['GET'] = 'carts/consultCart/$1';
$route['checkoutCustom']['POST'] = 'carts/checkoutCustom';
$route['checkoutConfirm']['POST'] = 'carts/checkoutConfirm';
$route['updateCart/(:num)']['PATCH'] = 'carts/updateCart/$1';
$route['cancelCart/(:num)']['DEL'] = 'carts/cancelCart/$1';

// Routes to Dashboard Methods
$route['profileAdmin/(:num)']['GET'] = 'dashboard/profileAdmin/$1';
$route['clients']['GET'] = 'dashboard/clients';
$route['orders']['GET'] = 'dashboard/orders';
$route['payments']['GET'] = 'dashboard/payments';
$route['schedules']['GET'] = 'dashboard/schedules';

// Routes to Logs Methods
$route['registerLogs']['POST'] = 'logs/registerLogs';
$route['consultLogs']['GET'] = 'logs/consultLogs';

// Routes to Orders Methods
$route['registerOrder']['POST'] = 'orders/registerOrder';
$route['consultOrder/(:num)']['GET'] = 'orders/consultOrder/$1';
$route['updateOrder/(:num)']['PATCH'] = 'orders/updateOrder/$1';
$route['deleteOrder/(:num)']['DEL'] = 'orders/deleteOrders/$1';

// Routes to Payment Methods
$route['registerPayment']['POST'] = 'payment/registerPayment';
$route['consultPayment/(:num)']['GET'] = 'payment/consultPayment/$1';
$route['updatePayment/(:num)']['PATCH'] = 'payment/updatePayment/$1';
$route['cancelPayment/(:num)']['DEL'] = 'payment/cancelPayment/$1';

// Routes to Profile Methods
$route['registerProfile']['POST'] = 'profile/registerProfile';
$route['consultProfile/(:num)']['GET'] = 'profile/consultProfile/$1';
$route['updateProfile/(:num)']['PATCH'] = 'profile/updateProfile/$1';
$route['deleteProfile/(:num)']['DEL'] = 'profile/deleteProfile/$1';
$route['myPayments/(:num)']['GET'] = 'profile/myPayments/$1';
$route['myOrders/(:num)']['GET'] = 'profile/myOrders/$1';
$route['mySchedules/(:num)']['GET'] = 'profile/mySchedules/$1';

// Routes to Category Methods
// Products Methods
$route['categoryProd']['GET'] = 'category/categoryProd';
$route['registerCatProd']['POST'] = 'category/registerCatProd';
$route['updateCatProd/(:num)']['PATCH'] = 'category/updateCatProd/$1';
$route['deleteCatProd/(:num)']['DEL'] = 'category/deleteCatProd/$1';
$route['catProd/(:num)']['GET'] = 'category/catProd/$1';
// Services Methods
$route['categoryServ']['GET'] = 'category/categoryServ';
$route['registerCatServ']['POST'] = 'category/registerCatServ';
$route['updateCatServ/(:num)']['PATCH'] = 'category/updateCatServ/$1';
$route['deleteCatServ/(:num)']['DEL'] = 'category/deleteCatServ/$1';
$route['catServ/(:num)']['GET'] = 'category/catServ/$1';

// Routes to stockProducts Methods
$route['registerProduct']['POST'] = 'stockProducts/registerProduct';
$route['consultProducts']['GET'] = 'stockProducts/consultProducts';
$route['product/(:num)']['GET'] = 'stockProducts/product/$1';
$route['updateProduct/(:num)']['PATCH'] = 'stockProducts/updateProduct/$1';
$route['deleteProduct/(:num)']['DEL'] = 'stockProducts/deleteProduct/$1';

// Routes to StockServices Methods
$route['registerServices']['POST'] = 'stockServices/registerServices';
$route['consultServices']['GET'] = 'stockServices/consultServices';
$route['service/(:num)']['GET'] = 'stockServices/service/$1';
$route['updateService/(:num)']['PATCH'] = 'stockServices/updateService/$1';
$route['deleteService/(:num)']['DEL'] = 'stockServices/deleteService/$1';

// Routes to Schedules Methods
$route['registerSchedule']['POST'] = 'schedule/registerSchedule';
$route['consultSchedule/(:num)']['GET'] = 'schedule/consultSchedule/$1';
$route['updateSchedule/(:num)']['GET'] = 'schedule/updateSchedule/$1';
$route['deleteSchedule/(:num)']['PATCH'] = 'schedule/deleteSchedule/$1';
