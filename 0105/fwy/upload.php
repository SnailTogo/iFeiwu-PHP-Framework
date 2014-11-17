<?php
require_once 'cors.inc.php';
require_once '../config.inc.php';
require_once '../functions.inc.php';

$upload_root = '../data';

if ( !empty($_FILES['images']) )
{
	$handle = new Upload($_FILES['images']);
	if ($handle->uploaded)
	{
	    $file_new_name_body = $_POST['file_new_name_body'];
	    $file_overwrite = $_POST['file_overwrite'];
	    $image_resize = $_POST['image_resize'];
	    $file_save_path = $_POST['file_save_path'];
	    
	    if( $image_resize==1 )
	    {
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
    	        if( $file_new_name_body ) $handle->file_new_name_body = $file_new_name_body;
    	        $handle->file_overwrite = $file_overwrite?true:false;
    	        $handle->Process($upload_root.'/'.$file_save_path);
    	    }
	    } else {
	        if( $file_new_name_body ) $handle->file_new_name_body = $file_new_name_body;
	        $handle->file_overwrite = $file_overwrite?true:false;
	        $handle->Process($upload_root.'/'.$file_save_path);
	    }
    }
	
	if ( $handle->processed ) {
		exit(json_encode(array('result'=>'success','image'=>$handle->file_dst_name,'image_path'=>$save_path)));
	} else {
		exit(json_encode(array('result'=>'error')));
	}

} else {
	exit(json_encode(array('result'=>'error_images')));
}