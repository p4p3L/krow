<?php namespace Lib\View;

class Render extends ViewCompiler{

	const P_VAR = '#{(\w+)}#';
	const P_IMPORT = '#{@([a-zA-Z0-9-_\/]+)}#';
	const P_SPACE = '#>\s+<#';
	const P_FUNC = '#{(\w+)@([a-zA-Z0-9-_\/\.]+)}#';

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

	private function toFunc(){
		if (preg_match(self::P_FUNC, $this->context)){
			preg_match_all(self::P_FUNC, $this->context, $funcs, PREG_SET_ORDER);
			foreach ($funcs as $key => $func) {
				$keys[$key] = $func[0];
				$data[$key] = call_user_func_array($func[1], (array)$func[2]);
			}
			$this->context = str_replace($keys, $data, $this->context);
		}
	}

	public function compile(){
		$this->toString();
		$this->toImport();
		$this->toFunc();
		$this->toSpaces();
		$this->toString();
	}

	public function makeCache($view_name, $compile = true, $cache_expire = 60){
		$cache = cache($cache_expire);
		$cache_name = md5($view_name);
		if ($cache->expireCache($cache_name)) {
			$cache->setCache($cache_name, $this->make($view_name, $compile));
		}
		return $cache->getCache($cache_name);
	}

	public function make($view_name, $compile = true){
		$this->getContext($view_name);
		if ($compile == true) {
			$this->compile();
		}
		return $this->context;
	}

}

?>