<?php
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Range, Content-Disposition, Content-Type');
header('Access-Control-Allow-Origin: http://ifeiwu.vicp.net');
header('Access-Control-Allow-Credentials: true');

if( $_SERVER['REQUEST_METHOD'] == 'OPTIONS' ){
    exit;
}