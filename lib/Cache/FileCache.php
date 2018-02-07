<?php namespace Lib\Cache;

class FileCache{

	protected $compiler;

	protected $cache_path;
	protected $cache_expire = 60;

	function __construct($cache_path = null, $cache_expire = 60){
		$this->cache_path = $cache_path;
		if (!is_dir($this->cache_path)) {
			mkdir($this->cache_path);
			chmod($this->cache_path, 0755);
		}
		$this->cache_expire = $cache_expire;
		$this->compiler = new \ViewCompiler($this->cache_path);
	}

	public function setCache($cache_key, $contents){
		$cache_file = $this->getCacheFilePath($cache_key);
		if ($this->compiler->hasFile($cache_key) == false) {
			touch($cache_file);
			chmod($cache_file, 0755);
		}
		file_put_contents($cache_file, $contents);
	}

	public function getCache($cache_key){
		return ($this->compiler->hasFile($cache_key) == true) ? $this->compiler->getContents($cache_key) : false;
	}

	public function expireCache($cache_key){
		$cache_file = $this->getCacheFilePath($cache_key);
		return (@filemtime($cache_file)<(time()-$this->cache_expire)) ? true : false;
	}

	public function getCacheFilePath($cache_key){
		return $this->compiler->getFilePath($cache_key);
	}

}

?>