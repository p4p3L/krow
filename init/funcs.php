<?php 

function view(Array $params = null){
	$sess = session('view_params')->get();
	if (sizeof($sess)>0) {
		$params = array_merge((array)$params, $sess);
		unset($sess);
	}
	return new Render(APP_PATH.'/views', $params);
}

function cache($cache_expire = 60){
	return new FileCache(VAR_ROOT.'/caches', $cache_expire);
}

function db(){
	return DB::getInstance();
}

function user(){
	return new \Auth();
}

function assets($file_path){
	return WEB_ROOT.'public/assets/'.$file_path;
}

function esc($str){
	return addslashes(mysql_escape_string($str));
}

function session($key = null, $opts = null){
	return new Session($key, $opts);
}

function old($key){
	$r = $GLOBALS['app']->request;
	return isset($r->request[$key]) ? $r->request[$key] : '';
}
?>