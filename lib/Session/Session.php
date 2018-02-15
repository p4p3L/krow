<?php namespace Lib\Session;

class Session{

	protected $key = null;
	protected $data = null;

	function __construct($key = null, $data = null){
		if(session_id() == '') {
		    session_start();
		}
		if (!is_null($key)) {
			$this->key = $key;
		}
		if (!is_null($data)) {
			$this->data = $data;
		}
	}

	function __toString(){
		return $this->current();
	}

	function __set($key, $value){
		if ($this->exists() == false) {
			$_SESSION[$this->key] = [];
		}
		$_SESSION[$this->key][$key] = $value;
	}

	function __get($key){
		return $this->current()[$key];
	}

	public function exists($key = null){
		$values = $this->get($key);
		return $values ? true : false;
	}

	public function get($key = null){
		return is_null($key) ? $_SESSION[$this->key] : $_SESSION[$key];
	}

	public function set(){
		$_SESSION[$this->key] = $this->data;
	}

	public function current(){
		return $this->get();
	}

	public function with($data){
		$this->data = $data;
		$this->set();
	}

	public function destroy(){
		session_unset();
		session_destroy();
	}

}

?>