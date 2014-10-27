<?php
class TokenAuth implements iAuthenticate{
	
	const KEY = 'U4uXyjU1YpGuPyq9s047hjbtuZGBc7F1';
	
	function __isAuthenticated() {
		$token = $_GET['token'];
		return isset($token) && $token==TokenAuth::KEY ? TRUE : FALSE;
	}
	
	function key(){
		return TokenAuth::KEY;
	}
}