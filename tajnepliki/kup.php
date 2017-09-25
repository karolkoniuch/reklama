<?php
define('INCLUDE_CHECK',true);
include 'connect.php';
$ref = $session->username;
$config_homepay_usr_id=1145; // ID uzytkownika homepay
$config_homepay=array();
// KONFIGURACJA
// niech ACCID oznacza numer konta SMS KOD w homepay,
// NETTO i BRUTTO to odpowiednio wartosc netto i brutto smsa, NAZWA to nazwa uslugi, a NUMER to numer premium sms, TEKST oznacza tekst smsa
// kolejne uslugi nalezy dopisywac wg schematu:
// $config_homepay[ACCID]=array("acc_id"=>ACCID,"netto"=>NETTO,"brutto"=>BRUTTO,"number"=>"NUMER","text"=>TEKST)
// czyli np.:
// $config_homepay[123]=array("acc_id"=>123,"nazwa"=>NAZWA,"netto"=>0.50,"brutto"=>0.61,"numer"=>"7055","tekst"=>"HPAY.TEST");
$config_homepay[5052]=array("acc_id"=>5052,"nazwa"=>"60","netto"=>4,"brutto"=>4,"numer"=>"7455","tekst"=>"HPAY.CS","wartosc"=>"60");
$config_homepay[5166]=array("acc_id"=>5166,"nazwa"=>"100","netto"=>6,"brutto"=>6,"numer"=>"7655","tekst"=>"HPAY.CS","wartosc"=>"120");

// KONIEC KONFIGURACJI
$config_homepay_multi=array("acc_ids"=>array());
$config_homepay_accs=array();
foreach($config_homepay as $k=>$v)
    {
    $config_homepay_accs[$v['acc_id']]=$k;
    $config_homepay_multi['acc_ids'][]=$v['acc_id'];
    }
$config_homepay_multi['acc_ids']=urlencode(implode(",",$config_homepay_multi['acc_ids']));

if($_POST&&$_POST['check_code'])
    {
	echo $config_homepay[$config_homepay_accs[$check[1]]]['nazwa'];
    $code=$_POST['code'];
    if(!preg_match("/^[A-Za-z0-9]{8}$/",$code)) echo "<center><div class='error' align='left'>Zly format kodu - 8 znakow</div></center>";
    else
	{
	$handle=fopen("http://homepay.pl/API/check_code_multi.php?usr_id=".$config_homepay_usr_id."&acc_id=".$config_homepay_multi['acc_ids']."&code=".$code,'r');
	$check=fgetcsv($handle,1024);
	fclose($handle);
	if($check[0]=="1")
	    {
		$date = time();
		$ilosc = $config_homepay[$config_homepay_accs[$check[1]]]['wartosc'];
		$font = "Doladowales konto o ".$ilosc." reklam";
	    echo "<center><div class='success' align='left'>Gratulacje, kod poprawny. Kupiles ".$ilosc." reklam </div></center>";
	    mysql_query("UPDATE users SET reklama = reklama + '$ilosc' WHERE username = '$ref'");
		mysql_query("INSERT INTO `logi` (`id`, `date`, `text`, `username`) VALUES ('', '$date', '$font', '$ref')"); 
	    }
	elseif($check[0]=="0")
	    {
	    echo "<center><div class='error' align='left'>Nieprawidlowy kod</div></center>";
	    }
	else
	    {
	    echo "<center><div class='error' align='left'>Blad w polaczeniu z operatorem</div></center>";
	    }
    
	}
    }
    
?>
<html><body>
<br/><br/>
<center>
<?php
foreach($config_homepay as $v)
echo "Wyslij <b>SMS</b> o tresci <b>".$v['tekst']."</b> na numer <b>".$v['numer']."</b> za ".$v['netto']."zl + VAT ( ".$v['brutto']."zl ), dostaniesz <b>".$v['wartosc']."</b> reklam<br/>\n";
?>
</center>
<br/><br/>
<form method="post" action="">
<input type="hidden" name="check_code" value="1">
<center>Podaj kod: <input type="text" class="text" size="8" name="code"></center>
<br/>
<center><input type="submit" class="button" style="width: 100px; font-size:16px; height: 30px;" value="Sprawdz"></center>
</form>
</body>
</html>