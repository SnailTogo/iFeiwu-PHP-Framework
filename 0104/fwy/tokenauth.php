<?php
class TokenAuth implements iAuthenticate{
	
	const KEY = '5qETOEy2D9xhBVIFbXEuZobvCH44rCcQ';
	
	function __isAuthenticated() {
		$token = $_GET['token'];
		return isset($token) && $token==TokenAuth::KEY ? TRUE : FALSE;
	}
	
	function key(){
		return TokenAuth::KEY;
	}
}