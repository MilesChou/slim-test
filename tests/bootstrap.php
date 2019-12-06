<?php
// Set timezone
date_default_timezone_set('Asia/Taipei');

// Prevent session cookies
ini_set('session.use_cookies', 0);

// Enable Composer autoloader
require dirname(__DIR__) . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();
$capsule->addConnection([
    'driver' => getenv('DB_CONNECTION'),
    'host' => getenv('DB_HOST'),
    'database' => getenv('DB_DATABASE'),
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASS'),
], 'default');

$capsule->setAsGlobal();
