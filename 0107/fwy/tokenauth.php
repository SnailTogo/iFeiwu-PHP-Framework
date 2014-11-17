<?php
class TokenAuth implements iAuthenticate{
	
	const KEY = 'txdEUH3DntKEbFfx79tTqP0KpIYDkpwm';
	
	function __isAuthenticated() {
		$token = $_GET['token'];
		return isset($token) && $token==TokenAuth::KEY ? TRUE : FALSE;
	}
	
	function key(){
		return TokenAuth::KEY;
	}
}