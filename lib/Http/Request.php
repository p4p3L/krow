<?php namespace Lib\Http;

class Request{

	public $script;
	public $method;
	public $uri;
	public $url;

	public $requests = [];

	function __construct(){
		$this->script = SCRIPT_NAME;
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->uri = str_replace($this->script, '/', $_SERVER['REQUEST_URI']);
		$this->url = parse_url($this->uri);
		$this->requests = $_REQUEST;
	}

	function __get($key){
		if (in_array($key, ['post', 'get', 'request'])) {
			return $this->getRequests($key);
		}
		return $this->{$key};
	}

	public function getRequests($key = null){
		return isset($this->requests[$key]) && !is_null($key) ? $this->requests[$key] : $this->requests;
	}

	public function getUri(){
		return $this->uri;
	}

	public function getUrl(){
		return $this->url;
	}
}

?>