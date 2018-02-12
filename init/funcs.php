<?php 

function view(Array $params = null){
	if (sizeof($_SESSION['view_params'])>0) {
		$params = array_merge((array)$params, $_SESSION['view_params']);
		unset($_SESSION['view_params']);
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
	return User::getAuth();
}

function assets($file_path){
	return WEB_ROOT.'public/assets/'.$file_path;
}

function esc($str){
	return addslashes(trim($str));
}

?>