<?php namespace Controllers;

class HomeController extends \Controller{
	
	public function index(Array $params = null){
		return view($params)->make('home');
	}

	public function write($name){
		return $name;
	}

	public function save(\Request $request, $id){
		print_r( $request );
		return $id;
	}

}

?>