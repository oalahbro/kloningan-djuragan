<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
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
$routes->get('/', 'Auth::index');

// admin
$routes->get('admin/invoices', 'Admin/Invoices::lihat', ['as' => 'admin_inv']);
$routes->addRedirect('admin', 'admin_inv');

// user
$routes->get('user/invoices', 'User/Invoices::lihat', ['as' => 'user_inv']);
$routes->addRedirect('user', 'user_inv');

$routes->group('api', function($routes)
{
    $routes->group('juragan', function($routes)
    {
        $routes->add('(:segment)', 'Api\Juragan::$1');
    });

    $routes->group('notifikasi', function($routes)
    {
        $routes->add('(:segment)', 'Api\Notifikasi::$1');
    });

    $routes->group('pengguna', function($routes)
    {
        $routes->add('(:segment)', 'Api\Pengguna::$1');
    });

    $routes->group('pengiriman', function($routes)
    {
        $routes->add('(:segment)', 'Api\Pengiriman::$1');
        $routes->post('photos', 'Api\Pengiriman::create');
    });

});

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
