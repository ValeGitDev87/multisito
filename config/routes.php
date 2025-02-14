<?php
// config/routes.php

return [
    '/' => [
        'controller' => 'App\Controllers\HomeController',
        'method' => 'index'
    ],
    '/about' => [
        'controller' => 'App\Controllers\AboutController',
        'method' => 'index'
    ],
    '/test' => [
        'controller' => 'App\Controllers\DatabaseTestController',
        'method' => 'index'
    ],
    '/user/{id}' => [
        'controller' => 'App\Controllers\UserController',
        'method' => 'show'
    ],
    '/post/{slug}' => [
        'controller' => 'App\Controllers\PostController',
        'method' => 'show'
    ],
    '/login' => [
        'controller' => 'App\Controllers\AuthController',
        'method' => 'login'
    ],
    '/register' => [
        'controller' => 'App\Controllers\RegisterController',
        'method' => 'register'
    ],

    '/logout' => [
        'controller' => 'App\Controllers\AuthController',
        'method' => 'logout'
    ]
];
