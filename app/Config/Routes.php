<?php namespace Config;

// Create a new instance of our RouteCollection class.
<<<<<<< HEAD
<<<<<<< HEAD
$routes = Services::routes();
=======
$routes = Services::routes(true);
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
=======
$routes = Services::routes();
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
<<<<<<< HEAD
$routes->setDefaultController('Home');
=======
$routes->setDefaultController('Auth');
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
<<<<<<< HEAD
$routes->get('/', 'Home::index');
=======
$routes->get('/', 'Auth::index');

// admin
$routes->get('admin/invoices', 'admin/Invoices::lihat', ['as' => 'admin_inv']);
$routes->addRedirect('admin', 'admin_inv');

// user
$routes->get('user', 'user/Invoices::index');
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
<<<<<<< HEAD
<<<<<<< HEAD
 * need it to be able to override any defaults in this file. Environment
=======
 * need to it be able to override any defaults in this file. Environment
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
=======
 * need it to be able to override any defaults in this file. Environment
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
