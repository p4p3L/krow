<?php namespace Lib\Application;

class App{

	protected $providers = [];
	protected $app_path = null;
	protected $response = null;

	function __construct(\Router $route, $app_path = null){
		$this->app_path = $app_path;
		$this->setProvider('route', $route);
		$this->setProvider('request', $route->request);
	}

	function __get($provider_name){
		return $this->getProvider($provider_name);
	}

	public function getResponse($write = false){
		if ($write == true) {
			echo $this->response;
		}else{
			return $this->response;
		}
	}

	public function dispatch(){
		$route = $this->getProvider('route');
		$handle = $route->run();
		try {
			if ($handle === false) {
				throw new \Exception('404');
			}
			$this->response = $route->getResponse();
		} catch (\Exception $e) {
			return $this->response = $e->getMessage();
		}
	}

	public function setProvider($name, $provider){
		return $this->providers[$name] = $provider;
	}

	public function getProvider($name){
		return $this->providers[$name];
	}

	public function unProvider($name){
		unset($this->providers[$name]);
	}

}

?>