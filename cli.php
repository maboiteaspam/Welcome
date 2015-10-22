#!/usr/bin/env php
<?php
// get the app bootstrapped
$bootHelper = require("bootstrap.php");
// register additional base cli modules
$bootHelper->registerCli();
// run the cli instance
$bootHelper->runCli();
