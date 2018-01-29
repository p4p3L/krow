<?php namespace Lib\Route;

use \Lib\Http\Request as Request;

class Router{

	public $routes = [];

	protected $request;
	protected $handle = false;

	function __construct(Request $request){
		$this->request = $request;
	}

	public function getResponse(){
		$handle = $this->getHandle();
		if ($handle !== false) {
			preg_match_all($handle['uri'], $this->request->url['path'], $matches, PREG_PATTERN_ORDER);
			if (isset($matches[1])) {
				$handle['params'] = $matches[1];
			}
			$reflection = new \ReflectionFunction($handle['callback']);
			$params = $reflection->getParameters();
			$offset = 0;
			if (sizeof($params)>0) {
				foreach ($params as $key => $param) {
					$name = $param->getName();
					$paramClass = $param->getClass();
				    if ($paramClass) {
				    	$className = $paramClass->getName();
				    	$args[$name] = new $className();
				    }else{
						$args[$name] = $handle['params'][$offset];
				    	$offset++;
					}
				}
				return call_user_func_array($handle['callback'], $args);
			}else{
				return call_user_func($handle['callback']);
			}
		}
		return false;
	}

	public function getHandle(){
		return $this->handle !== false ? $this->handle : false;
	}

	public function run(){
		if ($this->request instanceof Request) {
			$routes = $this->routes[$this->request->method];
			foreach ($routes as $key => $route) {
				if (preg_match($route['uri'], $this->request->url['path'])) {
					$this->handle = $route;
					return true;
				}
			}
		}
		return false;
	}

	public function addGet($uri, $callback){
		$this->add('GET', $uri, $callback);
	}

	public function addPost($uri, $callback){
		$this->add('POST', $uri, $callback);
	}

	public function add($method, $uri, $callback){
		$uri = str_replace(['/'], ['\/'], $uri);
		$this->routes[$method][] = [
			'method' => $method,
			'uri' => '#^'.$uri.'$#',
			'callback' => $callback
		];
	}
	
}

?>