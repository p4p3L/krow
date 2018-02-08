<?php namespace Controllers;

class HomeController extends \Controller{
	
	public function indexAction(){
		return view()->make('home');
	}

	public function writeAction($name){
		return $name;
	}

	public function saveAction(\Request $request, $id){
		print_r( $request );
		return $id;
	}

}

?>