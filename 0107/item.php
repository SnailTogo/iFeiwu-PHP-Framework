<?php
define('START_TIME', microtime(1));
include 'bootstrap.inc.php';

$id = $_GET['id'];

if( $id ) {
    $db = db_get_connect();
    $item = $db->get(DB_PREFIX.'items',array('title','content'),array('id'=>$id));
    $item['content'] = htmlspecialchars_decode($item['content']);
    $imgs = $db->select(DB_PREFIX.'items',array('image','image_path'),array('pid'=>$id));
    $tpl->assign('item', $item);
    $tpl->assign('imgs', $imgs);
}
$tpl->display('views/item.tpl.php');