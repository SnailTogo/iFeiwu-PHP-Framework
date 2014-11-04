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
}

// 数据库
$db_config['database_type'] = DB_TYPE;
$db_config['server'] = DB_HOST;
$db_config['database_name'] = DB_NAME;
$db_config['username'] = DB_USER;
$db_config['password'] = DB_PWD;
$db_config['port'] = DB_PORT;
$db = new Database($db_config);