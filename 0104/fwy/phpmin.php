<?php
require_once CORE_PATH.'/libs/Phpmin/CSSMin.php';
require_once CORE_PATH.'/libs/Phpmin/JSMin.php';

class Phpmin extends Common {
	
	function __construct(){
		parent::__construct();
	}
	
	protected function postJs( $request_data )
	{
	    $pages = array();
	    $files = $this->_get_files('../assets/js');
	     
	    foreach ($files as $file) {
	        $type = substr($file, strrpos($file, '.')+1);
	        if( $type!='js' ) continue;
	         
	        $content = file_get_contents($file);
	        file_put_contents($file, JSMin::minify($content));
	        $pages[] = $file;
	    }

	    return array('result'=>'success','pages'=>$pages);
	}
	
	protected function postCss( $request_data )
	{
	    $pages = array();
	    $files = $this->_get_files('../assets/css');
	    
	    foreach ($files as $file) {
	        $type = substr($file, strrpos($file, '.')+1);
	        if( $type!='css' ) continue;
	        
	        $content = file_get_contents($file);
	        file_put_contents($file, CSSMin::minify($content));
	        $pages[] = $file;
	    }
	    
	    return array('result'=>'success','pages'=>$pages);
	}
	
	protected function postImage( $request_data )
	{
	    $pages = array();
	    $files = $this->_get_files('../data');

	    foreach ($files as $file) {
	        
	        $size = ceil(filesize($file)/1000);
	        if( 500>$size ) continue;
	        
	        $info = getimagesize($file);
	        
	        if ($info['mime'] == 'image/jpeg') {
	            $image = imagecreatefromjpeg($file);
	        } elseif ($info['mime'] == 'image/gif') {
	            $image = imagecreatefromgif($file);
	        } elseif ($info['mime'] == 'image/png') {
	            $image = imagecreatefrompng($file);
	        }
	        imagejpeg($image,$file,90);
	        $pages[] = $file;
	    }
	    
	    return array('result'=>'success','pages'=>$pages);
	}
	
	
	protected function _get_files($dir)
	{
	    if (is_file($dir)) {
	        return array($dir);
	    }
	    $files = array();
	    if (is_dir($dir) && ($dir_p = opendir($dir))) {
	        $ds = DIRECTORY_SEPARATOR;
	        while (($filename = readdir($dir_p)) !== false) {
	            if ($filename=='.' || $filename=='..') { continue; }
	            $filetype = filetype($dir.$ds.$filename);
	            if ($filetype == 'dir') {
	                $files = array_merge($files, $this->_get_files($dir.$ds.$filename));
	            } elseif ($filetype == 'file') {
	                $files[] = $dir.$ds.$filename;
	            }
	        }
	        closedir($dir_p);
	    }
	    return $files;
	}

}