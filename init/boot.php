<?php 

require_once('const.php');
require_once('funcs.php');
$aliases = require_once('aliases.php');

function __autoload($class){
	$parts = explode('\\', $class);
	$parts[0] = strtolower($parts[0]);
	$path_prefix = $parts[0];
	$class_name = array_pop($parts);
	$path_middle = implode('\\', $parts);
	if (isset($GLOBALS['prefix'][$path_prefix])) {
		$prefix = $GLOBALS['prefix'][$path_prefix];
		set_include_path($prefix);
		$class_path = $prefix.'\\'.$path_middle.'\\'.$class_name.'.php';
		if (file_exists($class_path)) {
			require_once($class_path);
		}
	}
}

$user_aliases_path = APP_PATH.'/aliases.php';
if (file_exists($user_aliases_path)) {
	$user_aliases = require_once($user_aliases_path);
	if (sizeof($aliases)>0 && is_array($aliases)) {	
		$aliases = array_merge($aliases, $user_aliases);
	}
}

foreach ($aliases as $alias => $class) {
	if (class_exists($class)) {
		class_alias($class, $alias);
	}
}

?>