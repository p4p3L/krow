<?php

require_once(getcwd().'/init/start.php');

$app = new App(new Router(new Request), APP_PATH);

$app->route->addRule('/yonetim/(?!login)(.*)', function(){
	if (user()->isOnline() == true) {
		return true;
	}
	Redirect::to('/yonetim/login');
});

$app->route->addGet('/yonetim/dashboard', function(){
	return Admin::index();
});

$app->route->addGet('/yonetim/login', function(){
	return Admin::login();
});

$app->dispatch();
$app->getResponse(true);

//print_r( $app );
//print_r( $route );
//print_r( $_SERVER );

?>

