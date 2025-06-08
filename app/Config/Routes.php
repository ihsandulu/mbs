<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->add('/', 'utama::login');
$routes->add('/api/(:any)', 'api::$1');
$routes->add('/utama', 'utama::index');
$routes->add('/login', 'utama::login');
$routes->add('/logout', 'utama::logout');

$routes->add('/mposition', 'master\mposition::index');
$routes->add('/mpositionpages', 'master\mpositionpages::index');
$routes->add('/muser', 'master\muser::index');
$routes->add('/muserposition', 'master\muserposition::index');
$routes->add('/mpassword', 'master\mpassword::index');
$routes->add('/midentity', 'master\midentity::index');
$routes->add('/mdepartemen', 'master\mdepartemen::index');
$routes->add('/mapk', 'master\mapk::index');
$routes->add('/mpositionandroid', 'master\mpositionandroid::index');
$routes->add('/mbuyer', 'master\mbuyer::index');
$routes->add('/msize', 'master\msize::index');

$routes->add('/target', 'transaction\fabrics::target');
$routes->add('/polham', 'transaction\fabrics::polham');
$routes->add('/topten', 'transaction\fabrics::topten');
$routes->add('/carters', 'transaction\fabrics::carters');
$routes->add('/fabricsd', 'transaction\fabricsd::index');
// $routes->add('/fabricsexcel', 'transaction\fabricsexcel::index');
$routes->add('/fabricsexcel', 'transaction\fabricsexcel::exportExcel');


$routes->add('/rcutihutang', 'report\rcutihutang::index');
