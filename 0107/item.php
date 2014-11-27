<?php
define('START_TIME', microtime(1));
include 'bootstrap.inc.php';

$db = db_get_connect();
$id = $_GET['id'];

if( $id ) {
    $item = $db->get(DB_PREFIX.'items',array('title','content'),array('id'=>$id));
    $item['content'] = htmlspecialchars_decode($item['content']);
    $imgs = $db->select(DB_PREFIX.'items',array('image','image_path'),array('pid'=>$id));
    $tpl->assign('item', $item);
    $tpl->assign('imgs', $imgs);
}

$keys = db_get_keys(array(
    'AND' => array(
        'state' => 1,
        'key' => array(
            'tongji_code',
            'email_mailto'
        )
    )
));

$tpl->assign('keys', $keys);
$tpl->display('views/item.tpl.php');