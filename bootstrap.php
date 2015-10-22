<?php

// override configuration file values here.
$runtime = [
    'debug'                 => true, // this will enable the dashboard
    'env'                   => getenv('APP_ENV') ? getenv('APP_ENV') : 'dev',
    'project.path'          => __DIR__,
    'run.path'              => __DIR__.'/run/',
];

// inject some configuration values as %token% into the configuration
$configTokens = [
    'env',
    'run.path',
    'project.path',
];

// by now, boot
require 'vendor/autoload.php';

// use default C bootstrap for convenience.
use \C\Bootstrap\Common as BootHelper;
$bootHelper = new BootHelper();

// this is a regular silex app.
$app = $bootHelper->register($runtime, $configTokens);

// add additional modules here
$welcome = new C\Welcome\ControllersProvider();
$app->register($welcome);

return $bootHelper;
