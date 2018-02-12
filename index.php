<?php

require_once(getcwd().'/init/start.php');

$app = new App(new Router(new Request), APP_PATH);

$app->route->addGet('/', function(){
	return Home::index();
});

$app->route->addGet('/login', function(){
	return User::login();
});

$app->route->addPost('/user/login', function(Request $request){
	if (user()->isOnline()){
		$login = User::doLogin($request);
		if ($login) {
			if ($login['id'] >= 0) {
				$login['admin'] = false;
				$login['logged'] = true;
				$login['last_access_time'] = time();
				user()->setSession($login);
				Redirect::to('/', 303, ['login_response' => true, 'login_message' => 'Giriş Başarılı'], false);
			}
		}
		Redirect::to('/login', 303, ['login_response' => false, 'login_message' => 'Giriş Başarısız'], false);
	}
	Redirect::to('/');
});

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

$response = $app->dispatch();

if ($response == '404') {
	echo view()->makeCache('error_pages/404', true, 0);
}else{
	$app->getResponse(true);
}

//print_r( $app );
//print_r( $route );
//print_r( $_SERVER );

?>