<?php
define('INCLUDE_CHECK',true);
include 'connect.php';
$user = $session->username;
$auth = 1;
?>
<form action="/reklamuj" method="post"> 
<center>
<input name="temat" type="text" class="text" align="center" style="width: 600px;" value="Nazwa Tematu..." onblur="if(this.value=='') this.value='Nazwa Tematu...'" onfocus="if(this.value =='Nazwa Tematu...' ) this.value=''">
<textarea name="opis" value="123" id="styled">
Wprowadz kod reklamy w BBCODE!
</textarea>
<select name="ilosc" style="font-weight:bold; background-color:#181818; width: 600px; color:#ef5d21;">
	<option value="60">60 reklam</option>
	<option value="120">120 reklam</option>
</select>
<br />
<br />
<input type="submit" name="submit" class="button" style="width: 555px; font-size:16px; height: 40px;" value=" ZATWIERDŹ "/><br />
</form>
<?php
if(isset($_POST['submit'])){
   $temat = filtruj($_POST['temat']);
   $opis = filtruj($_POST['opis']);
   $ilosc = $_POST['ilosc'];
 
if (is_numeric($ilosc)) {
	if ($reklama < 50 || $ilosc > $reklama) {
	echo '<div class="error" align="left">Nie masz wystarczajacej ilosci punktow! Prosze doladowac konto</div>';
	$auth = 0;
	}
	elseif ($ilosc < 50 or $ilosc > 500) {
	echo '<div class="error" align="left">Prosze wprowadzic liczbe z zakresu od 50 do 500!</div>';
	$auth = 0;
	}
	}
	else
	{
	echo '<div class="error" align="left">Wprowadz poprawna liczbe!</div>';
	$auth = 0;
	}
if ($auth == 1) {
$wydal = ($wydal + $ilosc);
$reklama = ($reklama - $ilosc);
$temat = pl_urlencode($temat, '0');
$temat = mysql_real_escape_string($temat);
$opis = pl_urlencode($opis, '0');
$opis = mysql_real_escape_string($opis);
@mysql_query("INSERT INTO `reklama` (`id`, `tytul`, `opis`, `ilosc` , `active`, `username`) VALUES ('', '$temat', '$opis', '$ilosc', '0', '$user')");
@mysql_query("UPDATE ".TBL_USERS." SET reklama = '$reklama', wydal = '$wydal' WHERE username = '$user'");
$date = time();
$font = '<font color="yellow">';
@mysql_query("INSERT INTO `logi` (`id`, `date`, `text`, `username`) VALUES ('', '$date', '$font Dodano do realizacji reklame</font>', '$user')");
header("Location: http://cs-reklama.pl/logi");
}

}
function filtruj($string) {
return htmlspecialchars(strip_tags($string));
}
function pl_urlencode($t, $i) 
 { 
	 if($i == '0') 
   {
   
	   $tu = $t;
   
     $tu = str_replace('ą','a',$tu); 
     $tu = str_replace('ć','c',$tu); 
     $tu = str_replace('ż','z',$tu); 
     $tu = str_replace('ź','z',$tu); 
     $tu = str_replace('ę','e',$tu); 
     $tu = str_replace('ó','o',$tu); 
     $tu = str_replace('Ą','A',$tu); 
     $tu = str_replace('Ć','C',$tu); 
     $tu = str_replace('Ż','Z',$tu); 
     $tu = str_replace('Ź','Z',$tu); 
     $tu = str_replace('Ę','E',$tu); 
     $tu = str_replace('Ó','O',$tu); 
     $tu = str_replace('ś','s',$tu); 
     $tu = str_replace('Ś','S',$tu); 
     $tu = str_replace('ł','l',$tu); 
     $tu = str_replace('Ł','L',$tu); 
     $tu = str_replace('ń','n',$tu); 
     $tu = str_replace('Ń','N',$tu); 
     
	 }
	 else
	 {
     $tu = urlencode($t); 
     
     $tu = str_replace('%B9','a',$tu); 
     $tu = str_replace('%E6','c',$tu); 
     $tu = str_replace('%9F','z',$tu); 
     $tu = str_replace('%BF','z',$tu); 
     $tu = str_replace('%EA','e',$tu); 
     $tu = str_replace('%F3','o',$tu); 
     $tu = str_replace('%A5','A',$tu); 
     $tu = str_replace('%C6','C',$tu); 
     $tu = str_replace('%8F','Z',$tu); 
     $tu = str_replace('%AF','Z',$tu); 
     $tu = str_replace('%CA','E',$tu); 
     $tu = str_replace('%D3','O',$tu); 
     $tu = str_replace('%9C','s',$tu); 
     $tu = str_replace('%8C','S',$tu); 
	 }

     return $tu; 
 }
?>
</center>