<?php namespace Lib\Http;

class Redirect{

	public static function buildUrl($url){
		return rtrim(WEB_ROOT, '/').$url.'?'.self::getQueries();
	}

	public static function getQueries(){
		$tails = [
			'browser_id' => session_id(),
			'ip' => $_SERVER['REMOTE_ADDR'],
			'user_agent' => $_SERVER['HTTP_USER_AGENT'],
		];
		if (is_array($_SERVER['QUERY_STRING'])) {
			$tails = array_merge($_SERVER['QUERY_STRING'], $tails);
		}
		return http_build_query($tails);
	}

	public static function to($url = '/', $status = 303){
		header('Location: '.self::buildUrl($url), true, $status);
    	exit();
	}
	
	public static function refresh($url = '/', $sec = 3){
		header('Refresh:'.$sec.'; url='.self::buildUrl($url));
		exit();
	}
}

?>