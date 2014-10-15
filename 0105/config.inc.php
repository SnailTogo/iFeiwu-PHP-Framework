<?php defined('START_TIME') OR die();

return array(

    // 在开发中，开启调试模式的错误信息
    'debug_mode' => TRUE,

    // 数据库设置
    'db' => array(
        'debug' => 0,
        'type' => 'mysql',
        'host' => 'localhost',
        'name' => 'works',
        'prefix' => '0105_',
        'user' => 'root',
        'pwd' => 'root',
        'port' => 3306,
        'charset' => 'utf8'
    ),

    // Cookie设置
    'cookie' => array(
        'key' => 'a.very.long.secret.key.here',
        'expires' => time()+60*5, // 30 seconds
        'path' => '/',
        'domain' => '',
        'secure' => '',
        'httponly' => '',
    )

);