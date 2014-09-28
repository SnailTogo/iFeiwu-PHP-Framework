<?php defined('START_TIME') OR die();

return array(

    // 在开发中，开启调试模式的错误信息
    'debug_mode' => TRUE,

    // 数据库设置
    'db' => array(
        'database_type' => 'mysql',
        'database_name' => 'ifeiwu',
        'server' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'port' => 3306,
        'charset' => 'utf8',
        'password' => 'root',
        'option' => array(
            PDO::ATTR_CASE => PDO::CASE_NATURAL
        )
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