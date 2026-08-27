<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Landing::index');

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attempt');
$routes->get('/logout', 'Auth::logout');

$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/dashboard', 'Dashboard::index');

    $routes->get('/master-produk', 'MasterProduk::index');
    $routes->get('/master-produk/new', 'MasterProduk::new');
    $routes->post('/master-produk', 'MasterProduk::create');
    $routes->get('/master-produk/(:num)/edit', 'MasterProduk::edit/$1');
    $routes->post('/master-produk/(:num)', 'MasterProduk::update/$1');
    $routes->post('/master-produk/(:num)/delete', 'MasterProduk::delete/$1');

    $routes->get('/penjualan-shopee', 'PenjualanShopee::index');
    $routes->get('/penjualan-shopee/new', 'PenjualanShopee::new');
    $routes->post('/penjualan-shopee', 'PenjualanShopee::create');
    $routes->get('/penjualan-shopee/(:num)/edit', 'PenjualanShopee::edit/$1');
    $routes->post('/penjualan-shopee/(:num)', 'PenjualanShopee::update/$1');
    $routes->post('/penjualan-shopee/(:num)/delete', 'PenjualanShopee::delete/$1');
    $routes->post('/penjualan-shopee/setting', 'PenjualanShopee::updateSetting');

    $routes->get('/penjualan-offline', 'PenjualanOffline::index');
    $routes->get('/penjualan-offline/new', 'PenjualanOffline::new');
    $routes->post('/penjualan-offline', 'PenjualanOffline::create');
    $routes->get('/penjualan-offline/(:num)/edit', 'PenjualanOffline::edit/$1');
    $routes->post('/penjualan-offline/(:num)', 'PenjualanOffline::update/$1');
    $routes->post('/penjualan-offline/(:num)/delete', 'PenjualanOffline::delete/$1');

    $routes->get('/ringkasan', 'Ringkasan::index');

    $routes->get('/mutasi', 'Mutasi::index');
    $routes->get('/mutasi/new', 'Mutasi::new');
    $routes->post('/mutasi', 'Mutasi::create');
    $routes->get('/mutasi/(:num)/edit', 'Mutasi::edit/$1');
    $routes->post('/mutasi/(:num)', 'Mutasi::update/$1');
    $routes->post('/mutasi/(:num)/lunas', 'Mutasi::lunas/$1');
    $routes->post('/mutasi/(:num)/delete', 'Mutasi::delete/$1');

    $routes->get('/invoice', 'Invoice::index');
    $routes->get('/invoice/new', 'Invoice::new');
    $routes->post('/invoice', 'Invoice::create');
    $routes->get('/invoice/(:num)', 'Invoice::show/$1');
    $routes->get('/invoice/(:num)/pdf', 'Invoice::pdf/$1');
    $routes->post('/invoice/(:num)/delete', 'Invoice::delete/$1');

    $routes->get('/preorder', 'Preorder::index');
    $routes->get('/preorder/new', 'Preorder::new');
    $routes->post('/preorder', 'Preorder::create');
    $routes->get('/preorder/(:num)/edit', 'Preorder::edit/$1');
    $routes->post('/preorder/(:num)', 'Preorder::update/$1');
    $routes->post('/preorder/(:num)/delete', 'Preorder::delete/$1');

    $routes->get('/files/(:segment)/(:segment)', 'Files::show/$1/$2');
});
