<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// AUTH
$routes->get('login', 'Auth::loginForm');
$routes->post('login', 'Auth::login');
$routes->get('signup', 'Auth::signupForm');
$routes->post('signup', 'Auth::signup');
$routes->get('sifremi-unuttum-form', 'Auth::sifremiUnuttumForm');
$routes->post('sifremi-unuttum', 'Auth::sifremiUnuttum');
$routes->post('sifre-yenile/(:segment)/(:segment)', 'Auth::sifreYenile/$1/$2');
$routes->get('aktivasyon-onayla/(:segment)/(:segment)', 'Auth::confirmActivation/$1/$2');
$routes->get('aktivasyon-yenile/(:segment)/(:segment)', 'Auth::confirmActivation/$1/$2');
$routes->get('sifremi-unuttum/(:segment)/(:segment)', 'Auth::sifreYenileForm/$1/$2');

// LOGOUT
$routes->get('cikis-yap', 'Auth::logout');

// USER ACCOUNT
$routes->get('hesabim-form', 'UserAccount::userAccountForm');
$routes->post('save-user-data', 'UserAccount::saveUserData');
$routes->post('save-user-address-data/(:segment)', 'UserAccount::saveUserAddressData/$1');
// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/OurPackages/(.+)', 'OurPackages::index/$1');
$routes->get('/OurPackages/(.+)/(.+)', 'OurPackages::index/$1/$2');
$routes->get('/product/(.+)', 'OurPackages::product/$1');
$routes->get('basket', 'Basket::index');
$routes->get('/contractPlus/(.+)', 'Contact::index/$1');
$routes->get('/cartPlus/(.+)', 'Cart::index/$1');


// Desk
$routes->get('orderPlus/(.+)', 'Orders::index/$1');


// F Panel
$routes->get('Fpanel', 'Fpanel\Admin::index');
$routes->get('FpanelPlus/(.+)', 'Fpanel\Admin::index/$1');

// Waiter
$routes->get('Fpanel/waiterPlus/(.+)', 'Fpanel\Waiter::index/$1');

// Panel
$routes->get('Fpanel/board/(.+)', 'Fpanel\Panel::index/$1');

// Settings
$routes->get('Fpanel/settingPlus/(.+)', 'Fpanel\Setting::index/$1');

// Extra Products
$routes->get('Fpanel/extraProductPlus/(.+)/(.+)', 'Fpanel\ExtraProduct::details/$1/$2');
$routes->get('Fpanel/extraProductPlus/(.+)', 'Fpanel\ExtraProduct::details/$1');
$routes->get('Fpanel/extraProduct/addPlus/(.+)', 'Fpanel\ExtraProduct::add/$1');
$routes->get('Fpanel/extraProduct/addPlusP/(.+)', 'Fpanel\ExtraProduct::add/0/$1');
$routes->get('Fpanel/extraProduct/updatePlus/(.+)', 'Fpanel\ExtraProduct::update/$1');

// Owner 
$routes->get('Fpanel/ownerPlus/(.+)', 'Fpanel\Owner::index/$1');
$routes->get('Fpanel/owner/addPlus/(.+)', 'Fpanel\Owner::add/$1');
$routes->get('Fpanel/owner/updatePlus/(.+)', 'Fpanel\Owner::update/$1');

    // Log 
    $routes->get('Fpanel/logPlus/(.+)/(.+)', 'Fpanel\Log::loger/$1/$2');
    $routes->get('Fpanel/logAllPlus/(.+)', 'Fpanel\Log::logAll/$1');

// Category 
$routes->get('Fpanel/categoryPlus/(.+)', 'Fpanel\Category::index/$1');
$routes->get('Fpanel/category/addPlus/(.+)', 'Fpanel\Category::add/$1');
$routes->get('Fpanel/category/updatePlus/(.+)', 'Fpanel\Category::update/$1');

    // Product 
    $routes->get('Fpanel/product/addPlus/(.+)', 'Fpanel\Product::add/$1');
    $routes->get('Fpanel/product/updatePlus/(.+)', 'Fpanel\Product::update/$1');

// Language 
$routes->get('Fpanel/languagePlus/(.+)', 'Fpanel\Language::index/$1');

// Basket
$routes->get('addBasket/(.+)', 'Basket::addBasket/$1');
$routes->get('basket', 'Basket::index');
$routes->post('basket/increaseProductCount', 'Basket::increaseProductCount');
$routes->post('basket/decreaseProductCount', 'Basket::decreaseProductCount');
$routes->post('basket/deleteProductFromBasket', 'Basket::deleteProductFromBasket');

// Payment
$routes->get('payment', 'Payment::payment');
$routes->match(['get', 'post'], 'Payment/afterPayment', 'Payment::callback', ['as' => 'payment_callback']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
