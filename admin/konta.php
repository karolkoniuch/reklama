<?php
define('INCLUDE_CHECK',true);
if($session->logged_in){
	if(!$session->isAdmin()){
	header("Location: index.php");
	}
    }
else{
header("Location: index.php");
}
include '../tajnepliki/connect.php';
?>
<h2 class="login-postheader">Konta</h2>

<div class="cleared"></div>

<div class="login-postcontent">
<br>
<?php
if (isset($_POST['submit_dodaj'])){
$adres = $_POST['adres'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$topic = $_POST['topic'];

mysql_query("INSERT INTO `fora` (`id`, `domena`, `user`, `pass`, `topic`) VALUES ('', '$adres', '$user', '$pass', '$topic')");
header( 'Location: '.$config['WEB_ROOT'].'admin/index.php?id=5' );
}
if (isset($_GET['akcja']) && (($_GET['akcja']=="dodaj"))) {
echo "<h1><a href='".$config['WEB_ROOT']."admin/index.php?id=5'>Wroc</a></h1>";
?>
<form action="index.php?id=5&akcja=dodaj" method="POST">
<table align="left" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>Adres strony - http://www.domena.pl :</td>
<td><input name="adres" style=" width: 300px; " type="text" size="30"></td>
</tr>
<tr>
<td>Uzytkownik :</td>
<td><input name="user" style=" width: 300px; " type="text" size="30"></td>
</tr>
<tr>
<td>Haslo :</td>
<td><input name="pass" style=" width: 300px; " type="text" size="30"></td>
</tr>
<tr>
<td>Adres tematu - http://www.domena.pl/posting.php?mode=newtopic&f=1 :</td>
<td><input name="topic" style=" width: 300px; " type="text" size="30">
</td>
</tr>
<tr>
<td colspan="2" style="text-align:right;">
<input type="submit" name="submit_dodaj" value="Dodaj">
</td>
</tr>
</table>
</form>
<?
}
elseif (isset($_GET['akcja']) && (isset($_GET['ids'])) && (is_numeric($_GET['ids'])) && (($_GET['akcja']=="edytuj"))) {
$id = $_GET['ids'];
if (isset($_POST['submit_edytuj'])){
$adres = $_POST['adres'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$topic = $_POST['topic'];

mysql_query("UPDATE fora SET domena = '$adres', user = '$user', pass = '$pass', topic = '$topic' WHERE id = '$id'");
header( 'Location: '.$config['WEB_ROOT'].'admin/index.php?id=5' );
}
echo "<h1><a href='".$config['WEB_ROOT']."admin/index.php?id=5'>Wroc</a></h1>";
$SQL = "SELECT * FROM `fora` WHERE id = '$id'";
$result = mysql_query($SQL);
$num_rows = mysql_num_rows($result);
if ($num_rows > 0){
	while ($num_rows = mysql_fetch_array($result) ) {
	$adres = $num_rows['domena'];
	$user = $num_rows['user'];
	$pass = $num_rows['pass'];
	$topic = $num_rows['topic'];
	}
	
	echo "<form action='index.php?id=5&akcja=edytuj&ids=".$id."' method='POST' >";
	?>
	<table align="left" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td>Adres strony - http://www.domena.pl :</td>
	<td><input name="adres" style=" width: 300px; " value="<?php echo $adres; ?>" type="text" size="30"></td>
	</tr>
	<tr>
	<td>Uzytkownik :</td>
	<td><input name="user" style=" width: 300px; " value="<?php echo $user; ?>" type="text" size="30"></td>
	</tr>
	<tr>
	<td>Haslo :</td>
	<td><input name="pass" style=" width: 300px; " value="<?php echo $pass; ?>" type="text" size="30"></td>
	</tr>
	<tr>
	<td>Adres tematu - http://www.domena.pl/posting.php?mode=newtopic&f=1 :</td>
	<td><input name="topic" style=" width: 300px; " value="<?php echo $topic; ?>" type="text" size="30">
	</td>
	</tr>
	<tr>
	<td colspan="2" style="text-align:right;">
	<input type="submit" name="submit_edytuj" value="Zatwierdz zmiany">
	</td>
	</tr>
	</table>
	</form>
	
	<?
}
}
else
{
echo "<h1><a href='".$config['WEB_ROOT']."admin/index.php?id=5&akcja=dodaj'>Dodaj konto</a></h1>";
$SQL = "SELECT * FROM `fora`";
$result = mysql_query($SQL);
$num_rows = mysql_num_rows($result);
if ($num_rows > 0){
echo "<br><table>";
echo "<tr><th class='sortable'>ID</th><th class='sortable'>Adres strony</th><th class='sortable'>Uzytkownik</th><th class='sortable'>Haslo</th><th class='sortable'>Adres tematu</th><th class='sortable'>Edytuj</th></tr>";
		
		while ($num_rows = mysql_fetch_array($result) ) {
		echo "<tr><td>".$num_rows['id']."</td><td>".$num_rows['domena']."</td><td>".$num_rows['user']."</td>
		<td>".$num_rows['pass']."</td><td>".$num_rows['topic']."</td><td><a href='".$config['WEB_ROOT']."admin/index.php?id=5&akcja=edytuj&ids=".$num_rows['id']."'>Edytuj</a></td></tr>";		
		}
echo "</table>";
}
}
?>
</div>
<div class="cleared"></div>
