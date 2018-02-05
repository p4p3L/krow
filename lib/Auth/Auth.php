<?php namespace Lib\Auth;

class Auth{

	protected $session = null;
	protected $is_online = false;

	function __construct(){
		if ($this->isOnline()) {
			$this->assignCurrentSession();
		}
	}

	public function getSession(){
		return $this->session;
	}

	public function setSession(Array $settings = null){
		$_SESSION['auth'] = $settings;
		$this->session = $_SESSION['auth'];
	}

	public function assignCurrentSession(){
		$this->setSession($_SESSION['auth']);
	}

	public function logout($url = '/'){
		unset($_SESSION['auth']);
		Redirect::to($url);
	}

	public function isLogged(){
		if (isset($_SESSION['auth']) && $_SESSION['auth']['logged'] == true) {
			return true;
		}
		return false;
	}

	public function isExpired(){
		$expire = time()-$_SESSION['auth']['last_access_time'];
		if ($expire<300) {
			$_SESSION['auth']['last_access_time'] = time();
			return false;
		}
		return true;
	}

	public function isOnline(){
		if ($this->isLogged()) {
			if ($this->isExpired() != true) {
				$this->is_session = true;
				return true;
			}
		}
		return false;
	}

}

?>