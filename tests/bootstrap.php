<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Framins\Slim\Test\Factory as Factory;

// Set timezone
date_default_timezone_set('Asia/Taipei');

// Prevent session cookies
ini_set('session.use_cookies', 0);

// Enable Composer autoloader
require dirname(__DIR__) . '/vendor/autoload.php';

Factory::init(function () {
    $container = new Slim\Container();
    $app = new Slim\App($container);

    return $app;
});
