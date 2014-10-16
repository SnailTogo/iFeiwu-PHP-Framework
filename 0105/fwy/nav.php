<?php
class Nav extends Item {
	
	function __construct(){
		parent::__construct();
		$this->table = $this->prefix.'navs';
	}
	
	protected function getAll()
	{
	    $navs = $this->db->GetArray("select * from $this->table where pid=0 order by orderby asc");
	    foreach ($navs as $i=>$nav) {
	        $navs[$i]['snavs'] = $this->db->GetArray("select * from $this->table where pid={$nav['id']} order by orderby asc");
	    }
	    return $navs;
	}
	
	protected function postDelete($request_data)
	{
	    $id = $request_data['id'];
	    $sub_navs = $this->db->GetArray("select * from $this->table where `pid`=?",array($id));
	    
	    if( count($sub_navs)>0 ) {
	        $result = false;
	    } else {
	        $result = $this->db->Execute("delete from $this->table where `id`=?",array($id));
	    }

	    if( $result!==false ) {
	        return array('result'=>'success');
	    } else {
	        return array('result'=>'error');
	    }
	}
	
}