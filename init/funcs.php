<?php 


function view(Array $params = null){
	return new \Lib\View\Render(APP_PATH.'/views', $params);
}

function viewGet($view_name, Array $params = null){
	$view = view();
	if ($view->hasFile($view_name)) {
		$view->setParams($params);
		echo $view->make($view_name);
	}
}


?>