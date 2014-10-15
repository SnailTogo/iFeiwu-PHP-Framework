<?php defined('START_TIME') OR die();

/**
 * 网站常用函数不可修改
 */
spl_autoload_register('class_autoload');
function class_autoload($class_name)
{
    $filename = CORE_PATH . '/classes/class.' . strtolower($class_name) . '.php';
    if (file_exists($filename))
        require $filename;
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

/**
 * 下面是项目自定义函数
 */

function db_get_keys( $where ) {
    global $db,$db_prefix;
    $keys = $db->select("{$db_prefix}keys", array('key','value'), $where);
    foreach ($keys as $key=>$val) {
        $value = $val['value'];
        if( !empty($value) ) {
            $data[$val['key']] = $value;
        }
    }
    return $data;
}

/**
 * 页面导航箭头输出
 */
function tpl_nav_arrow($cur, $def) {
    if( $cur==$def ){
        echo '<div class="arrow"></div>';
    }
}

/**
 * 页面选中当前导航
 */
function tpl_nav_active($cur, $def) {
    if( $cur==$def ){
        echo 'class="active"';
    }
}