<?php 

function view(Array $params = null){
	return new Render(APP_PATH.'/views', $params);
}

function viewGet($view_name, Array $params = null){
	$view = view();
	if ($view->hasFile($view_name)) {
		$view->with($params);
		echo $view->make($view_name);
	}
}

function cache(){
	return new FileCache(VAR_ROOT.'/caches');
}

function db(){
	return DB::getInstance();
}

?>