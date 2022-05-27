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

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->match(['get', 'post'], 'login', "Tenant\Authentication::register");


$routes->group('admin', function ($routes) {
    $routes->get("dashboard", "Admin\Dashboard::index");
    $routes->match(['get', 'post'], "register", "Admin\Authentication::register");
    $routes->match(['get', 'post'], "login", "Admin\Authentication::login");
    $routes->add("forget_password", "Admin\Authentication::forget_password");
    $routes->add("change_password/(:any)", "Admin\Authentication::change_password/$1");
    $routes->add("logout", "Admin\Authentication::logout");
    $routes->add("users/manage", "Admin\Users::manage_users");
    $routes->add("users/fetch_users", "Admin\Users::fetch_users");
    $routes->add("users/count_users", "Admin\Users::count_users");
    $routes->add("users/Activate", "Admin\Users::activate");
    $routes->add("users/profile", "Admin\Users::profile");
    $routes->add("users/activity_log/(:any)", "Admin\Users::activity_log/$1");
    $routes->add("users/delete_user", "Admin\Users::delete_user");
    $routes->get("users/edit/(:any)", "Admin\Users::edit/$1");
    $routes->match(['get', 'post'], "users/update", "Admin\Users::update");
    $routes->match(['get', 'post'], "users/change_password/(:any)", "Admin\Users::change_password/$1");
    $routes->get("tenants/manage", "Admin\Tenants::manage_tenants");
    $routes->match(['get', 'post'], "tenants/add", "Admin\Tenants::add_tenants");
    $routes->match(['get', 'post'], "tenants/edit", "Admin\Tenants::edit_tenants");
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
