<?php
define('START_TIME', microtime(1));

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 0);
ini_set('date.timezone', 'PRC');

define('APP_PATH', dirname(dirname(__FILE__)));
define('CORE_PATH', APP_PATH . '/../_core');

spl_autoload_register('class_autoload');
function class_autoload($class_name)
{
    $filename = CORE_PATH . '/classes/class.' . strtolower($class_name) . '.php';
    if (file_exists($filename))
        require $filename;
}

require_once CORE_PATH.'/libs/Restler/restler.php';
require_once CORE_PATH.'/libs/Adodb/adodb.inc.php';

spl_autoload_register('spl_autoload');
$r = new Restler();
$r->setSupportedFormats('JsonFormat', 'XmlFormat');
$r->addAPIClass('Item');
$r->addAPIClass('Nav');
$r->addAPIClass('Key');
$r->addAPIClass('Cate');
$r->addAPIClass('Admin');
$r->addAPIClass('Phpstatic');
$r->addAPIClass('Phpmin');
$r->addAuthenticationClass('TokenAuth');
$r->handle();