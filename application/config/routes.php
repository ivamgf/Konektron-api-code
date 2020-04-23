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
|   example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|   https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|   $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|   $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|   $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
|   Examples:   my-controller/index -> my_controller/index
|               my-controller/my-method -> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;

// Routes to Sign Methods
$route['signin']['POST'] = 'sign/signin';
$route['signinProviders']['POST'] = 'sign/signinProviders';
$route['signup']['POST'] = 'sign/signup';
$route['signupProviders']['POST'] = 'sign/signupProviders';
$route['verify']['POST'] = 'sign/verify';
$route['verifyProviders']['POST'] = 'sign/verifyProviders';
$route['activation/(:any)']['GET'] = 'sign/activation/$1';
$route['activationProviders/(:any)']['GET'] = 'sign/activationProviders/$1';
$route['recoverToken/(:any)']['GET'] = 'sign/recoverToken/$1';
$route['recoverTokenProviders/(:any)']['GET'] = 'sign/recoverTokenProviders/$1';
$route['recover/(:any)']['POST'] = 'sign/recover/$1';
$route['recoverProviders/(:any)']['POST'] = 'sign/recoverProviders/$1';
$route['forgot']['POST'] = 'sign/forgot';
$route['forgotProviders']['POST'] = 'sign/forgotProviders';
$route['contact']['POST'] = 'sign/contact';
$route['logoutUser']['GET'] = 'sign/logoutUser';
$route['logoutProvider']['GET'] = 'sign/logoutProviders';

// Routes to Address Methods
$route['consultAddress']['GET'] = 'address/consultAddress';
$route['consultAddressId/(:num)']['GET'] = 'address/consultAddressId/$1';
$route['consultAddressUsers/(:num)']['GET'] = 'address/consultAddressUsers/$1';
$route['registerAddress']['POST'] = 'address/registerAddress';
$route['updateAddress/(:num)']['PATCH'] = 'address/updateAddress/$1';
$route['deleteAddress/(:num)']['DELETE'] = 'address/deleteAddress/$1';

// Routes to Cards Methods
$route['consultCards']['GET'] = 'cards/consultCards/$1';
$route['consultCardsId/(:num)']['GET'] = 'cards/consultCardsId/$1';
$route['consultCardsUsers/(:num)']['GET'] = 'cards/consultCardsUsers/$1';
$route['registerCards']['POST'] = 'cards/registerCards';
$route['updateCards/(:num)']['PATCH'] = 'cards/updateCards/$1';
$route['deleteCards/(:num)']['DELETE'] = 'cards/deleteCards/$1';

// Routes to Dashboard Methods
$route['profileAdmin']['GET'] = 'dashboard/profileAdmin';
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
$route['deleteOrder/(:num)']['DELETE'] = 'orders/deleteOrder/$1';

// Routes to Payment Methods
$route['consultPayment']['GET'] = 'payment/consultPayment';
$route['consultPaymentId/(:num)']['GET'] = 'payment/consultPaymentId/$1';
$route['consultPaymentUsers/(:num)']['GET'] = 'payment/consultPaymentUsers/$1';
$route['registerPayment']['POST'] = 'payment/registerPayment';
$route['updatePayment/(:num)']['PATCH'] = 'payment/updatePayment/$1';
$route['deletePayment/(:num)']['DELETE'] = 'payment/deletePayment/$1';

// Routes to Profile Methods
$route['consultProfile']['GET'] = 'profile/consultProfile';
$route['consultProfileId/(:num)']['GET'] = 'profile/consultProfileId/$1';
$route['consultProfileUsers/(:num)']['GET'] = 'profile/consultProfileUsers/$1';
$route['registerProfile']['POST'] = 'profile/registerProfile';
$route['updateProfile/(:num)']['PATCH'] = 'profile/updateProfile/$1';
$route['deleteProfile/(:num)']['DELETE'] = 'profile/deleteProfile/$1';

// Routes to Category Methods
// Services Methods
$route['consultCategory']['GET'] = 'category/consultCategory';
$route['consultCategoryId/(:num)']['GET'] = 'category/consultCategoryId/$1';
$route['registerCategory']['POST'] = 'category/registerCategory';
$route['updateCategory/(:num)']['PATCH'] = 'category/updateCategory/$1';
$route['deleteCategory/(:num)']['DELETE'] = 'category/deleteCategory/$1';

// Routes to StockServices Methods
$route['consultServices']['GET'] = 'stock_services/consultServices';
$route['consultServicesId/(:num)']['GET'] = 'stock_services/consultServicesId/$1';
$route['registerServices']['POST'] = 'stock_services/registerServices';
$route['updateService/(:num)']['PATCH'] = 'stock_services/updateService/$1';
$route['deleteService/(:num)']['DELETE'] = 'stock_services/deleteService/$1';

// Routes to Schedules Methods
$route['consultSchedule']['GET'] = 'schedule/consultSchedule';
$route['consultScheduleId/(:num)']['GET'] = 'schedule/consultScheduleId/$1';
$route['consultScheduleUsers/(:num)']['GET'] = 'schedule/consultScheduleUsers/$1';
$route['registerSchedule']['POST'] = 'schedule/registerSchedule';
$route['updateSchedule/(:num)']['PATCH'] = 'schedule/updateSchedule/$1';
$route['deleteSchedule/(:num)']['DELETE'] = 'schedule/deleteSchedule/$1';
