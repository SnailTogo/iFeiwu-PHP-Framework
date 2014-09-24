<?php defined('START_TIME') OR die();

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('date.timezone', 'PRC');

// 定义请求开始的时间戳


// 网站根目录
define('APP_PATH', dirname(dirname(__FILE__)));
define('CORE_PATH', APP_PATH . '/_core');

// 常用函数库和自动加载类库
require 'functions.inc.php';

// 数据库、Session、Cookie等配置
$config = include 'config.inc.php';

// 模板引擎
$tpl = new Template(array(
    'template_path' => 'views',
    'resource_path' => 'widget'
));

// 移动检测
$detect = new MobileDetect;
// $detect->isMobile();
// $detect->isTablet();

// 数据库
$db = new Database($config['db']);