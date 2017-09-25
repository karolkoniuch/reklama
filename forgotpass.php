<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
/*
 * Main.php
 *
 * This is an example of the main page of a website. Here users will be able to login. 
 * However, like on most sites the login form doesn't just have to be on the main page,
 * but re-appear on subsequent pages, depending on whether the user has logged in or not.
 *
 * Originally written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated by the Angry Frog: October 19, 2011
*/

include("include/session.php");
global $database;
$config = $database->getConfigs();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html"/>
<?php 
$id = isset($_GET['id']) ? $_GET['id'] : 1;
if ($config['ENABLE_CAPTCHA']){
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="captcha/jquery/QapTcha.jquery.css" type="text/css" />
<?php 
} 
?>
<title><?php echo $config['SITE_NAME']; ?>.pl - Zapomniane Hasło</title>
<link rel="stylesheet" type="text/css" href="main.css" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<meta name="description" content="Zareklamuj swoj serwer counter strike lub siec serwerow. Za pomoca naszego programu zrobisz to bez problemu." />
<meta name="keywords" content="csposter.pl, csposter, cs poster, reklama serwerow cs, reklama sieci serwerow, reklama serwerow counter strike, reklama sieci serwerow counter strike" />
<meta name="author" content="Karol" />
<meta name="robots" content="index, follow" />
</head>

<body>

   <div id="wrapper">
   
         <div id="header">	 
<a href="index.php"><img src="images/logo.png" alt="logo" /></a>
		 </div>
		 
		 <div class="wrapper1">
	<div class="wrapper"  style="width:600px;">
		<div class="nav-wrapper">
			<div class="nav">
				<ul id="navigation" style="width:538px";>
 
					<li class="#">
						<a href="/" target="_self">
							<span class="menu-left"></span>
							<span class="menu-mid">Strona Główna</span>
							<span class="menu-right"></span>
						</a>
					</li>
 
					<li class="#">
						<a href="/faq" target="_self">
							<span class="menu-left"></span>
							<span class="menu-mid">F.A.Q</span>
							<span class="menu-right"></span>
						</a>
					</li>
 
					<li class="#">
						<a href="/kontakt" target="_self">
							<span class="menu-left"></span>
							<span class="menu-mid">Kontakt</span>
							<span class="menu-right"></span>
						</a>
					</li>

			   	</ul>
			</div>
		<br><br>
	 </div>
	</div>
</div>

		 
		 <div id="glowny">
		 
		       <!-- poczatek lewa kolumna -->
			   <div id="panel_lewa">
			   



			   <div class="srodek"><div class="lewa"><div class="prawa"><span class="nazwa_forum">Statystyki</span></div></div></div>

<div class="bgie">
<?php
ob_start();
include("zlicz.php");
echo "<br><br>";
include("include/view_active.php");
?> 
</div>
<div class="bottomsrodek"><div class="bottomlewa"><div class="bottomprawa"></div></div></div>
</div>

<div id="panel_prawa">
 <div class="srodek"><div class="lewa"><div class="prawa"><span class="nazwa_forum">Zapomniane Hasło</span></div></div></div>

<div class="bgie">
<?php
/**
 * Forgot Password form has been submitted and no errors
 * were found with the form (the username is in the database)
 */
if(isset($_SESSION['forgotpass'])){
   /**
    * New password was generated for user and sent to user's
    * email address.
    */
   if($_SESSION['forgotpass']){
      echo "<center><h3>Nowe hasło wygenerowane</h3></center>";
      echo "<center><p>Twoje nowe hasło zostało wygenerowane "
          ."i zostało wysłane na twój adres e-mail <br> powiązanym z twoim kontem. "
          ."<a href=".$config['WEB_ROOT'].$config['home_page'].">Powróć na stronę głowną</a>.</p></center>";
   } 
   /**
    * Email could not be sent, therefore password was not
    * edited in the database.
    */
   else{
      echo "<center><h3>Błąd podczas generowania nowego hasła</h3></center>";
      echo "<center><p>Wystąpił błąd podczas wysyłania dla ciebie"
          ."e-maila z nowym hasłem,<br> więc twoje hasło nie zostało zmienione."
          ."<a href=".$config['WEB_ROOT'].$config['home_page'].">Powróć na stronę główną</a>.</p></center>";
   }
       
   unset($_SESSION['forgotpass']);
}
else{

/**
 * Forgot password form is displayed, if error found
 * it is displayed.
 */
?>

<form action="process.php" method="POST">

<table align="center" border="0" cellspacing="0" cellpadding="3">
<tr><td colspan='2'><center>Proszę wypełnić poniższy formularz. Potrzebny będzie ci twój login i<br>
adres e-mail użyty podczas rejestracji (chyba, że go zmieniłeś).</center><br></td></tr>

<tr><td><?php echo $form->error("user"); ?></td></tr>
<tr><br>
<td align="right">Login:</td>
<td><input type="text" class='text' tabindex="1" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>"></td>
</tr>
<tr>
<td align="right">Adres E-Mail:</td> 
<td><input type="text" class='text' tabindex="2" name="email" maxlength="50" value="<?php echo $form->value("email"); ?>"></td>
</tr>
<tr><td colspan="2" align="center">
	<br>
    <input type="hidden" name="subforgot" value="1">
    <input type="submit" class='button' value="Wygeneruj nowe hasło">
</td></tr>
</table>
</form>
<?php
}
?>
</div>
<div class="bottomsrodek"><div class="bottomlewa"><div class="bottomprawa"></div></div></div>

</div>

         </div>	   

         <div id="footer">
		       
               &copy; Copyright 2012 by <span class="stopa">CSPoster.pl</span>
Wszelkie prawa zastrzeżone.<br />Zabrania się kopiowania jakichkolwiek tresci zawartych na stronie.	

         </div>
		 
   </div>
</body>
</html>