<?php
$bootHelper = require("bootstrap.php");
$app = $bootHelper->app;


    $app->mount('/', $thatController);


$app->run();
