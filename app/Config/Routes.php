<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

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
