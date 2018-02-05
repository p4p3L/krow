<?php namespace Controllers;

class DashboardController extends \Controller{
	
	public function indexAction(){
		return view(['title' => 'Dashboard'])->make('dashboard');
	}

	public function loginAction(){
		return view(['title' => 'Giriş Yap'])->make('dashboard');
	}

}

?>