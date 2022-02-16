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

$routes->get('/dynamic', 'DynamicDependent::index');

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

// cities routes
$routes->get('cities', 'CityController::index', ['filter' => 'auth']);
$routes->get('cities/new', 'CityController::new', ['filter' => 'auth']);
$routes->post('cities', 'CityController::create', ['filter' => 'auth']);
$routes->get('cities/(:num)', 'CityController::show/$1', ['filter' => 'auth']);
$routes->get('cities/edit/(:num)', 'CityController::edit/$1', ['filter' => 'auth']);
$routes->put('cities/(:num)', 'CityController::update/$1', ['filter' => 'auth']);
$routes->delete('cities/(:num)', 'CityController::delete/$1', ['filter' => 'auth']);

// hotels routes
$routes->get('hotels', 'HotelController::index', ['filter' => 'auth']);
$routes->get('hotels/new', 'HotelController::new', ['filter' => 'auth']);
$routes->post('hotels', 'HotelController::create', ['filter' => 'auth']);
$routes->get('hotels/(:num)', 'HotelController::show/$1', ['filter' => 'auth']);
$routes->get('hotels/edit/(:num)', 'HotelController::edit/$1', ['filter' => 'auth']);
$routes->put('hotels/(:num)', 'HotelController::update/$1', ['filter' => 'auth']);
$routes->delete('hotels/(:num)', 'HotelController::delete/$1', ['filter' => 'auth']);

// programs routes
$routes->get('programs', 'ProgramController::index', ['filter' => 'auth']);
$routes->get('programs/new', 'ProgramController::new', ['filter' => 'auth']);
$routes->post('programs', 'ProgramController::create', ['filter' => 'auth']);
$routes->get('programs/(:num)', 'ProgramController::show/$1', ['filter' => 'auth']);
$routes->get('programs/edit/(:num)', 'ProgramController::edit/$1', ['filter' => 'auth']);
$routes->put('programs/(:num)', 'ProgramController::update/$1', ['filter' => 'auth']);
$routes->delete('programs/(:num)', 'ProgramController::delete/$1', ['filter' => 'auth']);

// status routes
$routes->get('status', 'StatusController::index', ['filter' => 'auth']);
$routes->get('status/new', 'StatusController::new', ['filter' => 'auth']);
$routes->post('status', 'StatusController::create', ['filter' => 'auth']);
$routes->get('status/(:num)', 'StatusController::show/$1', ['filter' => 'auth']);
$routes->get('status/edit/(:num)', 'StatusController::edit/$1', ['filter' => 'auth']);
$routes->put('status/(:num)', 'StatusController::update/$1', ['filter' => 'auth']);
$routes->delete('status/(:num)', 'StatusController::delete/$1', ['filter' => 'auth']);

// usertypes routes
$routes->get('usertypes', 'UsertypeController::index', ['filter' => 'auth']);
$routes->get('usertypes/new', 'UsertypeController::new', ['filter' => 'auth']);
$routes->post('usertypes', 'UsertypeController::create', ['filter' => 'auth']);
$routes->get('usertypes/(:num)', 'UsertypeController::show/$1', ['filter' => 'auth']);
$routes->get('usertypes/edit/(:num)', 'UsertypeController::edit/$1', ['filter' => 'auth']);
$routes->put('usertypes/(:num)', 'UsertypeController::update/$1', ['filter' => 'auth']);
$routes->delete('usertypes/(:num)', 'UsertypeController::delete/$1', ['filter' => 'auth']);

// modules routes
$routes->get('modules', 'ModuleController::index', ['filter' => 'auth']);
$routes->get('modules/new', 'ModuleController::new', ['filter' => 'auth']);
$routes->post('modules', 'ModuleController::create', ['filter' => 'auth']);
$routes->get('modules/(:num)', 'ModuleController::show/$1', ['filter' => 'auth']);
$routes->get('modules/edit/(:num)', 'ModuleController::edit/$1', ['filter' => 'auth']);
$routes->put('modules/(:num)', 'ModuleController::update/$1', ['filter' => 'auth']);
$routes->delete('modules/(:num)', 'ModuleController::delete/$1', ['filter' => 'auth']);

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
