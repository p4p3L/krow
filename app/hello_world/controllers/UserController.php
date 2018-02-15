<?php namespace Controllers;

class UserController extends \Controller{
	
	protected $model = null;

	public function __construct(){
		$this->model = new \UserModel();
	}

	public function loginAction(){
		return view()->make('login');
	}

	public function doLoginAction(\Request $request){
		return $this->model->doLogin(esc($request->post['username']), esc($request->post['password']));
	}

}

?>