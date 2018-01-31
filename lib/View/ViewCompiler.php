<?php namespace Lib\View;

class ViewCompiler{

	protected $views_path = null;
	protected $params = [];
	protected $context = null;

	function __construct($view_path = null, Array $params = null){
		$this->views_path = $view_path;
		$this->with($params);
	}

	public function getFilePath($view_name){
		return $this->views_path."/$view_name.php";
	}

	public function hasFile($view_name){
		return file_exists($this->getFilePath($view_name)) ? true : false;
	}

	public function with(Array $params = null){
		if (sizeof($params)>0) {
			$this->params = array_merge($this->params, $params);
		}
		return $this;
	}

	public function getContents($view_name){
		$file_path = $this->getFilePath($view_name);
		if ($this->hasFile($view_name)) {
			ob_start();
			if (sizeof($this->params)>0) {
				extract($this->params);
			}
			require_once($file_path);
			$contents = ob_get_contents();
			ob_end_clean();
			return $contents;
		}
		return false;
	}

	protected function getContext($view_name){
		return $this->context = $this->getContents($view_name);
	}

}

?>