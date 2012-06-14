<?php
//pre-defined network connections, constants, etc.

/*
    Defaults:

    Database named "Experiment"
    User named "experiment"
    Password "experimentpassword"
*/


date_default_timezone_set ('America/Chicago');
session_start();
error_reporting(E_ALL ^ E_NOTICE);

$_SERVER['DOCUMENT_ROOT'] = realpath(dirname(__FILE__).'/../'); //this is a hack to make doc_root work the same on iis 6 and iis 7
$doc_root = $_SERVER['DOCUMENT_ROOT']; //C:\inetpub\wwwroot

if(strlen($doc_root) < 1){ //$_SERVER['document_root'] isn't defined from CLI
    $doc_root = 'c:\Inetpub\wwwroot';
}

//PEAR library for connecting to MS SQL
$db = $doc_root.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'DB.php';
require_once('DB.php');

//DSN 
$user = 'experiment';
$pass = 'experimentpassword';
$host = $_SERVER["COMPUTERNAME"] . '\SQLEXPRESS';

$db_name = 'Experiment';
$dsn = "mssql://$user:$pass@$host/$db_name";

define('DSN',$dsn);