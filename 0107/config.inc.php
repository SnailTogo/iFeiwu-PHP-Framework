<?php defined('START_TIME') OR die();

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 0);
ini_set('date.timezone', 'PRC');

// 网站目录设置
define('APP_PATH', dirname(dirname(__FILE__)));
define('CORE_PATH', APP_PATH . '/_core');

//数据库设置
define('DB_DEBUG', 0);
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'works');
define('DB_USER', 'root');
define('DB_PWD', 'root');
define('DB_PORT', 3306);
define('DB_PREFIX', '0107_');

//Cookie设置
define('COOKIE_key', '');
define('COOKIE_expires', time()+60*5);
define('COOKIE_path', '/');
define('COOKIE_domain', '');
define('COOKIE_secure', '');
define('COOKIE_httponly', '');