<?php namespace Controllers;

class UserController extends \Controller{
	
	protected $auth = null;

	public function __construct(){
		$this->auth = new \Auth();
	}

	public function getAuthAction(){
		return $this->auth;
	}

}

?>