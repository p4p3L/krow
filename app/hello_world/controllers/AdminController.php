<?php namespace Controllers;

class AdminController extends \Controller{
	
	public function indexAction(){
		return view([
			'title' 		=> 'Dashboard',
			'page_title' 	=> 'Dashboard',
			'page'			=> 'admin/pages/dashboard'
		])->make('admin/master');
	}

	public function loginAction(){
		return view([
			'title' 		=> 'Login',
			'page_title' 	=> 'Login',
			'page'			=> 'admin/pages/login'
		])->make('admin/master');
	}

}

?>