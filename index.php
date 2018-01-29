<?php //error_reporting(~E_ALL);

define('ROOT', dirname(__FILE__));
define('APP_PATH', ROOT.'/app/hello_world');

include(ROOT.'/init/boot.php');

use Lib\Application\App as App,
	Lib\Http\Request as Request,
	Lib\Route\Router as Router,
	Controllers\HomeController,
	Controllers\HomeController as Home;

$app = new App(new Router(new Request), APP_PATH);

$app->route->addGet('/', function(){
	return HomeController::run('index');
});

$app->route->addGet('/write/([a-z]+)', function($name){
	return HomeController::run('write', [$name]);
});

$app->route->addGet('/save/([0-9]+)', function(Request $request, $post_id){
	return HomeController::run('save', [$request, $post_id]);
});

$app->route->addPost('/ajax/([a-z]+)', function(Request $request){
	return HomeController::run('save', [$request]);
});

$app->dispatch();
$app->response(true);

//print_r( $app );
//print_r( $route );
//print_r( $_SERVER );

?>