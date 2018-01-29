<?php 

	include('const.php');

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

	include('funcs.php');

?>