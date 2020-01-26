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
$route['signin/(:num)/(:num)']['POST'] = 'sign/signin/$1/$2';
$route['signinProviders']['POST'] = 'sign/signinProviders';
$route['signup']['POST'] = 'sign/signup';
$route['signupProviders']['POST'] = 'sign/signupProviders';
$route['verify']['POST'] = 'sign/signup';
$route['forgot']['POST'] = 'sign/forgot';
$route['contact']['POST'] = 'sign/contact';
$route['logoutUser']['GET'] = 'sign/logoutUser';
$route['logoutProvider']['GET'] = 'sign/providerSession';

// Routes to Address Methods
$route['consultAddress']['GET'] = 'address/consultAddress';
$route['consultAddressId/(:num)']['GET'] = 'address/consultAddressId/$1';
$route['consultAddressUsers/(:num)']['GET'] = 'address/consultAddressUsers/$1';
$route['registerAddress']['POST'] = 'address/registerAddress';
$route['updateAddress/(:num)']['PATCH'] = 'address/updateAddress/$1';
$route['deleteAddress/(:num)']['DEL'] = 'address/deleteAddress/$1';

// Routes to Cards Methods
$route['consultCards']['GET'] = 'cards/consultCards/$1';
$route['consultCardsId/(:num)']['GET'] = 'cards/consultCardsId/$1';
$route['consultCardsUsers/(:num)']['GET'] = 'cards/consultCardsUsers/$1';
$route['registerCards']['POST'] = 'cards/register/Cards';
$route['updateCards/(:num)']['PATCH'] = 'cards/updateCards/$1';
$route['deleteCards/(:num)']['DEL'] = 'cards/deleteCards/$1';

// Routes to Dashboard Methods
$route['profileAdmin/(:num)']['GET'] = 'dashboard/profileAdmin/$1';
$route['clients']['GET'] = 'dashboard/clients';

// Routes to Logs Methods
$route['registerLogs']['POST'] = 'logs/registerLogs';
$route['consultLogs']['GET'] = 'logs/consultLogs';
$route['consultLogsId/(:num)']['GET'] = 'logs/consultLogsId/$1';

// Routes to Orders Methods
$route['consultOrder']['GET'] = 'orders/consultOrder';
$route['consultOrderId/(:num)']['GET'] = 'orders/consultOrderId/$1';
$route['consultOrderUsers/(:num)']['GET'] = 'orders/consultOrderUsers/$1';
$route['registerOrder']['POST'] = 'orders/registerOrder';
$route['updateOrder/(:num)']['PATCH'] = 'orders/updateOrder/$1';
$route['deleteOrder/(:num)']['DEL'] = 'orders/deleteOrders/$1';

// Routes to Payment Methods
$route['consultPayment']['GET'] = 'payment/consultPayment';
$route['consultPaymentId/(:num)']['GET'] = 'payment/consultPaymentId/$1';
$route['consultPaymentUsers/(:num)']['GET'] = 'payment/consultPaymentUsers/$1';
$route['registerPayment']['POST'] = 'payment/registerPayment';
$route['updatePayment/(:num)']['PATCH'] = 'payment/updatePayment/$1';
$route['deletePayment/(:num)']['DEL'] = 'payment/deletePayment/$1';

// Routes to Profile Methods
$route['consultProfile']['GET'] = 'profile/consultProfile';
$route['consultProfileId/(:num)']['GET'] = 'profile/consultProfileId/$1';
$route['consultProfileUsers/(:num)']['GET'] = 'profile/consultProfileUsers/$1';
$route['registerProfile']['POST'] = 'profile/registerProfile';
$route['updateProfile/(:num)']['PATCH'] = 'profile/updateProfile/$1';
$route['deleteProfile/(:num)']['DEL'] = 'profile/deleteProfile/$1';

// Routes to Category Methods
// Services Methods
$route['consultCategory']['GET'] = 'category/consultCategory';
$route['consultCategoryId/(:num)']['GET'] = 'profile/consultCategoryId/$1';
$route['registerCategory']['POST'] = 'category/registerCategory';
$route['updateCategory/(:num)']['PATCH'] = 'category/updateCategory/$1';
$route['deleteCategory/(:num)']['DEL'] = 'category/deleteCategory/$1';

// Routes to StockServices Methods
$route['consultServices']['GET'] = 'stockServices/consultServices';
$route['consultServicesId/(:num)']['GET'] = 'stockServices/consultServicesId';
$route['registerServices']['POST'] = 'stockServices/registerServices';
$route['updateService/(:num)']['PATCH'] = 'stockServices/updateService/$1';
$route['deleteService/(:num)']['DEL'] = 'stockServices/deleteService/$1';

// Routes to Schedules Methods
$route['consultSchedule']['GET'] = 'schedule/consultSchedule';
$route['consultScheduleId/(:num)']['GET'] = 'schedule/consultScheduleId/$1';
$route['consultScheduleUsers/(:num)']['GET'] = 'schedule/consultScheduleUsers/$1';
$route['registerSchedule']['POST'] = 'schedule/registerSchedule';
$route['updateSchedule/(:num)']['GET'] = 'schedule/updateSchedule/$1';
$route['deleteSchedule/(:num)']['PATCH'] = 'schedule/deleteSchedule/$1';
