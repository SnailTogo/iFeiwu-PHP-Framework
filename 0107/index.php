<?php define('START_TIME', microtime(1));
include 'bootstrap.inc.php';

$keys = db_get_keys(array(
    'AND' => array(
        'state' => 1,
        'key' => array(
            'seo_keys',
            'seo_title',
            'seo_desc',
            'header_image_pc',
            'header_image_m',
            'global_logo_app',
            'global_favicon_ico',
            'weibo_sina_code',
            'tongji_code',
            'global_bg_color'
        )
    )
));

if( $is_mobile )
{
    $items = $db->select(DB_PREFIX.'items', array(
        'id',
        'title',
        'image',
        'image_path'
    ), array(
        'AND'=>array(
            'state' => 1,
            'snid' => 11
        ),
        'ORDER' => array('orderby DESC','ctime DESC'),
        'LIMIT' => array(0,4)
    ));
    
    $tpl->assign('items', $items);
    $tpl->assign('keys', $keys);
    $tpl->assign('form_token', form_get_token());
    $tpl->display('views/m_index.tpl.php');
}
else
{
    $page = $_GET['page'];
    $page = $page?$page-1:0;
    $perpage = 2;
    
    $items = $db->select(DB_PREFIX.'items', array(
        'id',
        'title',
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
    $tpl->assign('pagebar', $pager->show(6));
    $tpl->assign('items', $items);
    $tpl->assign('keys', $keys);
    $tpl->assign('form_token', form_get_token());
    $tpl->display('views/index.tpl.php');
}