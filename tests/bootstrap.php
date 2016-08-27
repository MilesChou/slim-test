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

    $app->get('/will/return/ok', function (Request $request, Response $response) {
        $response->getBody()->write('200');
        $newReponse = $response->withStatus(200);

        return $newReponse;
    });

    $app->get('/will/return/500', function (Request $request, Response $response) {
        $response->getBody()->write('500');
        $newReponse = $response->withStatus(500);

        return $newReponse;
    });

    return $app;
});
