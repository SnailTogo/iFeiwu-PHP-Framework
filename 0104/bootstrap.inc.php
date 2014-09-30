<?php defined('START_TIME') OR die();

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 0);
ini_set('date.timezone', 'PRC');

// 网站根目录
define('APP_PATH', dirname(dirname(__FILE__)));
define('CORE_PATH', APP_PATH . '/_core');

// 常用函数库和自动加载类库
require 'functions.inc.php';

// 数据库、Session、Cookie等配置
$config = include 'config.inc.php';
$db_prefix = $config['db']['prefix']; 

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
$db_config['database_type'] = $config['db']['type'];
$db_config['server'] = $config['db']['host'];
$db_config['database_name'] = $config['db']['name'];
$db_config['username'] = $config['db']['user'];
$db_config['password'] = $config['db']['pwd'];
$db_config['port'] = $config['db']['port'];
$db_config['charset'] = $config['db']['charset'];
$db = new Database($db_config);