<?php namespace Controllers;

class HomeController extends \Controller{
	
	public function indexAction(){
		return view()->make('home');
	}

}

?>