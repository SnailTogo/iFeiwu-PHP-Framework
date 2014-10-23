<?php
define('START_TIME', microtime(1));
include 'bootstrap.inc.php';

$pn = $_GET['pn'];

if( !$pn ) {
    
} elseif( $pn=='works' ) {
    
    $items = $db->select(DB_PREFIX.'items', array(
        'id',
        'image',
        'image_path'
    ), array(
        'snid' => 11,
        'ORDER' => array('orderby DESC','ctime DESC')
    ));
    $tpl->assign('items', $items);
    
} elseif( $pn=='message' ) {

} elseif( $pn=='weibo' ) {

}

$keys = db_get_keys(array(
    'AND' => array(
        'state' => 1,
        'key' => array(
            'seo_keys',
            'seo_title',
            'seo_desc',
            'home_left_image',
            'home_right_image',
            'global_logo_app',
            'global_favicon_ico',
            'weibo_sina_code'
        )
    )
));


$tpl->assign('keys', $keys);
$tpl->assign('pn', $pn);
$tpl->display('views/index.tpl.php');