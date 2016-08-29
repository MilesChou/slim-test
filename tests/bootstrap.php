<?php
// Set timezone
date_default_timezone_set('Asia/Taipei');

// Prevent session cookies
ini_set('session.use_cookies', 0);

// Enable Composer autoloader
require dirname(__DIR__) . '/vendor/autoload.php';
