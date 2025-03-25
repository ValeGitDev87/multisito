<?php
// config/routes.php

return [
    '/' => [
        'controller' => 'App\Controllers\HomeController',
        'method' => 'index',
        'middleware' => \App\Middlewares\AuthMiddleware::class
        
    ],
    '/about' => [
        'controller' => 'App\Controllers\AboutController',
        'method' => 'index'
    ],
        '/test' => [
        'controller' => 'App\Controllers\DatabaseTestController',
        'method' => 'index'
    ], 
        /* '/user/{id}' => [
        'controller' => 'App\Controllers\UserController',
        'method' => 'show'
    ], */

    '/login' => [
        'controller' => 'App\Controllers\AuthController',
        'method'     => 'login',
        'middleware' => \App\Middlewares\GuestMiddleware::class
    ],

    '/register' => [
        'controller' => 'App\Controllers\RegisterController',
        'method'     => 'register',
        'middleware' => \App\Middlewares\GuestMiddleware::class
    ],


    '/logout' => [
        'controller' => 'App\Controllers\AuthController',
        'method' => 'logout'
    ]
    



];
