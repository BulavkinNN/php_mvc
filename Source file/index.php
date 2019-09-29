<?php

//display all errors
ini_set ('display_errors','1');
error_reporting(E_ALL);

//system constance
define('ROOT',dirname(__FILE__));
require_once (ROOT.'/components/Router.php');

//start router
$router = new Router ();
$router->run ();