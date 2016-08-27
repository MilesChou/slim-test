<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Set timezone
date_default_timezone_set('Asia/Taipei');

// Prevent session cookies
ini_set('session.use_cookies', 0);

// Enable Composer autoloader
require dirname(__DIR__) . '/vendor/autoload.php';

class SlimFactory
{
    /**
     * Get Slim App instance for testing
     *
     * @return Slim\App
     */
    public static function getInstance()
    {
        $container = new Slim\Container();
        $app = new Slim\App($container);

        return $app;
    }
}
