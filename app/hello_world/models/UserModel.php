<?php namespace Models;

class UserModel{
	
	function __construct(){}

	public function doLogin($username, $password){
		return \DB::row("SELECT * FROM users WHERE username = '$username' AND pass = '$password' AND status = 1 LIMIT 1");
	}

}

?>