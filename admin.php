<?php

require_once(getcwd().'/init/start.php');

$app = new App(new Router(new Request), APP_PATH);

// Rules
$app->route->addRule('/yonetim/(?!login)(.*)', function(){
	if (user()->isOnline() != true) {
		Redirect::to('/yonetim/login');
	}
	return true;
});

// Routes
$app->route->addGet('/yonetim/dashboard', function(){
	//return Home::run('index',[['title' => 'Home Page']]);
	//return Home::index(['title' => 'Admin Home Page']);
	//$home = new Home(); return $home->index(['title' => 'Home Page']);
});

$app->route->addGet('/yonetim/login', function(){
	return 'Login';
});

$app->dispatch();
$app->getResponse(true);

//print_r( $app );
//print_r( $route );
//print_r( $_SERVER );

?>