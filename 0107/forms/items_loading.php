<?php define('START_TIME', microtime(1));
include '../config.inc.php';
require '../functions.inc.php';

$tpl = new Template(array(
    'template_path' => '../views',
    'resource_path' => '../widget'
));
$db  = db_get_connect();

$page = Request::get('page');
$page = empty($page)?1:$page;
$perpage = 4;

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

$pages = ceil($total/$perpage);//总页数
$next_page = $page+1;

//计算是否有下一页
if( $pages==$next_page ) {
    $next_page=0;
} elseif( $pages==1 ) {
    $next_page=0;
}

$tpl->assign('items', $items);

exit(json_encode(array('page'=>$next_page, 'html'=>$tpl->fetch('items_loading.tpl.php'))));