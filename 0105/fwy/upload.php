<?php
define('START_TIME', microtime(1));
require_once 'cors.inc.php';
require_once '../config.inc.php';
require_once '../functions.inc.php';

$upload_root = '../data'; // 上传路径

if ( !empty($_FILES['images']) )
{
	$handle = new Upload($_FILES['images']);
	if ($handle->uploaded)
	{
	    $act = $_POST['act'];
	    if( $act=='logo' ) {
	        
	    }
	    elseif( $act=='qrcode' ) {
			$handle->file_new_name_body = 'qrcode';
			$handle->file_overwrite = true;
			$handle->Process($upload_root);
		}
		else
		{
		    $file_overwrite = $_POST['file_overwrite'];
		    $image_resize = $_POST['image_resize'];
		    $image_path = $_POST['image_path'];
            $image_path = $image_path?$image_path:date('Y').'/'.date('m').'/'.date('d');
		    
    	    $file_name_body_pre = explode(',',$_POST['file_name_body_pre']);
    	    $image_x  = explode(',',$_POST['image_x']);
    	    $image_y = explode(',',$_POST['image_y']);

    	    foreach ($file_name_body_pre as $key=>$prefix) {
    	        $width = $image_x[$key];
    	        $height = $image_y[$key];
    
    	        if( !empty($prefix) ) {
    	            $handle->image_resize = $image_resize?true:false;
        	        $handle->file_name_body_pre = $prefix;
    	        }
    	        
    	        if( $handle->image_src_x>$width && !empty($width) ) {
    	            $handle->image_x = $width;
    	        } else {
    	            $handle->image_ratio_x = true;
    	        }
    	        
    	        if( $handle->image_y>$height && !empty($height) ) {
    	           $handle->image_y = $height;
    	        } else {
    	            $handle->image_ratio_y = true;
    	        }
    	        
    	        $handle->file_overwrite = $file_overwrite?true:false;
    	        $handle->Process($upload_root.'/'.$image_path);
    	    }
	    }
		
		if ( $handle->processed ) {
			exit(json_encode(array('result'=>'success','image'=>$handle->file_dst_name,'image_path'=>$image_path)));
		} else {
			exit(json_encode(array('result'=>'error')));
		}
	}
} else {
	exit(json_encode(array('result'=>'error_images')));
}