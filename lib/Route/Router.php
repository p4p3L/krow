<?php namespace Lib\Route;

class Router{

	protected $request;
	protected $handle = false;

	public $rules = [];
	public $routes = [];

	function __construct(\Request $request){
		$this->request = $request;
	}

	public function getResponse(){
		$handle = $this->getHandle();
		if ($handle !== false) {
			preg_match_all($handle['uri'], $this->request->url['path'], $matches, PREG_SET_ORDER);
			if (isset($matches[0])) {
				unset($matches[0][0]);
				$handle['params'] = array_values($matches[0]);
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
		if ($this->runRules() == false) { exit(); }
		if ($this->request instanceof \Request) {
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

	public function runRules(){
		if (sizeof($this->rules)>0) {
			foreach ($this->rules as $key => $rule) {
				if (preg_match($rule['uri'], $this->request->url['path'])) {
					$rule_state = call_user_func($rule['callback']);
					if ($rule_state == false) {
						return false;
					}
				}
			}
		}
		return true;
	}

	public function addGet($uri, $callback){
		$this->add('GET', $uri, $callback);
	}

	public function addPost($uri, $callback){
		$this->add('POST', $uri, $callback);
	}

	public function add($method, $uri, $callback){
		$this->routes[$method][] = [
			'method' => $method,
			'uri' => $this->uriToPattern($uri),
			'callback' => $callback
		];
	}

	public function addRule($uri, $callback){
		$this->rules[] = [
			'uri' => $this->uriToPattern($uri),
			'callback' => $callback
		];
	}

	public function uriToPattern($uri, $pre = '#^', $end = '$#'){
		return $pre.(str_replace(['/'], ['\/'], $uri)).$end;
	}
	
}

?>