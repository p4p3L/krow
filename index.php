<?php

require_once(getcwd().'/init/start.php');

$app = new App(new Router(new Request), APP_PATH);

$app->route->addGet('/', function(){
	return Home::index(['title' => 'Home Page']);
});

$app->route->addGet('/public/([a-zA-Z0-9-_\/]+\.+([a-z]+))', function($file_path, $ext){
	$file = PUBLIC_ROOT.'/'.$file_path;
	/*
	if (is_file($file)) {
		header("content-type:text/$ext; charset=utf8");
		return file_get_contents($file);
	}
	*/
	$render = new Render(PUBLIC_ROOT);
	return $render->make($file_path, false);
});

$app->route->addGet('/write/([a-z]+)', function($name){
	return Home::run('write', [$name]);
});

$app->route->addGet('/save/([0-9]+)', function(Request $request, $post_id){
	return Home::run('save', [$request, $post_id]);
});

$app->route->addPost('/ajax/([a-z]+)', function(Request $request){
	return Home::run('save', [$request]);
});

$app->dispatch();
$app->getResponse(true);

//print_r( $app );
//print_r( $route );
//print_r( $_SERVER );

?>