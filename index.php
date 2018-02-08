<?php

require_once(getcwd().'/init/start.php');

$app = new App(new Router(new Request), APP_PATH);

$app->route->addGet('/public/([a-zA-Z0-9-_\/]+\.+([a-z]+))', function($file_path, $ext){
	$file = PUBLIC_ROOT.'/'.$file_path;
	$allowed_exts = [
		'jpg','png','gif',
		'txt','xml','json','pdf',
		'css','js'
	];
	if (file_exists($file) && in_array($ext, $allowed_exts)){
		header('Content-Type:'.(Mime::byExt($ext)).'; charset=utf8');
	}else{
		header('Content-Type:image/gif; charset=utf8');
		$file_path = 'assets/images/404.gif';
	}
	$render = new Render(PUBLIC_ROOT);
	return $render->makeCache($file_path, true, 0);
});

$app->route->addGet('/', function(){
	return Home::index(['title' => 'Home Page']);
});

$app->dispatch();
$app->getResponse(true);

//print_r( $app );
//print_r( $route );
//print_r( $_SERVER );

?>