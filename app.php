<?php
/* @var $bootHelper \C\Bootstrap\Common */
$bootHelper = require("bootstrap.php");

// boot an app
$app = $bootHelper->boot();

// ...then mount the web modules
$app->mount('/', $welcome);

// run the web instance
$bootHelper->run();
