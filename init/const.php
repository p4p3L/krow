<?php 

define('ROOT', getcwd());
define('APP_ROOT', ROOT.'/app');
define('INIT_ROOT', ROOT.'/init');
define('LIB_ROOT', ROOT.'/lib');
define('VAR_ROOT', ROOT.'/var');
define('APP_PATH', ROOT.'/app/'.APP_NAME);
define('SCRIPT_NAME', preg_replace('/\/[a-zA-Z-_]+\.php/', '/', $_SERVER['SCRIPT_NAME']));
define('WEB_ROOT', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].SCRIPT_NAME);

$prefix = [
	/*
	*
	* @path ROOT/lib/<lib_folder_name>/<lib_file_name>.php
	* Base classes.
	*/
	'lib' => ROOT,

	/*
	*
	* @path ROOT/app/<app_folder_name>/controllers
	* This is MVC class folder of application.
	*/
	'controllers' => APP_PATH,
	'models' => APP_PATH,
	'views' => APP_PATH
];

?>