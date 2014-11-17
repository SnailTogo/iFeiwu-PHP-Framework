<?php
class Message extends Item {

	function __construct(){
		parent::__construct();
		$this->table  = DB_PREFIX.'messages';
	}

}