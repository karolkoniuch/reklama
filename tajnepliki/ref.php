<?php
error_reporting(E_ALL ^ E_NOTICE);
$ref = $session->username;
define('INCLUDE_CHECK',true);
include 'connect.php';

$SQL = "SELECT * FROM ".TBL_USERS." WHERE username = '$ref'";
$result = mysql_query($SQL);
$num_rows = mysql_num_rows($result);
if ($num_rows > 0){
while ($num_rows = mysql_fetch_array($result) ) {
$used = $num_rows['pointsused'];
}
}
$SQL = "SELECT * FROM ".TBL_USERS." WHERE byref = '$ref'";
$result = mysql_query($SQL);
$num_rows = mysql_num_rows($result);
if ($num_rows > 0){
echo "<center><br><table align='center' border='1'width='600' >";
echo "<tr><th>Login</th><th>Kupił Reklam</th><th>Pozyskałeś ePoints</th>";
while ($num_rows = mysql_fetch_array($result) ) {
$rownanie = ($num_rows['wydal'] / 500);
$user = $num_rows['username'];
if ($rownanie >= 10) {
$epoints = 10;
}
elseif ($rownanie >= 9) {
$epoints = 9;
}
elseif ($rownanie >= 8) {
$epoints = 8;
}
elseif ($rownanie >= 7) {
$epoints = 7;
}
elseif ($rownanie >= 6) {
$epoints = 6;
}
elseif ($rownanie >= 5) {
$epoints = 5;
}
elseif ($rownanie >= 4) {
$epoints = 4;
}
elseif ($rownanie >= 3) {
$epoints = 3;
}
elseif ($rownanie >= 2) {
$epoints = 2;
}
elseif ($rownanie >= 1) {
$epoints = 1;
}
elseif ($rownanie >= 0) {
$epoints = 0;
}
$ep += $epoints;
$money += $num_rows['wydal'];
$freepoints = ($ep - $used);
echo "<tr><td align='center'>".$user."</td><td align='center'>".$num_rows['wydal']."</td><td align='center'>".$epoints."</td></tr>";
}
echo "<tr><td align='center'><b>Suma</b></td><td align='center'><b>".$money."</b></td><td align='center'><b>".$ep."</b></td></tr>";
echo '</table></center><br>';
echo '<center><h3>Dostępnych ePoints - <font color=\"#ef5d21\">'.$freepoints.'</font><br /> Zużytych ePoints - <font color="#FF0000">'.$used.'</font></h3></center><br />';
?>
<center>
<form action="/poleceni" method="post"> 
<h3>Zamień ePoints na Reklame </h3><br />
<h2>1 ePoints = 50 Reklam</h2><br />
Ilość: <input name="ilosc" type="text" class="text" align="center" style="width: 30px;" /> 
<input type="submit" name="submit" class="button" value=" ZATWIERDŹ "/><br />
</form>
<?php
if(isset($_POST['submit'])){
   unset($_SESSION['submit']);
   $item = $_POST['ilosc'];
if (preg_match ('/^[0-9]+$/', $item)) {
	if ($item == 0) {
	echo '<div class="error" align="left">Nie można przetransferować zerową ilość punktów!</div>';
	}
	else
	{
		if ($item <= $freepoints) {
		$item2 = ($item * 50);
		@mysql_query("UPDATE ".TBL_USERS." SET reklama = reklama + '$item2' WHERE username = '$ref'");
		@mysql_query("UPDATE ".TBL_USERS." SET pointsused = pointsused + '$item' WHERE username = '$ref'");
		echo '<div class="success" align="left">Punkty przetransferowane!</div>';
		header("Location: http://csposter.pl/logi");
		}
		else
		{
		echo '<div class="error" align="left">Nie za dużo punktów chcesz? :)</div>';
		}
	}
}
else
{
echo '<div class="error" align="left">Wprowadz poprawna liczbe!</div>';
}
}
}else{
echo '<center><div class="info" align="left">Nikt nie zarejestrował się z twojego polecenia</div></center>';
}
?>
</center>