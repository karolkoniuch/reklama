<?php
define('INCLUDE_CHECK',true);
set_time_limit(0);
if($session->logged_in){
	if(!$session->isAdmin()){
	header("Location: index.php");
	}
    }
else{
header("Location: index.php");
}
require_once '../tajnepliki/Bbcode/BbCode.php';
include '../tajnepliki/connect.php';
?>
<h2 class="login-postheader">Reklama</h2>

<div class="cleared"></div>

<div class="login-postcontent">
<br>
<?php
if (isset($_POST['submit_dodaj'])){
$tytul = $_POST['tytul'];
$opis = $_POST['opis'];
$ilosc = $_POST['ilosc'];
$user = $_POST['user'];

mysql_query("INSERT INTO `reklama` (`id`, `tytul`, `opis`, `ilosc`, `active`, `username`, `linki`) VALUES ('', '$tytul', '$opis', '$ilosc', '0', '$user', '')");
header( 'Location: '.$config['WEB_ROOT'].'admin/index.php?id=4' );
}
if (isset($_GET['akcja']) && (($_GET['akcja']=="dodaj"))) {
echo "<h1><a href='".$config['WEB_ROOT']."admin/index.php?id=4'>Wroc</a></h1>";
?>
<form action="index.php?id=4&akcja=dodaj" method="POST">
<table align="left" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>Tytul :</td>
<td><input name="tytul" style=" width: 600px; " type="text" size="30"></td>
</tr>
<tr>
<td>Opis :</td>
<td><textarea name="opis" style=" width: 600px; height: 400px; " value="123" id="styled">
Wprowadz kod reklamy w BBCODE!
</textarea></td>
</tr>
<tr>
<td>Ilosc :</td>
<td><input name="ilosc" style=" width: 600px; " type="text" size="30"></td>
</tr>
<tr>
<td>Uzytkownik :</td>
<td><input name="user" style=" width: 600px; " type="text" size="30">
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
elseif (isset($_GET['podglad']) && (is_numeric($_GET['podglad']))) {
$id = $_GET['podglad'];
$SQL = "SELECT * FROM `reklama` WHERE id = '$id'";
$result = mysql_query($SQL);
$num_rows = mysql_num_rows($result);
if ($num_rows > 0){
	while ($num_rows = mysql_fetch_array($result) ) {
	$opis = $num_rows['opis'];
	$tytul = $num_rows['tytul'];
	}
}
echo '<h1>'.$tytul.'</h1>';
$parser = new BbCode();
echo $parser->parse($opis);
echo "<br /><br />";
echo "<h1><a href='".$config['WEB_ROOT']."admin/index.php?id=4&akceptuj=".$id."'><font color='green'>Akceptuj</font></a></h1>";
echo "<h1><a href='".$config['WEB_ROOT']."admin/index.php?id=4&odrzuc=".$id."'><font color='red'>Odrzuc</font></a></h1>";

}
elseif (isset($_GET['akceptuj']) && (is_numeric($_GET['akceptuj']))) {
$id = $_GET['akceptuj'];
$SQL = "SELECT * FROM `reklama` WHERE id = '$id' AND active = '0'";
$result = mysql_query($SQL);
$num_rows = mysql_num_rows($result);
if ($num_rows > 0){
	while ($num_rows = mysql_fetch_array($result) ) {
	$ilosc = $num_rows['ilosc'];
	$user = $num_rows['username'];
	$opis = $num_rows['opis'];
	$tytul = $num_rows['tytul'];
	}
	}
else
{
header( 'Location: '.$config['WEB_ROOT'].'admin/index.php?id=4' );
}
$SQL = "SELECT * FROM `fora`";
$result = mysql_query($SQL);
$num_rows = mysql_num_rows($result);
if ($num_rows > 0){
	while ($num_rows = mysql_fetch_array($result, MYSQL_ASSOC) ) {
	$tablica[] = $num_rows['domena'];
	$konto[] = $num_rows['user'];
	$haslo[] = $num_rows['pass'];
	$topic[] = $num_rows['topic'];
	}
}

for ($i=0; $i < $ilosc; $i++)
    {
     
		$userlos = explode(",", $konto[$i]);
		$los = array_rand($userlos, 1);
		
		 $BASE_DIR = "cookieFolder/";
   	     $folder  = time();               
	     $dirPath = $BASE_DIR . $folder.'ycookie.txt';   
	     $cookie_file_path = $dirPath;

		$fp = fopen($cookie_file_path, 'wb');
		$f = "username=".$userlos[$los]."&password=".$haslo[$i]."&redirect=&login=Zaloguj";
		$l = $tablica[$i] . '/login.php';


		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_URL, $l);
		curl_setopt($ch, CURLOPT_POST, 1);                                
		curl_setopt($ch, CURLOPT_POSTFIELDS, $f); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_COOKIEFILE,  $cookie_file_path);
		curl_setopt($ch, CURLOPT_COOKIEJAR,  $cookie_file_path);
		curl_exec($ch); 


		curl_setopt($ch, CURLOPT_URL, $topic[$i]);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "&subject=$tytul&t=$opis&mode=newtopic&message=".urlencode($opis)."&post=Submit");
		$result = curl_exec($ch);
		$pattern = '#<a href="(.*?)">Tutaj</a>#';
		$ile = preg_match_all($pattern, $result, $matches, PREG_PATTERN_ORDER);
		//print_r($matches);
		//echo $matches[1][0];
		if(empty($tablica[$i])){
		echo "$i. Blad zwiazany z dodaniem forum <br />";
		$linki .= "$i. Blad zwiazany z dodaniem forum \n";
		$ilosc = $ilosc + '1';
		}
		else if(empty($matches[1][0])){
		echo "$i. Skrypt mial problemy z utworzeniem tematu <br />";
		$linki .= "$i. Skrypt mial problemy z utworzeniem tematu \n";
		$ilosc = $ilosc + '1';
		}
		else {
		$zwrot = $tablica[$i] . '/' . $matches[1][0];
		echo "$i. $zwrot <br />";
		$linki .= "$i. $zwrot \n";
		mysql_query("UPDATE reklama SET linki = '$linki' WHERE username = '$user' AND id = '$id'");
		}
		
		
		//echo $result;
		curl_close($ch);

		//preg_match('#<a href="(.*?)">Tutaj</a>#', $adres, $link);
		//echo $link[1];
		//print_r($link);

    }
		$date = time();
		$font = '<font color="green">Reklama zostala wykonana!</font> - cs-reklama.pl/linki/'.$id.'';
		mysql_query("UPDATE reklama SET active = '1' WHERE username = '$user' AND id = '$id'");
		//mysql_query("UPDATE reklama SET linki = '$linki' WHERE username = '$user' AND id = '$id'");
		mysql_query("INSERT INTO `logi` (`id`, `date`, `text`, `username`) VALUES ('', '$date', '$font', '$user')"); 
		
}
elseif (isset($_GET['odrzuc']) && (is_numeric($_GET['odrzuc']))) {
$id = $_GET['odrzuc'];
$SQL = "SELECT * FROM `reklama` WHERE id = '$id'";
$result = mysql_query($SQL);
$num_rows = mysql_num_rows($result);
if ($num_rows > 0){
	while ($num_rows = mysql_fetch_array($result) ) {
	$ilosc = $num_rows['ilosc'];
	$user = $num_rows['username'];
	
	}	
}
$date = time();
$font = '<font color="red">';
mysql_query("UPDATE ".TBL_USERS." SET reklama = reklama + '$ilosc' WHERE username = '$user'");
mysql_query("UPDATE reklama SET active = '2' WHERE username = '$user' AND id = '$id'");
mysql_query("INSERT INTO `logi` (`id`, `date`, `text`, `username`) VALUES ('', '$date', '$font Odrzucono reklame!</font>', '$user')");
echo "Pomyslnie odrzucono reklame!"."<h1><a href='".$config['WEB_ROOT']."admin/index.php?id=4'>Kliknij aby powrocic do przegladania reklam</a></h1>";

}
else
{
echo "<h1><a href='".$config['WEB_ROOT']."admin/index.php?id=4&akcja=dodaj'>Dodaj reklame</a></h1>";
$SQL = "SELECT * FROM `reklama` WHERE active = '0'";
$result = mysql_query($SQL);
$num_rows = mysql_num_rows($result);
if ($num_rows > 0){
echo "<br><table>";
echo "<tr><th class='sortable'>Username</th><th class='sortable'>Ilosc</th><th class='sortable'>Podglad</th><th class='sortable'>Akceptuj</th><th class='sortable'>Odrzuc</th></tr>";
		
		while ($num_rows = mysql_fetch_array($result) ) {
		echo "<tr><td>".$num_rows['username']."</td><td>".$num_rows['ilosc']."</td><td><a href='".$config['WEB_ROOT']."admin/index.php?id=4&podglad=".$num_rows['id']."'>Podglad</a></td>
		<td><a href='".$config['WEB_ROOT']."admin/index.php?id=4&akceptuj=".$num_rows['id']."'>Akceptuj</a></td><td><a href='".$config['WEB_ROOT']."admin/index.php?id=4&odrzuc=".$num_rows['id']."'>Odrzuc</a></td></tr>";		
		}
echo "</table>";
}
}
?>
</div>
<div class="cleared"></div>
