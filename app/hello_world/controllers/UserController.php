<?php namespace Controllers;

class UserController extends \Controller{
	
	protected $auth = null;
	protected $model = null;

	public function __construct(){
		$this->auth = new \Auth();
		$this->model = new \UserModel();
	}

	public function getAuthAction(){
		return $this->auth;
	}

	public function loginAction(){
		return view()->make('login');
	}

	public function doLoginAction(\Request $request){
		return $this->model->doLogin(esc($request->get['username']), esc($request->get['password']));
	}

}

?>