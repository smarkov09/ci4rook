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
$routes->setDefaultController('UserController');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'UserController::login');

// posts routes
$routes->get('posts', 'PostController::index');
$routes->get('posts/new', 'PostController::new');
$routes->post('posts', 'PostController::create');
$routes->get('posts/(:num)', 'PostController::show/$1');
$routes->get('posts/edit/(:num)', 'PostController::edit/$1');
$routes->put('posts/(:num)', 'PostController::update/$1');
$routes->delete('posts/(:num)', 'PostController::delete/$1');

// user auth & register routes
$routes->get('register', 'UserController::register');
$routes->post('register', 'UserController::create');
$routes->get('login', 'UserController::login');
$routes->post('login', 'UserController::loginValidate');
$routes->get('dashboard', 'UserController::dashboard', ['filter' => 'auth']);
$routes->get('logout', 'UserController::logout');

// countries routes
$routes->get('countries', 'CountryController::index', ['filter' => 'auth']);
$routes->get('countries/new', 'CountryController::new', ['filter' => 'auth']);
$routes->post('countries', 'CountryController::create', ['filter' => 'auth']);
$routes->get('countries/(:num)', 'CountryController::show/$1', ['filter' => 'auth']);
$routes->get('countries/edit/(:num)', 'CountryController::edit/$1', ['filter' => 'auth']);
$routes->put('countries/(:num)', 'CountryController::update/$1', ['filter' => 'auth']);
$routes->delete('countries/(:num)', 'CountryController::delete/$1', ['filter' => 'auth']);

// regions routes
$routes->get('regions', 'RegionController::index', ['filter' => 'auth']);
$routes->get('regions/new', 'RegionController::new', ['filter' => 'auth']);
$routes->post('regions', 'RegionController::create', ['filter' => 'auth']);
$routes->get('regions/(:num)', 'RegionController::show/$1', ['filter' => 'auth']);
$routes->get('regions/edit/(:num)', 'RegionController::edit/$1', ['filter' => 'auth']);
$routes->put('regions/(:num)', 'RegionController::update/$1', ['filter' => 'auth']);
$routes->delete('regions/(:num)', 'RegionController::delete/$1', ['filter' => 'auth']);

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
