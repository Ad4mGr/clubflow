<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
// app/Config/Routes.php
$routes->group('api', ['namespace' => 'App\Controllers'], function ($routes) {

    // Auth
    $routes->post('register', 'AuthController::register');
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