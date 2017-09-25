<?php
define('INCLUDE_CHECK',true);
include 'connect.php';
$ref = $session->username;

$SQL = "SELECT * FROM `logi` WHERE username = '$ref' ORDER BY id DESC";
$result = mysql_query($SQL);
$num_rows = mysql_num_rows($result);
if ($num_rows > 0){
echo "<center><br><table align='center' border='1'width='600' >";
echo "<tr><th>Data</th><th>Zdarzenie</th>";
while ($num_rows = mysql_fetch_array($result) ) {
$date = $num_rows['date'];
$date = date("d - m - Y | G:i:s", $date);
$text = $num_rows['text'];
echo "<tr><td align='center'>".$date."</td><td align='center'>".$text."</td></tr>";
}
echo '</table>';
}
else
{
echo 'Brak zdarzen';
}
?>
