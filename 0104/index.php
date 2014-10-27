<?php
define('START_TIME', microtime(1));
include 'bootstrap.inc.php';

$pn = $_GET['pn'];

if( !$pn ) {
    
} elseif( $pn=='works' ) {
    
} elseif( $pn=='message' ) {

} elseif( $pn=='weibo' ) {

}
$snid = 11;
if( $is_mobile ) {
    $snid = 12;
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

$items = $db->select(DB_PREFIX.'items', array(
    'title',
    'image',
    'url',
    'url_target'
), array(
    'snid' => $snid,
    'ORDER' => array('orderby DESC','ctime DESC')
));

$tpl->assign('items', $items);
$tpl->assign('keys', $keys);
$tpl->assign('pn', $pn);

if( $is_mobile ) {
    $tpl->display('views/m_index.tpl.php');
}   else {
    $tpl->display('views/index.tpl.php');
}
