<?php
if($session->logged_in){
	if(!$session->isAdmin()){
	header("Location: index.php");
	}
    }
else{
header("Location: index.php");
}
?>
<?php 
$url = "http://www.angry-frog.com/downloads/loginscript_version.csv";
$fp = @fopen ($url, 'r') or print ('UPDATE SERVER OFFLINE');
$read = fgetcsv ($fp);
fclose ($fp); //always a good idea to close the file connection
if ($read[0] > $config['Version']) { $updateneeded = '1'; } else { $updateneeded = '0'; }
$version = $read[0];
?>

<h2 class="login-postheader">Admin Home Page</h2>

<div class="cleared"></div>

<div class="login-postcontent">

<div class="stats"><br>
<fieldset>
<legend>Statistics</legend>
<table>
<tr>
<td><b>Member Total: </b><?php echo $database->getNumMembers(); ?></td>
<td><b>Member's Online: </b><?php echo $database->num_active_users; ?></td>
</tr>
<tr>
<td><b>Last Registered Member: </b><?php echo $database->getLastUserRegisteredName(); ?></td>
<td><b>Last Login Date: </b><?php echo date("F j, Y, g:i a", $database->getLastUserRegisteredDate()); ?></td>
</tr>
<tr>
<td><b>Version: </b><?php echo $config['Version']; ?></td>
<td><b>Update Available: </b><?php if ($updateneeded) { echo $version; } else { echo 'Up to Date'; } ?></td>
</tr>
<?php if(file_exists('../install/')) 
	{
		 echo '<tr><td colspan="2" style="color:red;">
		 <strong>Please remove the install folder as leaving this folder poses a security risk!!</strong>
		 </td></tr>';
	} 
	?>
</table>
</fieldset>
</div>

</div>
<div class="cleared"></div>