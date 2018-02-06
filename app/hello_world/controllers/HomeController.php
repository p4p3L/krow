<?php namespace Controllers;

class HomeController extends \Controller{
	
	public function indexAction(Array $params = null){
		return view($params)->make('home.php');
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