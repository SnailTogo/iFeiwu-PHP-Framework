<?php
class Key extends Item {
	
	function __construct(){
		parent::__construct();
		$this->table = $this->prefix.'keys';
	}
	
	protected function getAll()
	{
	    return $this->db->GetArray("select * from $this->table order by `key` asc");
	}
	
	protected function getOne($id)
	{
	    return $this->db->GetRow("select * from $this->table where `key`=?",array($id));
	}
	
	protected function postState($state, $request_data)
	{
	    $id = $request_data['id'];
	    $result = $this->db->AutoExecute($this->table,array('state'=>$state),'UPDATE',"`key`='$id'");
	    
	    if( $result!==false ) {
	        return array('result'=>'success');
	    } else {
	        return array('result'=>'error');
	    }
	}
	
	protected function postUpdate($id, $request_data)
	{
	    $value = $request_data['value'];
	    $result = $this->db->AutoExecute($this->table,array('value'=>$value),'UPDATE',"`key`='$id'");

	    if( $result!==false ) {
	        return array('result'=>'success');
	    } else {
	        return array('result'=>'error');
	    }
	}
	
	protected function postAdd($request_data)
	{
	    $value = $request_data['value'];
	    $key = $request_data['key'];
	    $result = $this->db->Execute("INSERT INTO $this->table (`state`,`key`,`value`) VALUES ('1', '$key', '$value')");

	    if( $result!==false ) {
	        return array('result'=>'success');
	    } else {
	        return array('result'=>'error');
	    }
	}
	
	protected function postAdd2($request_data)
	{
	    $keys = $request_data['keys'];
	    foreach( $keys as $_key) {
	       $key = $_key['key'];
	       $val = $_key['value'];
	       $count = $this->db->GetOne("select count(*) from $this->table where `key`=?",array($key));
	       if( $count==0 && $key ) {
	           $this->db->Execute("INSERT INTO $this->table (`state`,`key`,`value`) VALUES ('1', '$key', '$val')");
	       }
	    }
	    return array('result'=>'success');
	}
	
	protected function postDelete($request_data)
	{
	    $id = $request_data['id'];
	    $result = $this->db->Execute("delete from $this->table where `key`=?",array($id));
	    
	    if( $result!==false ) {
	        return array('result'=>'success');
	    } else {
	        return array('result'=>'error');
	    }
	}
	
	protected function postDelete2($request_data)
	{
	    $id = $request_data['id'];
	    $result = $this->db->Execute("delete from $this->table where `key` like '$id%'");
	     
	    if( $result!==false ) {
	        return array('result'=>'success');
	    } else {
	        return array('result'=>'error');
	    }
	}
	
}