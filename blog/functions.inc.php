<?php
/**
 * 网站常用函数不可修改
 */
spl_autoload_register('class_autoload');
function class_autoload($class_name)
{
    $filename = APP_PATH . '/_lib/Includes/class.' . strtolower($class_name) . '.php';
    if (file_exists($filename))
        require $filename;
}

function dump($value)
{
    return '<pre>' . print_r($value, 1) . '</pre>';
}

function redirect($url = '', $code = 302)
{
    header("Location: $url", true, $code);
}

function _log($message)
{
    file_put_contents(__DIR__ . '/data/log/.' . date('Y-m-d'), time() . ' ' . getenv('REMOTE_ADDR') . " $message\n", FILE_APPEND);
}

/**
 * 下面是用户的自定义函数
 */