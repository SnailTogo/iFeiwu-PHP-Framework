<?php

class Common
{
    protected $db;

    protected $table;
    
    protected $prefix;

    function __construct()
    {
        $this->prefix = DB_PREFIX;
        $this->db = $this->_get_db_connect();
    }

    protected function _get_db_connect()
    {
        $db = NewADOConnection('mysql');
        $db->Connect(DB_HOST.':'.DB_PORT, DB_USER, DB_PWD, DB_NAME) or die('Database connection failed.');
        $db->debug = DB_DEBUG;
        $db->Execute('set names utf8');
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        return $db;
    }

    protected function _get_table_fields()
    {
        return $this->db->MetaColumnNames($this->table, true);
    }

    protected function _save_images($pid, $request_data)
    {
        $img_ids = $request_data['img_ids'];
        $img_orders = $request_data['img_orders'];
        $img_titles = $request_data['img_titles'];
        $img_imgs = $request_data['img_imgs'];
        $img_paths = $request_data['img_paths'];
        $img_states = $request_data['img_states'];
        $data_img['pid'] = $pid;
        $data_img['alias'] = $request_data['alias'] . '_img';
        $data_img['ctime'] = time();
        foreach ($img_ids as $key => $img_id) {
            $data_img['title'] = $img_titles[$key];
            $data_img['orderby'] = $img_orders[$key];
            $data_img['state'] = $img_states[$key];
            if (empty($img_id)) {
                $data_img['state'] = 0;
                $data_img['image'] = $img_imgs[$key];
                $data_img['image_path'] = $img_paths[$key];
                $this->db->AutoExecute($this->table, $data_img, 'INSERT');
                unset($data_img['image'], $data_img['image_path']);
            } else {
                $this->db->AutoExecute($this->table, $data_img, 'UPDATE', "`id`=$img_id");
            }
        }
    }

    protected function _process_items($items)
    {
        foreach ($items as $key=>$item) {
			$items[$key]['cate'] = $this->db->GetRow("select * from ".DB_PREFIX."cates where `id`=?",array($item['pid']));
		}
		return $items;
    }

    protected function _get_html_entity($value)
    {
        if (get_magic_quotes_gpc()) {
            $value = htmlspecialchars(stripslashes((string) $value));
        } else {
            $value = htmlspecialchars((string) $value);
        }
        return $value;
    }

    protected function _make_dirs($path, $mode = 0755)
    {
        if (! is_dir($path)) {
            return mkdir($path, $mode, true);
        }
    }

    protected function _remove_dirs($path)
    {
        if ($handle = opendir($path)) {
            while (false !== ($item = readdir($handle))) {
                if ($item != '.' && $item != '..') {
                    if (is_dir("$path/$item")) {
                        $this->_remove_dirs("$path/$item");
                    } else {
                        unlink("$path/$item");
                    }
                }
            }
            closedir($handle);
            if (rmdir($path)) {
                return true;
            } else {
                return false;
            }
        }
    }

    protected function _log($m)
    {
        file_put_contents(dirname(__FILE__) . '/logs/' . date('Y-m-d'), date('H:i:s', time()) . ' ' . getenv('REMOTE_ADDR') . " $m\n", FILE_APPEND);
    }
}