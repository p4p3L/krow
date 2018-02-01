<?php namespace Lib\Database\PDO;

class DB {
    
    private static $instance; 
    
    private function __construct(){}
    
    private function __clone(){}

    public static function select($sql){
    	return self::getInstance()->query($sql, \PDO::FETCH_ASSOC);
    }

    public static function one($sql){
    	return self::getInstance()->query($sql)->fetch(\PDO::FETCH_ASSOC);
    }

    public static function query($sql, Array $params = null){
	    $q = self::getInstance()->prepare($sql);
	    return sizeof($params)>0 ? $q->execute($params) : $q->execute();
    }

    public static function insertId(){
    	return self::getInstance()->lastInsertId();
    }

    public static function getDbConfig($db_config_path){
    	$db = require_once($db_config_path);
		$db_config = $db['mysql']['local'];
		if (ENVIRONMENT == 'production') {
			$db_config = $db['mysql']['remote'];
		}
		return $db_config;
    }
    
    public static function getInstance(Array $db = null){
        if(!self::$instance){
        	$db = self::getDbConfig(INIT_ROOT.'/db_config.php');
    		$dsn = 'mysql:host='.$db['db_host'].';dbname='.$db['db_name'];
            self::$instance = new \PDO($dsn, $db['db_user'], $db['db_pass']); 
            self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); 
        }
        return self::$instance; 
    }
    
    final public static function __callStatic( $method, $args ){
        $instance = self::getInstance(); 
        return call_user_func_array([$instance, $method], $args); 
    }
    
}

?>