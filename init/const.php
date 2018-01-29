<?php 
	
	define('APP_ROOT', ROOT.'/app');
	define('INIT_ROOT', ROOT.'/init');
	define('LIB_ROOT', ROOT.'/lib');
	define('VAR_ROOT', ROOT.'/var');

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