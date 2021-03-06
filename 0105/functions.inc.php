<?php defined('START_TIME') OR die();

/**************************************************************************
 * 网站常用函数不可修改
 ***************************************************************************/
spl_autoload_register('class_autoload');
function class_autoload($class_name)
{
    $filename = CORE_PATH . '/classes/class.' . strtolower($class_name) . '.php';
    if (file_exists($filename)) {
        require $filename;
    }
}

function dump($value)
{
    echo '<pre>' . print_r($value, 1) . '</pre>';
}

function redirect($url = '', $code = 302)
{
    header("Location: $url", true, $code);
}

function _log($message)
{
    file_put_contents(__DIR__ . '/data/log/.' . date('Y-m-d'), time() . ' ' . getenv('REMOTE_ADDR') . " $message\n", FILE_APPEND);
}

/**************************************************************************
 * 下面是项目自定义函数
 **************************************************************************/

//连接数据库
function db_get_connect()
{
    $db_config['database_type'] = DB_TYPE;
    $db_config['server'] = DB_HOST;
    $db_config['database_name'] = DB_NAME;
    $db_config['username'] = DB_USER;
    $db_config['password'] = DB_PWD;
    $db_config['port'] = DB_PORT;
    return new Database($db_config);
}

//网站基本数据
function db_get_keys( $where )
{
    global $db;
    if( !$db ) $db = db_get_connect();

    $keys = $db->select(DB_PREFIX.'keys', array('key','value'), $where);
    foreach ($keys as $key=>$val) {
        $value = $val['value'];
        if( !empty($value) ) {
            $data[$val['key']] = $value;
        }
    }
    return $data;
}

//页面导航箭头输出
function tpl_nav_arrow($cur, $def)
{
    if( $cur==$def ){
        echo '<div class="arrow"></div>';
    }
}

//页面选中当前导航
function tpl_nav_active($cur, $def)
{
    if( $cur==$def ){
        echo 'class="active"';
    }
}