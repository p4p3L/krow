<?php //error_reporting(~E_ALL);

/*
* ENVIRONMENT - It can be takes two value. This values are development and production.
* If you develop on localhost use development and if your porject was published use production.
*
*/
define('ENVIRONMENT', 'development');

define('ROOT', getcwd());
define('APP_PATH', ROOT.'/app/hello_world');

require_once(ROOT.'/init/boot.php');

$app = new App(new Router(new Request), APP_PATH);

$app->route->addGet('/', function(){
	//return Home::run('index',[['title' => 'Home Page']]);
	return Home::index(['title' => 'Home Page']);
	//$home = new Home();	return $home->index(['title' => 'Home Page']);
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