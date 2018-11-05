<?php

return [
    '/' => [
        'controller' => 'Blog',
        'action'     => 'index',
        'method'     => 'GET',
        'options'    => false
    ],

    'api/blog/get' => [
        'controller' => 'Blog',
        'action'     => 'get',
        'method'     => 'GET',
        'options'    => true
    ],

    'api/blog/all' => [
        'controller' => 'Blog',
        'action'     => 'all',
        'method'     => 'GET',
        'options'    => true
    ],

    'api/blog/create' => [
        'controller' => 'Blog',
        'action'     => 'create',
        'method'     => 'GET',
        'options'    => true
    ],

    'api/blog/edit' => [
        'controller' => 'Blog',
        'action'     => 'edit',
        'method'     => 'GET',
        'options'    => true
    ],

    'api/blog/destroy' => [
        'controller' => 'Blog',
        'action'     => 'destroy',
        'method'     => 'GET',
        'options'    => true
    ],

    'api/image/destroy' => [
        'controller' => 'Image',
        'action'     => 'destroy',
        'method'     => 'GET',
        'options'    => true
    ],

    'api/image/create' => [
        'controller' => 'Image',
        'action'     => 'create',
        'method'     => 'GET',
        'options'    => true
    ],

    'api/image/edit' => [
        'controller' => 'Image',
        'action'     => 'edit',
        'method'     => 'GET',
        'options'    => true
    ],

    'api/image/getByBlog' => [
        'controller' => 'Image',
        'action'     => 'get',
        'method'     => 'GET',
        'options'    => true
    ],
];