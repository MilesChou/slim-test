<?php

// Enable Composer autoloader
require dirname(__DIR__) . '/vendor/autoload.php';

$app = require dirname(__DIR__) . '/app.php';
$app->run();
