<?php defined('START_TIME') OR die();

// 常用函数库和自动加载类库
include 'config.inc.php';
require 'functions.inc.php';

// 模板引擎
$tpl = new Template(array(
    'template_path' => 'views',
    'resource_path' => 'widget'
));

// 移动检测
$is_mobile = $_GET['mobile'];
$detect = new MobileDetect;
if( !$is_mobile ) {
    $is_mobile = $detect->isMobile() && !$detect->isTablet()?true:false;
    $tpl->assign('is_mobile', $is_mobile);
}

// 数据库
$db = db_get_connect();