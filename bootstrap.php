<?php

//pre-defined network connections,
//constants, etc.

//remember to set user, password, and host of DSN if porting to another system

date_default_timezone_set ('America/Chicago');

error_reporting(E_ALL ^ E_NOTICE);
//error_reporting(0);

session_start();

$_SERVER['DOCUMENT_ROOT'] = realpath(dirname(__FILE__).'/../'); //this is a hack to make doc_root work the same on iis 6 and iis 7
$doc_root = $_SERVER['DOCUMENT_ROOT']; //C:\inetpub\wwwroot

if(strlen($doc_root) < 1){ //$_SERVER['document_root'] isn't defined from CLI
    $doc_root = 'c:\Inetpub\wwwroot';
}

//PEAR library for connecting to MS SQL
$db = $doc_root.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'DB.php';

require_once('DB.php');

//DSN for CSG_Dingo   aka "dsn2"
$user = 'hfrg';
$pass = '*****';
$host = $_SERVER["COMPUTERNAME"] . '\SQLEXPRESS';

$db_name = 'CSG_Dingo';
$dsn_dingo = "mssql://$user:$pass@$host/$db_name"; 

define('DSN_DINGO',$dsn_dingo);
