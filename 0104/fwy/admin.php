<?php
require_once CORE_PATH.'/classes/class.passwordhash.php';

class Admin extends Common {

	function __construct(){
		parent::__construct();
		$this->table = $this->prefix.'admins';
	}
	
	//登录验证
	function postLogin($request_data) {
		$uname = $request_data['uname'];
		$pass  = $request_data['pass'];
		if( $uname && $pass ) {
			$admin = $this->db->GetRow("select * from {$this->table} where state=1 and uname=?",array($uname));
			if( $admin ) {
				$hasher = new PasswordHash(8, false);
				if( $hasher->CheckPassword($pass, $admin['pass']) ) {
					unset($admin['pass']);
					
					
					$id = $admin['id'];
					$logins = $this->db->GetOne("select logins from $this->table where id=?",array($id));
					$this->db->AutoExecute($this->table,array('last_time'=>time(),'last_ip'=>'','logins'=>$logins+1),'UPDATE',"`id`=$id");
					
					//用户配置
					$keys = $this->getKeys();
					
					//用户导航
					$navs = $this->db->GetArray("select * from {$this->prefix}navs where pid=0 and `state`=1 order by orderby asc");
					foreach ($navs as $i=>$nav) {
					    $navs[$i]['snavs'] = $this->db->GetArray("select * from {$this->prefix}navs where pid={$nav['id']} and `state`=1 order by orderby asc");
					}
					return array('result'=>'success_login', 'keys'=>$keys, 'navs'=>$navs, 'admin'=>$admin);
				} else {
					return array('result'=>'error_password');
				}
			} else {
				return array('result'=>'error_username');
			}
		} else {
			return array('result'=>'invalid');
		}
	}
	
	//修改管理员密码
	protected function postUpdatePassword($request_data) {
		
		$hasher   = new PasswordHash(8, false);
		$uname    = $request_data['uname'];
		$pass_new = $request_data['pass_new'];
		
		$result   = $this->db->AutoExecute($this->table,array('pass'=>$hasher->HashPassword($pass_new)),'UPDATE',"`uname`='$uname'");
		
		if( $result!==false ) {
			return array('result'=>'success');
		} else {
			return array('result'=>'error');
		}
	}
	
	//添加管理员
	protected function postAdd($request_data) {
		
		$hasher = new PasswordHash(8, false);
		$data['uname'] = $request_data['uname'];
		$data['pass']  = $hasher->HashPassword($request_data['pass']);
		$data['state'] = $request_data['state']?$request_data['state']:0;
		
		if( $request_data['issuper'] ) {
		  $data['issuper'] = $request_data['issuper'];
		}

		$result = $this->db->AutoExecute($this->table,$data,'INSERT');
		
		if( $result!==false ) {
			return array('result'=>'success');
		} else {
			return array('result'=>'error');
		}
	}
	
	//修改管理员
	protected function postUpdate($id, $request_data) {
		
		$hasher = new PasswordHash(8, false);

		$data['state'] = $request_data['state']?$request_data['state']:0;
		
	    if( $request_data['issuper'] ) {
		  $data['issuper'] = $request_data['issuper'];
		}
		
		$pass          = $request_data['pass'];
		if( $pass ) {
			$data['pass'] = $hasher->HashPassword($pass);
		}
		
		$result = $this->db->AutoExecute($this->table,$data,'UPDATE',"`id`=$id");
	
		if( $result!==false ) {
			return array('result'=>'success');
		} else {
			return array('result'=>'error');
		}
	}
	
	//管理员状态设置
    protected function postState($state, $request_data)
	{
	    $ids = $request_data['ids'];
	    foreach ($ids as $id) {
	        $this->db->AutoExecute($this->table,array('state'=>$state),'UPDATE',"`id`=$id");
	    }
	    return array('result'=>'success');
	}
	
	//获取一个管理员
	protected function getOne($id) {
		$result = $this->db->GetRow("select * from {$this->table} where id=?",array($id));
		return $result;
	}
	
	//获取所有管理员
	protected function getAll() {
	    return $this->db->GetArray("select * from {$this->table}");
	}

	//获取所有普通管理员
	protected function getAll2() {
	    return $this->db->GetArray("select * from {$this->table} where issuper=?",array(0));
	}
	
	//删除管理员
	protected function postDeletes($request_data) {
	
	   $ids = $request_data['ids'];
	    foreach ($ids as $id) {
	        $result = $this->db->Execute("delete from {$this->table} where `id`=?",array($id));
	    }
	    
        if( $result!==false ) {
        	return array('result'=>'success');
        } else {
        	return array('result'=>'error');
        }
	}
	
	//系统升级
	protected function postUpgrade($request_data) {
	    $filename = $request_data['filename'];
	    $content = $request_data['content'];
	    if( $filename && $content ) {
    	    @chmod($filename, 0755);
    	    @file_put_contents($filename,$content);
    	    @chmod($filename, 0444);
    	    return array('result'=>'success');
	    } else {
        	return array('result'=>'error');
        }
	}
	
	//数据库备份
	protected function getSqlbackup()
	{
	    require_once LIB_PATH.'/Classes/mysqlbackup.class.php';
	    
	    $mb = new MysqlBackup(DB_HOST,DB_USER,DB_PWD,DB_NAME);
	    $result = $mb->export();
	    
	    if( $result!==false ) {
	        return array('result'=>'success');
	    } else {
	        return array('result'=>'error');
	    }
	}
	
	//导入SQL文件
	protected function getSqlreply($filename)
	{
	    require_once LIB_PATH.'/Classes/mysqlbackup.class.php';
	     
	    $mb = new MysqlBackup(DB_HOST,DB_USER,DB_PWD,DB_NAME);
	    $errors = $mb->import($filename);

	    if( !$errors ) {
	        return array('result'=>'success');
	    } else {
	        return array('result'=>'error');
	    }
	}
	
	//备份的SQL文件
	protected function getSqlfile()
	{
	    $dir = 'sqls/';
	    if (false != ($handle = opendir ( $dir ))) {
	        while ( false !== ($file = readdir ( $handle )) ) {
	            if ($file != "." && $file != ".." && strpos($file,".")) {
	                $stat = stat($dir.$file);
	                $files[] = array('name'=>$file,'size'=>$stat['size'],'ctime'=>$stat['ctime']);
	            }
	        }
	        closedir ( $handle );
	    }
	    return array_reverse($files);
	}
	
	//删除SQL文件
	protected function getSqldelete($filename)
	{
	    if( unlink("sqls/$filename")!==false ) {
	        return array('result'=>'success');
	    } else {
	        return array('result'=>'error');
	    }
	}
	
	//保存元数据
	protected function postSavekeys($request_data=null)
	{
	    $lang = $request_data['lang'];
	    unset($request_data['lang']);
	    
	    if( $lang ) {$_where = "and `lang`='$lang'";}
	    
	    foreach ($request_data as $key=>$value) {
	        $this->db->AutoExecute($this->prefix.'keys',array('value'=>$value),'UPDATE',"`key`='$key' $_where");
	    }
	    return array('result'=>'success');
	}
	
	//获取元数据
	protected function getKeys()
	{
	    $keys = $this->db->GetArray("select `key`,`value` from {$this->prefix}keys where `state`=1");
	    foreach ($keys as $key=>$value) {
	        $lang = $value['lang'];
	        if( $lang ) {
	            $result[$lang.'_'.$value['key']] = $value['value'];
	        } else {
	            $result[$value['key']] = $value['value'];
	        }
	    }
	    return $result;
	}
	
	//获得需要编码的PHP接口源代码
	protected function getSourcephp() {
	    $dir = '.';
	    $handle = opendir($dir);
	    if($handle) {
	        while(false !== ($file = readdir($handle))) {
	            if ($file != '.' && $file != '..') {
	                $filename = $dir . '/'  . $file;
	                if(is_file($filename) && strpos($filename,'.php')) {
	                    $file_content = file_get_contents($filename);
	                    $files[] = array('filename'=>$filename,'content'=>$file_content);
	                }
	            }
	        }
	        closedir($handle);
	        return array('result'=>'success','files'=>$files);
	    } else {
	        return array('result'=>'error');
	    }
	}

}