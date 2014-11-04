<?php
define('START_TIME', microtime(1));
require_once '../config.inc.php';
require_once '../functions.inc.php';
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