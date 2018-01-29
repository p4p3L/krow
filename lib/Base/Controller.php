<?php namespace Lib\Base;

class Controller{

	protected static $instance = null;

	private function __construct(){}

	static function __callStatic($name, $args){
		return self::run($name, $args);
	}

	public static function getInstance(){
		if (self::$instance == null) {
			self::$instance = new static;
		}
		return self::$instance;
	}

	public static function run($method_name, Array $params = null){
		if (sizeof($params)>0) {
			return call_user_func_array([self::getInstance(), $method_name], $params);
		}
		return call_user_func([self::getInstance(), $method_name]);
	}

}

?>