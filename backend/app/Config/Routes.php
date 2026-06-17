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
    $routes->group('', ['filter' => 'api-jwt'], function ($routes) {
        $routes->get('me',        'AuthController::me');
        $routes->get('me/clubs',  'MembershipController::myClubs');

        // Create a club (any authenticated user)
        $routes->post('clubs', 'ClubController::create');

        // Join a club (any authenticated user)
        $routes->post('clubs/(:num)/join', 'MembershipController::join/$1');

        // Member-only routes (any active club member)
        $routes->group('clubs/(:num)', ['filter' => 'clubMember'], function ($routes) {
            $routes->get('events', 'EventController::index/$1');
            $routes->get('events/(:num)', 'EventController::show/$1/$2');
            $routes->post('events/(:num)/rsvp', 'EventController::rsvp/$1/$2');
            $routes->get('events/(:num)/attendees', 'EventController::attendees/$1/$2');
            $routes->get('announcements', 'AnnouncementController::index/$1');
            $routes->get('announcements/(:num)', 'AnnouncementController::show/$1/$2');
        });

        // Officer+ actions on a club
        $routes->group('clubs/(:num)', ['filter' => 'clubMember|clubRole[officer]'], function ($routes) {
            $routes->get('members', 'MembershipController::members/$1');
            $routes->patch('members/(:num)/approve', 'MembershipController::approve/$1/$2');
            $routes->put('', 'ClubController::update/$1');
            $routes->post('events', 'EventController::create/$1');
            $routes->put('events/(:num)', 'EventController::update/$1/$2');
            $routes->delete('events/(:num)', 'EventController::delete/$1/$2');
            $routes->post('announcements', 'AnnouncementController::create/$1');
            $routes->put('announcements/(:num)', 'AnnouncementController::update/$1/$2');
            $routes->delete('announcements/(:num)', 'AnnouncementController::delete/$1/$2');
        });

        // President-only actions
        $routes->group('clubs/(:num)', ['filter' => 'clubMember|clubRole[president]'], function ($routes) {
            $routes->patch('members/(:num)/role', 'MembershipController::updateRole/$1/$2');
        });
    });
});