<?php namespace Lib\Http;

class Redirect{

	public function to($url = '/', $status = 303){
		header('Location: '.rtrim(WEB_ROOT, '/').$url, true, $status);
    	exit();
	}
	
}

?>