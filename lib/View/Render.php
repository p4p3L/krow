<?php namespace Lib\View;

class Render extends ViewCompiler{

	const P_VAR = '#{(\w+)}#';
	const P_IMPORT = '#{@(\w+)}#';
	const P_SPACE = '#>\s+<#';

	function __construct($view_path = null, Array $params = null){
		parent::__construct($view_path, $params);
	}

	private function toImport(){
		if (preg_match(self::P_IMPORT, $this->context)){
			preg_match_all(self::P_IMPORT, $this->context, $views);
			foreach ($views[0] as $key => $import_key){
				$this->context = str_replace($import_key, $this->getContents($views[1][$key]), $this->context);
			}
			$this->toImport();
		}
	}

	private function toString(){
		if (preg_match(self::P_VAR, $this->context)){
			preg_match_all(self::P_VAR, $this->context, $vars);
			$keys = array_combine($vars[1], $vars[0]);
			$vals = array_intersect_key($this->params, $keys);
			$this->context = str_replace($vars[0], $vals, $this->context);
		}
	}

	private function toSpaces(){
		$this->context = preg_replace(self::P_SPACE, '><', $this->context);
	}

	public function render(){
		$this->toImport();
		$this->toString();
		$this->toSpaces();
	}

	public function makeCache($view_name){
		$cache = cache();
		$cache_name = md5($view_name);
		if ($cache->expireCache($cache_name)) {
			$cache->setCache($cache_name, $this->make($view_name, false));
		}
		echo $cache->getCache($cache_name);
	}

	public function make($view_name, $dump = true){
		$this->getContext($view_name);
		$this->render();
		if ($dump == true) {
			echo $this->context;
		}else{
			return $this->context;
		}
	}

}

?>