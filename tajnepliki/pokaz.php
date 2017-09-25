<?php
define('INCLUDE_CHECK',true);
if(!$session->logged_in){
	header("Location: index.php");
    }
include 'connect.php';
$id = $_GET['pokaz'];
$ref = $session->username;
if (isset($id) && (is_numeric($id))) {

$SQL = "SELECT linki, username FROM `reklama` WHERE id = '$id'";
$result = mysql_query($SQL);
$num_rows = mysql_num_rows($result);
if ($num_rows > 0){
	while ($num_rows = mysql_fetch_array($result) ) {
	$linki = $num_rows['linki'];
	$user = $num_rows['username'];
	}
}
if ($user == $ref) {
echo '<center><textarea name="linki" id="styled">'.$linki.'</textarea></center>';
}
else
{
echo 'To nie sa twoje linki!';
}

}
?>