<?php

require_once(getcwd().'/init/start.php');

$app = new App(new Router(new Request), APP_PATH);

$app->route->addGet('/', function(){
	//return Home::run('index',[['title' => 'Home Page']]);
	return Home::index(['title' => 'Home Page']);
	//$home = new Home(); return $home->index(['title' => 'Home Page']);
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