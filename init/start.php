<?php

error_reporting(E_ALL);

session_start();

/*
* ENVIRONMENT - It can be takes two value. This values are development and production.
* If you develop on localhost use development and if your porject was published use production.
*
*/
define('ENVIRONMENT', 'development');

require_once(dirname(__FILE__).'/boot.php');

?>