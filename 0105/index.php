<?php
define('START_TIME', microtime(1));
include 'bootstrap.inc.php';

$pn = $_GET['pn'];

if( !$pn ) {
    
} elseif( $pn=='works' ) {

    $page = $_GET['page'];
    $page = $page?$page-1:0;
    $perpage = 2;
    
    $items = $db->select(DB_PREFIX.'items', array(
        'id',
        'image',
        'image_path'
    ), array(
        'AND'=>array(
            'state' => 1,
            'snid' => 11
        ),
        'ORDER' => array('orderby DESC','ctime DESC'),
        'LIMIT' => array($page*$perpage,$perpage)
    ));
    
    $total = $db->count(DB_PREFIX.'items',array(
        'AND'=>array(
            'state' => 1,
            'snid' => 11
        )
    ));

    $pager = new Pager(array('total'=>$total,'perpage'=>$perpage));
    $pager->next_page = '<i class="icon-arrow-right"></i>';
    $pager->pre_page = '<i class="icon-arrow-left"></i>';
    $tpl->assign('pagebar', $pager->show(7));
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