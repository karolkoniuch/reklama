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
<title>Cs-Reklama.pl - Rejestracja</title>
<link rel="stylesheet" type="text/css" href="main.css" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<meta name="description" content="<?php include("tajnepliki/opis.php"); ?>" />
<meta name="keywords" content="<?php include("tajnepliki/tagi.php"); ?>" />
<meta name="author" content="" />
<meta name="robots" content="index, follow" />
<noscript><meta http-equiv="Refresh" content="0;url=http://www.cs-reklama.pl/java"></noscript>
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
						<a href="/rejestracja" target="_self">
							<span class="menu-left"></span>
							<span class="menu-mid">Rejestracja</span>
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
 <div class="srodek"><div class="lewa"><div class="prawa"><span class="nazwa_forum"><?php if($_GET['id']=="rejestracja"){ echo 'Jak się zarejestrować?'; } else { echo 'Rejestracja'; } ?></span></div></div></div>

<div class="bgie">
<?php
/**
 * The user is already logged in, not allowed to register.
 */
if($session->logged_in){
   echo "<center><br><p>Przepraszamy <b>$session->username</b>, ale jesteś już zarejestrowany. </center>";
}
/**
 * The user has submitted the registration form and the
 * results have been processed.
 */

	else if(isset($_SESSION['regsuccess'])){
	
	if ($_SESSION['regsuccess']==6){
      echo "<center><h1>Rejestracja tymczasowo wstrzymana!</h1></center>";
      echo "<center><p>Przepraszamy <b>".$_SESSION['reguname']."</b> , ale rejestracja jest wyłączona."
          ."<br>Proszę spróbować później lub skontaktować się z administracją.</p></center>";
	}
	/* Registration was successful */
	else if($_SESSION['regsuccess']==0 || $_SESSION['regsuccess']==5){
      echo "<center><h1>Zostałeś zarejestrowany!</h1></center>";
      echo "<center><p>Dziękuje <b>".$_SESSION['reguname']."</b>, zostałeś poprawnie zarejestrowany. "
          ."Możesz się zalogować.</p></center>";
	}
	else if($_SESSION['regsuccess']==3){
      echo "<center><h1>Zostałeś zarejestrowany!</h1></center>";
      echo "<center><p>Dziękuje <b>".$_SESSION['reguname']."</b>, twoje konto zostało dodane. "
          ."Jednakże strona wymaga aktywacji, klucz został wysłany na e-mail podany w rejestracji. "
          ."Proszę sprawdź swój adres e-mail.</p></center>";
	}
	else if($_SESSION['regsuccess']==4){
      echo "<center><h1>Zostałeś zarejestrowany!</h1></center>";
      echo "<center><p>Dziękuje <b>".$_SESSION['reguname']."</b>, twoje konto zostało stworzone. "
          ."Jednakże rejestracja wymaga weryfikacji przez Admina. Zostaniesz poinformowany "
          ."kiedy twoje konto będzie aktywne.</p></center>";
   }
   /* Registration failed */
   else if ($_SESSION['regsuccess']==2){
      echo "<center><h1>Wystąpił błąd podczas rejestracji</h1></center>";
      echo "<center><p>Przepraszamy, ale podczas rejestracji nicku: <b>".$_SESSION['reguname']."</b>, "
          ."wystąpił nieoczekiwany błąd.<br>Proszę spróbować później.</p></center>";
   }
   unset($_SESSION['regsuccess']);
   unset($_SESSION['reguname']);
   } 
    else if ((isset($_GET['mode'])) && ($_GET['mode'] == 'activate')) {
	$user = $_GET['user'];
	$actkey = $_GET['activatecode'];
	
	$sql = $database->connection->prepare("UPDATE ".TBL_USERS." SET USERLEVEL = '3' WHERE username=:user AND actkey=:actkey");
	$sql->bindParam(":user",$user);
	$sql->bindParam(":actkey",$actkey);
	$sql->execute();
	
	echo 'Twoje konto zostało aktywowane.';
	// some warning if not successful
}
/**
 * The user has not filled out the registration form yet.
 * Below is the page with the sign-up form, the names
 * of the input fields are important and should not
 * be changed.
 */
else{
?>
</div>
<div class="bgie">
<?php
if($form->num_errors > 0){
   echo "<font size=\"2\" color=\"#ff0000\">".$form->num_errors." błędy/błąd/błędów znaleziono</font>";
}
?>
<form action="akcja" method="post" autocomplete="off">
<table align="center" border="0" cellspacing="10" cellpadding="3">
<tr>
	<td>Login:</td>
	<td><input type="text" class ="text" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>" /></td>
	<td><?php echo $form->error("user"); ?></td>
</tr>
<tr>
	<td>Hasło:</td>
	<td><input type="password" name="pass" class ="text" maxlength="30" value="<?php echo $form->value("pass"); ?>" /></td>
	<td><?php echo $form->error("pass"); ?></td></tr>
<tr>
	<td>Potwierdź Hasło:</td>
	<td><input type="password" name="conf_pass" class ="text" maxlength="30" value="<?php echo $form->value("conf_pass"); ?>" /></td>
	<td><?php echo $form->error("pass"); ?></td>
</tr>
<tr>
	<td>E-mail:</td>
	<td><input type="text" name="email" class ="text" maxlength="50" value="<?php echo $form->value("email"); ?>" /></td>
	<td><?php echo $form->error("email"); ?></td>
</tr>
<tr>
	<td>Potwierdź E-mail:</td>
	<td><input type="text" name="conf_email" class ="text" maxlength="50" value="<?php echo $form->value("conf_email"); ?>" /></td>
	<td><?php echo $form->error("email"); ?></td>
</tr>
<tr>
	<td>Polecający:</td>
	<td><input type="text" name="ref" class ="text" maxlength="30" value="<?php echo $form->value("ref"); ?>" /></td>
	<td><?php echo $form->error("ref"); ?></td>
</tr>
<?php 
if ($config['ENABLE_CAPTCHA']){
	echo "<tr><td colspan=\"2\"><div class=\"QapTcha\"></div></td></tr>";
}
?>
<tr><td colspan="2" align="right">
<input type="hidden" name="subjoin" value="1" />
<input type="submit" value="Zarejestruj się!" id="submit" class='button' /></td></tr>
</table>
<!-- The following div tag displays a hidden form field in an attempt at tricking automated bots. -->
<div style='display:none; visibility:hidden;'><input type='text' name='killbill' maxlength='50' /></div>
</form>

<?php 
if ($config['ENABLE_CAPTCHA']){
?>
<!-- QapTcha and jQuery files -->
<script type="text/javascript" src="captcha/jquery/jquery.js"></script>
<script type="text/javascript" src="captcha/jquery/jquery-ui.js"></script>
<script type="text/javascript" src="captcha/jquery/jquery.ui.touch.js"></script>
<script type="text/javascript" src="captcha/jquery/QapTcha.jquery.js"></script>
<script type="text/javascript">
		$('.QapTcha').QapTcha({});
	</script>

<?php
}
}
?>
</div>
<div class="bottomsrodek"><div class="bottomlewa"><div class="bottomprawa"></div></div></div>

</div>

         </div>	   

         <div id="footer">
		       
               &copy; Copyright 2012 by <span class="stopa">Cs-Reklama.pl</span>
Wszelkie prawa zastrzeżone.<br />Zabrania się kopiowania jakichkolwiek tresci zawartych na stronie.	

         </div>
		 
   </div>
</body>
</html>