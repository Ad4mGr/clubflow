<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->options('(:any)', static function () {
    return service('response')
        ->setStatusCode(200)
        ->setHeader('Access-Control-Allow-Origin', 'http://localhost:5173')
        ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
        ->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
});
$routes->get('/', 'Home::index');

service('auth')->routes($routes);
// app/Config/Routes.php
$routes->group('api', ['namespace' => 'App\Controllers'], function ($routes) {

    // Auth
    $routes->post('signup', 'AuthController::signup');
    $routes->post('login',    'AuthController::login');

    // Public club routes
    $routes->get('clubs',          'ClubController::index');
    $routes->get('clubs/(:segment)', 'ClubController::show/$1');

    // Protected
    $routes->group('', ['filter' => 'jwt'], function ($routes) {
        $routes->get('me',        'AuthController::me');
        $routes->get('me/clubs',  'MembershipController::myClubs');

        // Join a club (any authenticated user)
        $routes->post('clubs/(:num)/join', 'MembershipController::join/$1');

        // Officer+ actions on a club
        $routes->group('clubs/(:num)', ['filter' => 'jwt|clubMember|clubRole[officer]'], function ($routes) {
            $routes->patch('members/(:num)/approve', 'MembershipController::approve/$1/$2');
        });

        // President-only actions
        $routes->group('clubs/(:num)', ['filter' => 'jwt|clubMember|clubRole[president]'], function ($routes) {
            $routes->patch('members/(:num)/role', 'MembershipController::updateRole/$1/$2');
        });
    });
});