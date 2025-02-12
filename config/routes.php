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
    '/user/{id}' => [
        'controller' => 'App\Controllers\UserController',
        'method' => 'show'
    ],
    '/post/{slug}' => [
        'controller' => 'App\Controllers\PostController',
        'method' => 'show'
    ],
];
