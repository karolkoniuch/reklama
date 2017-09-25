<?php
//========Security Check=============
if(!defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');

//========Database config============\\
$db_host		= 'localhost';
$db_user		= 'pobieraj_post';
$db_pass		= 'sue3gMrT';
$db_database		= 'pobieraj_post'; 
//===========End config===============\\

//=====Do not edit past this line======\\
$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
mysql_select_db($db_database,$link);
mysql_query("SET names UTF8");

?>