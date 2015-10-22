<?php
// get the app bootstrapped
$bootHelper = require("bootstrap.php");

// get the app and run it as a regular silex app.
$app = $bootHelper->app;

$app->mount('/', $welcome);

$app->run();
