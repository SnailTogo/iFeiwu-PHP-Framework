<?php
require_once CORE_PATH.'/libs/Phpmin/htmlmin.php';

class Phpstatic extends Common {
	
	function __construct(){
		parent::__construct();
		$this->table = $this->prefix.'items';
	}
	
	protected function postCache1( $request_data )
	{
	    $this->_generate_html('http://'.$request_data['domain'].'/index.php', '../index.html', 'html');
	    $this->_generate_html('http://'.$request_data['domain'].'/about.php', '../about.html', 'html');
	    $this->_generate_html('http://'.$request_data['domain'].'/contact.php', '../contact.html', 'html');
	    $this->_generate_html('http://'.$request_data['domain'].'/blog.php', '../blog.html', 'html');
	    
	    $this->_generate_html('http://'.$request_data['domain'].'/index.php?mobile=1', '../m/index.html', 'html');
	    $this->_generate_html('http://'.$request_data['domain'].'/about.php?mobile=1', '../m/about.html', 'html');
	    $this->_generate_html('http://'.$request_data['domain'].'/contact.php?mobile=1', '../m/contact.html', 'html');
	    $this->_generate_html('http://'.$request_data['domain'].'/blog.php?mobile=1', '../m/blog.html', 'html');
	    
	    return array('result'=>'success','pages'=>array('index.html','about.html','contact.html','blog.html'));
	}
	
	protected function postCache2( $request_data )
	{
	    $path = '../static/blog';
	    $this->_make_dirs($path);
	    $this->_make_dirs($path.'/m');
	    $blogs = $this->db->GetArray("select id,title from $this->table where alias='6'");
	    foreach ($blogs as $blog) {
	        $id = $blog['id'];
	        $title = $this->_replace_specialchar($blog['title']);
	        $fname = "$title.html";
	        $fname2 = iconv("UTF-8", "GBK", $title).'.html';
	        
	    	$this->_generate_html('http://'.$request_data['domain'].'/blog.php?id='.$id, "$path/$fname2", 'html');
	    	$this->_generate_html('http://'.$request_data['domain'].'/blog.php?mobile=1&id='.$id, "$path/m/$fname2", 'html');
	    	$this->db->AutoExecute($this->table,array('html_name'=>$fname),'UPDATE',"`id`=$id");
	    	
	    	$pages[] = $path.'/'.$fname;
	    	$pages[] = $path.'/m/'.$fname;
	    }
	    
	    $path = '../static/work';
	    $this->_make_dirs($path);
	    $this->_make_dirs($path.'/m');
	    $works = $this->db->GetArray("select id,title from $this->table where alias='5'");
	    foreach ($works as $work) {
	        $id = $work['id'];
	        $title = $this->_replace_specialchar($work['title']);
	        $fname = "$title.html";
	        $fname2 = iconv("UTF-8", "GBK", $title).'.html';
	        
	        $this->_generate_html('http://'.$request_data['domain'].'/index.php?id='.$id, "$path/$fname2", 'html');
	        $this->_generate_html('http://'.$request_data['domain'].'/index.php?mobile=1&id='.$id, "$path/m/$fname2", 'html');
	        $this->db->AutoExecute($this->table,array('html_name'=>$fname),'UPDATE',"`id`=$id");
	        
	        $pages[] = $path.'/'.$fname;
	    	$pages[] = $path.'/m/'.$fname;
	    }
	    
	    return array('result'=>'success','pages'=>$pages);
	}
	
	protected function getCacheclear(){
	    unlink('../index.html');
	    unlink('../about.html');
	    unlink('../contact.html');
	    unlink('../blog.html');
	    unlink('../m/index.html');
	    unlink('../m/about.html');
	    unlink('../m/contact.html');
	    unlink('../m/blog.html');
	    
	    $this->_remove_dirs('../static/');
	    
	    $this->db->AutoExecute($this->table,array('html_name'=>''),'UPDATE',"alias='6'");
	    $this->db->AutoExecute($this->table,array('html_name'=>''),'UPDATE',"alias='5'");
	    
	    return array('result'=>'success');
	}
	
	protected function _generate_html($url, $fname, $ftype='') {

        $string = file_get_contents($url);

        if( $ftype=='html' ) {
            $string = HTMLMin::minify($string);
        }
        	
        $f = fopen($fname, 'w');
        if( fwrite($f, $string)>0 ) {
            return true;
        } else {
            return false;
        }
        fclose($f);
	}
	
	protected function _replace_specialchar($str) {
	    $regex = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";
	    return preg_replace($regex, "", htmlspecialchars_decode($str));
	}
}