<?php
define('START_TIME', microtime(1));
include 'bootstrap.inc.php';

$pid = 1023;
if( $is_mobile ) {
    $pid = 1024;
}

$keys = db_get_keys(array(
    'AND' => array(
        'state' => 1,
        'key' => array(
            'seo_keys',
            'seo_title',
            'seo_desc',
            'global_logo_web',
            'global_logo_app',
            'global_favicon_ico'
        )
    )
));

$items = $db->select("{$db_prefix}items", array(
    'image',
    'url',
    'url_target'
), array(
    'pid' => $pid,
    'ORDER' => 'orderby DESC'
));

$tpl->assign('items', $items);
$tpl->assign('keys', $keys);
$tpl->display('views/index.tpl.php');