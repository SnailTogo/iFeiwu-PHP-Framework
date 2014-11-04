<?php
class TokenAuth implements iAuthenticate{
	
	const KEY = 'Jgq69CKhy54Tl0Gy5x8CY8HyBivKWuZa';
	
	function __isAuthenticated() {
		$token = $_GET['token'];
		return isset($token) && $token==TokenAuth::KEY ? TRUE : FALSE;
	}
	
	function key(){
		return TokenAuth::KEY;
	}
}