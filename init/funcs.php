<?php 

function view(Array $params = null){
	return new Render(APP_PATH.'/views', $params);
}

function cache($cache_expire = 60){
	return new FileCache(VAR_ROOT.'/caches', $cache_expire);
}

function db(){
	return DB::getInstance();
}

function user(){
	return User::getAuth();
}

function assets($file_path){
	return WEB_ROOT.'public/assets/'.$file_path;
}

?>