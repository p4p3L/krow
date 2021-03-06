<?php

/*
*	BASE ALIASES
*/
return [
	'App' => '\\Lib\\Application\\App',

	'Request' => '\\Lib\\Http\\Request',
	'Redirect' => '\\Lib\\Http\\Redirect',

	'Router' => '\\Lib\\Route\\Router',

	'Controller' => '\\Lib\\Base\\Controller',

	'Render' => '\\Lib\\View\\Render',
	'ViewCompiler' => '\\Lib\\View\\ViewCompiler',

	'FileCache' => '\\Lib\\Cache\\FileCache',

	'Auth' => '\\Lib\\Auth\\Auth',
	
	'DB' => '\\Lib\\Database\\PDO\\DB',

	'Mime' => '\\Lib\\Mime\\Mime',

	'Session' => '\\Lib\\Session\\Session'
];

?>