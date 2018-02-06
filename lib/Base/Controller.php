<?php namespace Lib\Base;

class Controller{

	protected static $instance = null;

	public function __call($method_name, $args){
		$method_name .= 'Action';
		return self::run($method_name, $args);
	}

	static function __callStatic($method_name, $args){
		$method_name .= 'Action';
		return self::run($method_name, $args);
	}

	public static function getInstance(){
		if (self::$instance == null) {
			self::$instance = new static;
		}
		return self::$instance;
	}

	final public static function run($method_name, Array $params = null){
		if (sizeof($params)>0) {
			return call_user_func_array([self::getInstance(), $method_name], $params);
		}
		return call_user_func([self::getInstance(), $method_name]);
	}

}

?>