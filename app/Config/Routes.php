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
$routes->setDefaultController('Authentication');
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
// $routes->get('/', 'Authentication::login');

$routes->match(['get', 'post'], "/", "Authentication::login");


$routes->group('admin', function ($routes) {
    $routes->get("dashboard", "Admin\Dashboard::index");
    $routes->get("generate/report", "Admin\Dashboard::generate_report");
    $routes->get("tenant/fetch_expiry_dates", "Admin\Dashboard::fetch_expiry_dates");

    $routes->match(['get', 'post'], "register", "Authentication::register");
    $routes->add("forget_password", "Authentication::forget_password");
    $routes->add("change_password/(:any)", "Authentication::change_password/$1");
    $routes->add("logout", "Authentication::logout");
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
    $routes->get("tenant/fetch_tenants", "Admin\Tenants::fetch_tenants");
    $routes->get("tenant/details/(:alphanum)", "Admin\Tenants::tenant_details/$1");
    $routes->post("tenant/update/details/(:alphanum)", "Admin\Tenants::update_tenant_details/$1");
    $routes->get("tenant/fetch_rent_date/(:alphanum)", "Admin\Tenants::fetch_rent_date/$1");
    $routes->get("tenant/delete/(:alphanum)", "Admin\Tenants::delete_tenant/$1");
    $routes->get("tenants/rent/dates", "Admin\Tenants::view_rent_due_dates");

    $routes->get("landlords/manage", "Admin\Landlord::manage_landlords");
    $routes->match(['get', 'post'], "landlord/add", "Admin\Landlord::add_landlord");
    $routes->get("landlord/fetch_landlords", "Admin\Landlord::fetch_landlords");
    $routes->get("landlord/details/(:alphanum)", "Admin\Landlord::landlord_details/$1");
    $routes->post("landlord/update/details/(:alphanum)", "Admin\Landlord::update_landlord_details/$1");
    $routes->add("property/manage", "Admin\Property::manage_properties");
    $routes->add("property/fetch_properties", "Admin\Property::fetch_properties");
    $routes->match(['get', 'post'], "property/add", "Admin\Property::add_property");
    $routes->get("property/fetch_properties", "Admin\Property::fetch_properties");
    $routes->get("property/details/(:alphanum)", "Admin\Property::property_details/$1");
    $routes->post("property/update/(:alphanum)", "Admin\Property::update_property_details/$1");
    $routes->get("property/delete/(:alphanum)", "Admin\Property::delete_property/$1");
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
