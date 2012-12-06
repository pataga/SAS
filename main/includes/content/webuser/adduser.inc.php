<?php
if (isset($_POST['adduser']))
{
	$newuser = $_POST['newuser'];
	$usermail = $_POST['usermail'];
	$passwd = $_POST['passwd'];
	$repeatpasswd = $_POST['repeatpasswd'];
}


?>

<!--############ User Hinzufügen ############//-->

<fieldset>
<form action="index.php?p=webuser&s=add" method="POST">

<h3>Benutzer hinzuf&uuml;gen</h3><br><br>
 <div class ="viertel-box"> 
 	Username:<br><br><br>
 	E-Mail:<br><br>
 	Passwort:<br><br><br>
 	Passwort wiederholen:<br>
 </div>
 <div class ="dreiviertel-box lastbox">	
	<input type="text-long" name="newuser" id=""><br><br>
	<input type="text-long" name="usermail" id=""><br><br>
	<input type="text-long" name="passwd" id=""><br><br>
	<input type="text-long" name="repeatpasswd" id=""><br><br><br>
</div>
	<input type="submit" class="button black" name="adduser" value="Hinzuf&uuml;gen">
	<br><br>
</form>
</fieldset>