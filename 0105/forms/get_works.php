<?php
define('START_TIME', microtime(1));
include '../config.inc.php';
require '../functions.inc.php';

$id = $_GET['id'];

if( $id ) {
    $db = db_get_connect();
    $item = $db->get(DB_PREFIX.'items',array('title','content'),array('id'=>$id));
    $item['content'] = htmlspecialchars_decode($item['content']);
    $imgs = $db->select(DB_PREFIX.'items',array('image','image_path'),array('pid'=>$id));
    exit(json_encode(array('item'=>$item,'imgs'=>$imgs)));
}