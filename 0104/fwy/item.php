<?php
class Item extends Common {

	function __construct()
	{
		parent::__construct();
		$this->table = $this->prefix.'items';
	}

	protected function postAdd($request_data=null)
	{
		$data['state'] = 1;
		$data['ctime'] = time();
		$data['utime'] = time();
		$fields = $this->_get_table_fields();
		foreach ($fields as $field) {
			$value = $request_data[$field];
			if( $value!==null ) {
				$data[$field]=$value;
			}
		}
		
		$result = $this->db->AutoExecute($this->table,$data,'INSERT');
		
		if( $result!==false ) {
		    
		    $insert_id = $this->db->Insert_ID();
		    
		    if( $request_data['img_ids'] )
		    {
		        $this->_save_images($insert_id, $request_data);
		    }
			return array('result'=>'success','id'=>$insert_id);
		} else {
			return array('result'=>'error');
		}
	}

	protected function postUpdate($id, $request_data)
	{
	    $data['utime'] = time();
	    $fields = $this->_get_table_fields();
	    foreach ($fields as $field) {
	        $value = $request_data[$field];
	        if( $value!==null ) {
	            $data[$field]=$value;
	        }
	    }
	    
	    if( $request_data['img_ids'] ) {
	        $this->_save_images($id, $request_data);
	    }

	    $result = $this->db->AutoExecute($this->table,$data,'UPDATE',"`id`=$id");
	
	    if( $result!==false ) {
	        return array('result'=>'success');
	    } else {
	        return array('result'=>'error');
	    }
	}

	protected function postLimit($page=0,$rows=8,$request_data=null)
	{
		$sql = '';
		if( count($request_data)>1 ) {
			$fields = $this->_get_table_fields();
			foreach($request_data as $key=>$value) {
				if( in_array($key, $fields) ) {
					$sql .= " and $key=?";
					$where[]=$value;
				}
			}
		}
		
		$order = $request_data['order'];
		if( !$order ) {
		    $order = 'orderby desc,ctime desc';
		}
		
		$items = $this->db->SelectLimit("select * from $this->table where 1=1 $sql order by $order",$rows,($page*$rows),$where)->GetArray();
		$total = $this->db->GetOne("select count(id) from $this->table where 1=1 $sql",$where);
		
		return array('items'=>$this->_process_items($items),'pages'=>ceil($total/$rows),'total'=>$total);
	}

	protected function getHot($snid,$page=0,$rows=8)
	{
	    $items = $this->db->SelectLimit("select * from $this->table where snid='$snid' order by clicks desc,orderby desc,ctime desc",$rows,($page*$rows))->GetArray();
	    $total = $this->db->GetOne("select count(id) from $this->table where snid='$snid'");
	
	    return array('items'=>$this->_process_items($items),'pages'=>ceil($total/$rows),'total'=>$total);
	}

	protected function postDeletes($request_data)
	{
	    $ids = $request_data['ids'];
		foreach ($ids as $id) {
		    $item = $this->db->GetRow("select * from $this->table where `id`=?",array($id));
			$result = $this->db->Execute("delete from $this->table where `id`=?",array($id));
			if( $result!==false )
			{
			    $images = $this->db->GetArray("select * from $this->table where `pid`=?",array($id));
			    foreach ($images as $image) {
			        $this->db->Execute("delete from $this->table where `id`=?",array($image['id']));
			        
			        $filename = $image['image'];
			        $path = '../data/'.$image['image_path'];
			        
			        unlink($path.'/'.$filename);
			        unlink($path.'/b_'.$filename);
			        unlink($path.'/m_'.$filename);
			        unlink($path.'/s_'.$filename);
			    }

			    if( $item['file_name'] ) {
			        unlink('../data/'.$item['file_path'].'/'.$item['file_name']);
			    }
			    
			    if( $item['image'] ) {
			        unlink('../data/'.$item['image_path'].'/s_'.$item['image']);
			        unlink('../data/'.$item['image_path'].'/m_'.$item['image']);
			        unlink('../data/'.$item['image_path'].'/b_'.$item['image']);
			        unlink('../data/'.$item['image_path'].'/'.$item['image']);
			    }
			}
		}
		return array('result'=>'success');
	}
	
	protected function postCopy($join_pid,$request_data)
	{
		$ids = $request_data['ids'];
		foreach ($ids as $id) {
			$item = $this->db->GetRow("select * from $this->table where id=?",array($id));
			$old_path = $item['image_path'];
			$new_path = $old_path.'/join';
			$item['image_path'] = $new_path;
			$item['pid'] = $item['snid'] = $join_pid;
			$item['joinid'] = $id;
			$item['id']=null;
			$item['ishome'] = 0;
			$result = $this->db->AutoExecute($this->table,$item,'INSERT');
			if( $result!==false ) {

			    if (!is_dir(UPLOAD_PATH.'/'.$new_path)) {
			        @mkdir(UPLOAD_PATH.'/'.$new_path,0777,true);
			    }
			    
				//添加图片列表
				$insert_id = $this->db->Insert_ID();
				$imgs = $this->db->GetArray("select * from $this->table where `pid`=?",array($id));
				foreach ($imgs as $img) {
				    $img['image_path'] = $new_path;
					$img['pid'] = $insert_id;
					$img['snid'] = $join_pid;
					$img['id'] = null;
					$this->db->AutoExecute($this->table,$img,'INSERT');
					
					//复制一份图片到新目录
					copy("../data/$old_path/s_{$img['image']}", "../data/$new_path/s_{$img['image']}");
					copy("../data/$old_path/m_{$img['image']}", "../data/$new_path/m_{$img['image']}");
					copy("../data/$old_path/b_{$img['image']}", "../data/$new_path/b_{$img['image']}");
					copy("../data/$old_path/{$img['image']}", "../data/$new_path/{$img['image']}");
				}
			}
		}
		return array('result'=>'success');
	}
	
	protected function getOne($id)
	{
		return $this->db->GetRow("select * from $this->table where id=?",array($id));
	}
	
	protected function getOneImgs($id)
	{
		$item = $this->db->GetRow("select * from $this->table where id=?",array($id));
		$imgs = $this->db->GetArray("select * from $this->table where `pid`=? order by orderby desc,ctime desc",array($item['id']));
		
		return array('item'=>$item, 'imgs'=>$imgs);
	}
	
	protected function getAll($snid)
	{
		return $this->db->GetArray("select i.*,c.title as ctitle from $this->table i join {$this->prefix}cates c on c.id==i.pid where i.snid=? order by i.orderby desc,i.ctime desc",array($snid));
	}

	protected function getImgs($pid=null)
	{
		if( $pid ) {
			return $this->db->GetArray("select * from $this->table where `pid`=? order by orderby desc,ctime desc",array($pid));
		} else {
			return array('result'=>'error');
		}
	}
	
	protected function getSearch($snid,$page=0,$rows=8,$skey=null)
	{
		$items = $this->db->SelectLimit("select * from $this->table where snid='$snid' and title like '%$skey%' order by orderby desc,ctime desc",$rows,($page*$rows))->GetArray();
		$total = $this->db->GetOne("select count(id) from $this->table where snid='$snid' and title like '%$skey%'");
		
		return array('items'=>$this->_process_items($items),'pages'=>ceil($total/$rows),'total'=>$total);
	}

	protected function postRemoveImg($id)
	{
		$image = $this->db->GetRow("select pid,image,image_path from $this->table where `id`=?",array($id));
		$result = $this->db->Execute("delete from $this->table where `id`=?",array($id));
		
		if( $result )
		{
		    $image_path = $image['image_path'];
		    $filename = $image['image'];
		    if( !strstr($image_path, 'http://') ) {
    		    $path = '../data/'.$image_path;
    		    unlink($path.'/'.$filename);
    		    unlink($path.'/b_'.$filename);
    		    unlink($path.'/m_'.$filename);
    		    unlink($path.'/s_'.$filename);
		    }

		    $pid = $image['pid'];
		    $item_image = $this->db->GetOne("select `image` from $this->table where `id`=?",array($pid));
		    if( $item_image==$filename ) {
		        $this->db->AutoExecute($this->table,array('image'=>'','image_path'=>''),'UPDATE',"`id`='$pid'");
		    }
		    return array('result'=>'success');
		} else {
		    return array('result'=>'error');
		}
	}
	
	protected function getComments($id)
	{
	    $item = $this->db->GetRow("select title from $this->table where id=?",array($id));	
	    $comments = $this->db->GetArray("select c.*,u.image as user_face,u.uname as user_name from {$this->prefix}comments c join {$this->prefix}users u on c.session_user_id=u.id where c.source_id=$id and c.source_type='items' order by c.ctime desc");

	    foreach($comments as $key=>$comment)
	    {
	        if( $comment['reply_user_id'] )
	        {
	            $reply_user_name = $this->db->GetOne("select `uname` from {$this->prefix}users where `id`=?",array($comment['reply_user_id']));
	            $comments[$key]['user_name'] = $comments[$key]['user_name'];
	            $comments[$key]['reply_user_name'] = $reply_user_name;
	        }
	    }
	    return array('item'=>$item,'comments'=>$comments);
	}
	
	protected function postHome($is, $request_data)
	{
	    $ids = $request_data['ids'];
	    foreach ($ids as $id) {
	        $this->db->AutoExecute($this->table,array('ishome'=>$is),'UPDATE',"`id`=$id");
	    }
	    return array('result'=>'success');
	}
	
	protected function postState($state, $request_data)
	{
	    $ids = $request_data['ids'];
	    foreach ($ids as $id) {
	        $this->db->AutoExecute($this->table,array('state'=>$state),'UPDATE',"`id`=$id");
	    }
	    return array('result'=>'success');
	}
	
	protected function getOrder($id, $val)
	{
	    $resule = $this->db->AutoExecute($this->table,array('orderby'=>$val),'UPDATE',"`id`=$id");
	    
	    if( $resule!==false ){
	        return array('result'=>'success');
	    } else {
	       return array('result'=>'error');
	    }
	}

}