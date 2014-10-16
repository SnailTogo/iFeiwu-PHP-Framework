<?php
class Cate extends Item {
	
	function __construct(){
		parent::__construct();
		$this->table = $this->prefix.'cates';
	}
	
	protected function getAll($pid)
	{
	    return $this->db->GetArray("select * from $this->table where `pid`=? order by orderby desc,ctime desc",array($pid));
	}
}