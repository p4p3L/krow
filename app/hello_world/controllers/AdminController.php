<?php namespace Controllers;

class AdminController extends \Controller{
	
	public function indexAction(){
		return view()->with([
			'title' 		=> 'Dashboard',
			'page_title' 	=> 'Dashboard',
			'page'			=> 'admin/pages/dashboard'
		])
		->make('admin/master.php');
	}

	public function loginAction(){
		return view()->with([
			'title' 		=> 'Login',
			'page_title' 	=> 'Login',
			'page'			=> 'admin/pages/login'
		])
		->make('admin/master.php');
	}

}

?>