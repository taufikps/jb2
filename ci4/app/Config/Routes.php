<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->post('/api/penjualan', 'Api::penjualan');
$routes->post('/api/penjualan-cancel', 'Api::penjualanCancel');
$routes->post('/api/penjualan_cancel', 'Api::penjualanCancel');
$routes->post('/api/return-full', 'Api::returnFull');
$routes->post('/api/return-partial', 'Api::returnPartial');
$routes->post('/api/stock-opname', 'Api::stockOpname');
$routes->post('/api/bill-with-putaway-true', 'Api::billWithPutawayTrue');
$routes->post('/api/product', 'Api::product');
$routes->get('/api/endpoints', 'Api::endpoints');
$routes->post('/api/jubelio/penjualan', 'Api::penjualan');
$routes->post('/api/jubelio/penjualan-cancel', 'Api::penjualanCancel');
$routes->post('/api/jubelio/return-full', 'Api::returnFull');
$routes->post('/api/jubelio/return-partial', 'Api::returnPartial');
$routes->post('/api/jubelio/stock-opname', 'Api::stockOpname');
$routes->post('/api/jubelio/bill-with-putaway-true', 'Api::billWithPutawayTrue');
$routes->get('/api-docs', 'ApiDocs::index');

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('penjualan', 'Penjualan::index');
    $routes->get('penjualan/(:num)', 'Penjualan::show/$1');
    $routes->post('penjualan/(:num)/resend', 'Penjualan::resend/$1');
    $routes->post('penjualan/(:num)/delete', 'Penjualan::delete/$1');

    $routes->get('cancel', 'Cancel::index');
    $routes->get('cancel/(:num)', 'Cancel::show/$1');
    $routes->post('cancel/(:num)/resend', 'Cancel::resend/$1');
    $routes->post('cancel/(:num)/delete', 'Cancel::delete/$1');

    $routes->get('return-full', 'Return_full::index');
    $routes->get('return-full/(:num)', 'Return_full::show/$1');
    $routes->post('return-full/(:num)/resend', 'Return_full::resend/$1');
    $routes->post('return-full/(:num)/delete', 'Return_full::delete/$1');

    $routes->get('bill-with-putaway-true', 'Bill_with_putaway_true::index');
    $routes->get('bill-with-putaway-true/(:num)', 'Bill_with_putaway_true::show/$1');
    $routes->post('bill-with-putaway-true/(:num)/resend', 'Bill_with_putaway_true::resend/$1');
    $routes->post('bill-with-putaway-true/(:num)/delete', 'Bill_with_putaway_true::delete/$1');

    $routes->get('stock-opname', 'Stock_opname::index');
    $routes->get('stock-opname/(:num)', 'Stock_opname::show/$1');
    $routes->post('stock-opname/(:num)/resend', 'Stock_opname::resend/$1');
    $routes->post('stock-opname/(:num)/delete', 'Stock_opname::delete/$1');

    $routes->get('logs', 'Logs::index');
    $routes->get('logs/view/(:segment)', 'Logs::view/$1');

    $routes->get('d365-config', 'D365Config::index');
    $routes->post('d365-config/save', 'D365Config::save');
    $routes->post('d365-config/save-endpoints', 'D365Config::saveEndpoints');
});
