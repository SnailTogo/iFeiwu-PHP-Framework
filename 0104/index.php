<?php
define('START_TIME', microtime(1));
include 'bootstrap.inc.php';

$datas = $db->select("ifeiwu_items", "*");


$tpl->display('views/index.tpl.php');