<?php namespace Lib\Auth;

class Auth{

	protected $session = null;
	protected $session_data = null;

	function __construct(){
		$this->session = new \Session('auth');
		if ($this->isOnline() == true) {
			$this->assignCurrentSession();
		}
	}

	public function getSession(){
		return $this->session_data;
	}

	public function setSession(Array $settings = null){
		$this->session->with($settings);
		$this->session_data = $settings;
	}

	public function assignCurrentSession(){
		$this->setSession($this->session->get());
	}

	public function logout($url = '/'){
		$this->session->destroy();
		\Redirect::to($url);
	}

	public function isAdmin(){
		return $this->session->admin == true ? true : false;
	}

	public function isLogged(){
		if ($this->session->exists() && $this->session->logged == true) {
			return true;
		}
		return false;
	}

	public function isExpired(){
		$expire = time()-$this->session->last_access_time;
		if ($expire<300) {
			$this->session->last_access_time = time();
			return false;
		}
		return true;
	}

	public function isOnline(){
		if ($this->isLogged()) {
			if ($this->isExpired() != true) {
				return true;
			}else{
				$this->logout();
			}
		}
		return false;
	}

}

?>