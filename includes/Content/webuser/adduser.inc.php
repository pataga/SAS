<?php


/**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
* @author Tanja Weiser
*
*/


if (isset($_POST['adduser']))
{
	$newuser = $_POST['newuser'];
	$usermail = $_POST['usermail'];
	$passwd = $_POST['passwd'];
	$repeatpasswd = $_POST['repeatpasswd'];

	if($passwd == $repeatpasswd)
	{

		// Eintragen eines neuen Webusers
		$status = $mysql->tableAction('sas_users')
				->insert(['username'=>$newuser, 'password'=>sha1(sha1($newuser).sha1($passwd)), 'email' => $usermail]);
	
			echo '<br><span class="success">Benutzer wurde erfolgreich erstellt.</span>'; 

			//echo '<br>Benutzername existiert bereits';*/
	}
	else 
		echo '<br><span class="error">Die Passwörter stimmen nicht überein!</span>';
}


?>

<br>
<fieldset>
	<legend>Benutzer hinzufügen</legend>
	<form action="index.php?p=webuser&s=add" method="POST">

		<div class ="viertel-box"> 
		 	Username:<br><br>
		 	E-Mail:<br><br>
		 	Passwort:<br><br>
		 	Passwort wiederholen:<br><br><br>
		 	<input type="checkbox" name="admin"> Admin Rechte
		</div>

		<div class ="dreiviertel-box lastbox">	
			<input type="text" class = "text-long" name="newuser" required><br><br>
			<input type="email" class = "text-long" name="usermail" required><br><br>
			<input type="password" class = "text-long" name="passwd" required><br><br>
			<input type="password" class = "text-long" name="repeatpasswd" required><br><br><br>
		</div>

			<input type="submit" class="button green" name="adduser" value="hinzuf&uuml;gen">
			<br><br>

			 <span class="info"><b>Admin Rechte:</b><br>
			 	Der neu erstellte User hat bei Aktivierung alle Rechte, sodass alle Module benutzt werden können.
			 	Die Rechte für die einzelnen Module je User können unter dem Menüpunkt "Benutzer bearbeiten" konfiguriert werden.
			 </span>
	</form>
</fieldset>