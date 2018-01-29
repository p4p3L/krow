<?php namespace Lib\Http;

class Request{

	public $script;
	public $method;
	public $uri;
	public $url;

	public $requests = [];

	function __construct(){
		$this->script = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->uri = str_replace($this->script, '/', $_SERVER['REQUEST_URI']);
		$this->url = parse_url($this->uri);
		if (isset($this->url['query'])) {
			$this->requests = $_REQUEST;
		}
	}

	public function getRequests(){
		return $this->requests;
	}

	public function getUri(){
		return $this->uri;
	}

	public function getUrl(){
		return $this->url;
	}
	
}

?>