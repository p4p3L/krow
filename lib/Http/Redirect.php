<?php namespace Lib\Http;

class Redirect{

	protected $param = null;

	public static function buildUrl($url, $tails = true){
		$real_url = rtrim(WEB_ROOT, '/').$url;
		return ($tails == true) ? $real_url.'?'.self::getQueries() : $real_url;
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

	public static function to($url = '/', $status = 303, Array $params = null, $tails = true){
		if (sizeof($params>0)) {
			session('view_params', $params)->set();
		}
		header('Location: '.self::buildUrl($url, $tails), true, $status);
    	exit();
	}
	
	public static function refresh($url = '/', $sec = 3, $tails = true){
		header('Refresh:'.$sec.'; url='.self::buildUrl($url, $tails));
		exit();
	}
}

?>