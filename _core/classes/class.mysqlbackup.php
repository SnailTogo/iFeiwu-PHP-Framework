<?php
class MysqlBackup {
    
    private $conn;
    
    private $dbname;
	
	function __construct($dbhost, $dbuser, $dbpass, $dbname)
	{
	    $this->dbname = $dbname;
	    
		$this->conn = mysql_connect($dbhost,$dbuser,$dbpass);
	    mysql_select_db($dbname, $this->conn);
	    mysql_query("SET NAMES 'utf8'");
	}
	
	public function export( $path='sqls/' )
	{
	    if (!is_dir($path)) mkdir($path,0755,true);

	    $tables = mysql_query('SHOW TABLES FROM `'.$this->dbname.'`');
	    
	    while($row=mysql_fetch_row($tables))
	    {
            $table = $row[0];
            $result = mysql_query('SELECT * FROM '.$table);
            $num_fields = mysql_num_fields($result);
            
            $return.= 'DROP TABLE IF EXISTS `'.$table.'`;';
            $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
            $return.= "\n".$row2[1].";\n\n";
            
            for ($i = 0; $i < $num_fields; $i++) 
            {
                while($row = mysql_fetch_row($result))
                {
                    $return.= 'INSERT INTO `'.$table.'` VALUES(';
                    for($j=0; $j<$num_fields; $j++) 
                    {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = str_replace("\n","\\n",$row[$j]);
                        if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                        if ($j<($num_fields-1)) { $return.= ','; }
                    }
                    $return.= ");\n";
                }
            }
            $return.="\n\n";
	    }

	    $handle = fopen($path.'db-backup-'.date('YmdHis',time()).'.sql','w+');
	    if(@fwrite($handle,$return)){
	        return true;
	    } else {
	        return false;
	    }
	    fclose($handle);
	}
	
	public function import( $file_name, $path='sqls/' )
	{
	    $file_path = $path.$file_name;
	    $file = fopen($file_path, "r");
	    $file_str = fread($file, filesize($file_path));
	    
	    $sqls = explode(";\n", $file_str);
	    foreach ($sqls as $sql) {
	        if( !trim($sql) ) {
	            continue;
	        }
	        if (!mysql_query($sql)) {
	           $errors[] = $sql;
	        }
	    }
	    return $errors;
	}
}