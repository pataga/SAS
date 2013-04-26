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
				->insert(['username'=>$newuser, 'password'=>md5($passwd), 'email' => $usermail]);
		//if($status)
			echo '<br>Benutzer wurde erstellt'; // Temp Hack
		/*if($status == -1) //Hacky
			echo '<br>Benutzername existiert bereits';*/
	}
}


?>

<h3>Benutzer hinzufügen</h3>
<fieldset>
	<form action="index.php?p=webuser&s=add" method="POST">

		<div class ="viertel-box"> 
		 	Username:<br><br>
		 	E-Mail:<br><br>
		 	Passwort:<br><br>
		 	Passwort wiederholen:<br><br><br>
		 	<input type="checkbox" name="admin"> Admin Rechte
		</div>

		<div class ="dreiviertel-box lastbox">	
			<input type="text" class = "text-long" name="newuser" id=""><br><br>
			<input type="text" class = "text-long" name="usermail" id=""><br><br>
			<input type="password" class = "text-long" name="passwd" id=""><br><br>
			<input type="password" class = "text-long" name="repeatpasswd" id=""><br><br><br>
		</div>

			<input type="submit" class="button black" name="adduser" value="Hinzuf&uuml;gen">
			<br><br>

			 <span class="info"><b>Admin Rechte:</b><br>
			 	Der neu erstellte User hat bei Aktivierung alle Rechte, sodass benutzt werden können.
			 	Die Rechte für die einzelnen Module je User können unter dem Menüpunkt "Benutzer bearbeiten" konfiguriert werden.
			 </span>
	</form>
</fieldset>