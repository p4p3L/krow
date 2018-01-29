<?php namespace Lib\View;

class Render{

	protected $views_path = null;
	protected $context = null;
	protected $params = [];

	function __construct($view_path = null, Array $params = null){
		$this->views_path = $view_path;
		$this->with($params);
	}

	public function with(Array $params = null){
		if (sizeof($params)>0) {
			$this->params = array_merge($this->params, $params);
		}
		return $this;
	}

	public function hasFile($view_name){
		return file_exists($this->getFilePath($view_name));
	}

	protected function getFilePath($view_name){
		return $this->views_path."/$view_name.php";
	}

	public function make($view_name){
		return $this->getContext($view_name);
	}

	protected function getContext($view_name){
		$file_path = $this->getFilePath($view_name);
		if ($this->hasFile($view_name)) {
			ob_start();
			extract($this->params);
			require_once($file_path);
			$this->context = ob_get_contents();
			ob_end_clean();
			return $this->context;
		}
		return false;
	}

}

?>