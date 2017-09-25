<?php
define('INCLUDE_CHECK',true);
require 'connect.php';
	$username = $session->username;
	$SQL = "SELECT * FROM users WHERE username='$username'";
	$result = mysql_query($SQL);
	$num_rows = mysql_num_rows($result);
		while ($num_rows = mysql_fetch_array($result) ) {
		$wydal = $num_rows['wydal'];
		$reklama= $num_rows['reklama'];
		echo "Pozostało Ci <b>$reklama</b> reklam!<br>Zleciłeś <b>$wydal</b> reklam<br>";
	}
?>