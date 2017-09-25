
      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>
<?
 echo $config['SITE_NAME'];
 ?>.pl - Pomyślnie zedytowano konto!
</title>
<link rel="stylesheet" type="text/css" href="main.css" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<meta name="description" content="<?php include("tajnepliki/opis.php"); ?>" />
<meta name="keywords" content="<?php include("tajnepliki/tagi.php"); ?>" />
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
				<ul id="navigation" style="width:900px";>
 
					<li class="#">
						<a href="/index.php?id=home" target="_self">
							<span class="menu-left"></span>
							<span class="menu-mid">Strona Główna</span>
							<span class="menu-right"></span>
						</a>
					</li>
 
					<li class="#">
						<a href="/index.php?id=faq" target="_self">
							<span class="menu-left"></span>
							<span class="menu-mid">F.A.Q</span>
							<span class="menu-right"></span>
						</a>
					</li>
 
					<li class="#">
						<a href="/index.php?id=kontakt" target="_self">
							<span class="menu-left"></span>
							<span class="menu-mid">Kontakt</span>
							<span class="menu-right"></span>
						</a>
					</li>
 
					<li class="#">
						<a href="/index.php?id=kup" target="_self">
							<span class="menu-left"></span>
							<span class="menu-mid">Kup Reklame</span>
							<span class="menu-right"></span>
						</a>
					</li>
					<li class="#">
						<a href="/index.php?id=reklama" target="_self">
							<span class="menu-left"></span>
							<span class="menu-mid">Zleć Reklame</span>
							<span class="menu-right"></span>
						</a>
					</li>
					<li class="#">
						<a href="/index.php?id=ref" target="_self">
							<span class="menu-left"></span>
							<span class="menu-mid">Poleceni</span>
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
			   <div class="srodek"><div class="lewa"><div class="prawa"><span class="nazwa_forum">Panel Logowania</span></div></div></div>

<div class="bgie">
<?php
/**
 * User has already logged in, so display relavent links, including
 * a link to the admin center if the user is an administrator.
 */
if($session->logged_in){
   echo "<h3>Zalogowany</h3>";
   echo "Cześć <b>$session->username</b>, zostałeś zalogowany.</b><br>";
   include("tajnepliki/punkty.php");
   echo "&nbsp;&nbsp;"."[<a href=\"userinfo.php?user=$session->username\">Moje Konto</a>]<br> &nbsp;&nbsp;"
       ."[<a href=\"useredit.php\">Edytuj Konto</a>]<br>&nbsp;&nbsp;";
   if($session->isAdmin()){
      echo "[<a href=\"admin/index.php\">Panel Admina</a>]<br> &nbsp;&nbsp;";
   }
   echo "[<a href=\"process.php\">Wyloguj</a>]";
}
else{
?>
<?php
/**
 * User not logged in, display the login form.
 * If user has already tried to login, but errors were
 * found, display the total number of errors.
 * If errors occurred, they will be displayed.
 */
if($form->num_errors > 0){
   echo "<font size=\"2\" color=\"#ff0000\">".$form->num_errors." błędy/błąd znaleziono</font>";
}
?>
<form name='loginform' method='post' action='process.php' autocomplete="off">Login<br>
<td><input type="text" name="user" maxlength="30" class="text" value="<?php echo $form->value("user"); ?>"></td><br><td><?php echo $form->error("user"); ?></td><br>Hasło<br>
<td><input type="password" name="pass" maxlength="30" class="text" value="<?php echo $form->value("pass"); ?>"></td><br><td><?php echo $form->error("pass"); ?></td><br>
<input type='checkbox' name='remember' <?php if($form->value("remember") != ""){ echo "checked"; } ?>>Zapamiętaj mnie<br><br>
<input type="hidden" name="sublogin" value="1">
<input type='submit' name='Login' value='Loguj' class='button'><br>
</form>
<br>
<a href='/register.php' class='side'>Rejestracja</a><br>
<a href='/forgotpass.php' class='side'>Zapomniałeś hasło?</a>
<?php } ?>
</div>
<div class="bottomsrodek"><div class="bottomlewa"><div class="bottomprawa"></div></div></div>


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
 <div class="srodek"><div class="lewa"><div class="prawa"><span class="nazwa_forum">
Edycja Konta
 </span></div></div></div>

<div class="bgie">
<center>
Dziękujemy, twoje konto zostało pomyślnie edytowane!
</center>
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