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

if (!$server->isInstalled('samba')) {
    header('Location:?p=samba&s=install');
    exit;
}

//#######################################################
//		Benutzer anlegen
//#######################################################

if(isset($_POST['entry']))
{

	$smbuser = $_POST['smbuser'];
	$smbpasswd = $_POST['smbpasswd'];
	$repeat = $_POST['repeat'];

	if($smbpasswd == $repeat)
	{
		$line = $server->execute('echo -ne "'.$smbpasswd.'\n'.$smbpasswd.'\n" | smbpasswd -a -s '.$smbuser);
	}
	else {}
}

//#######################################################
//		Passwort ändern
//#######################################################

if(isset($_POST['change']))
{

	$user = $_POST['user'];
	$newpasswd = $_POST['newpasswd'];
	$newpasswdr = $_POST['newpasswdr'];

	if($newpasswd == $newpasswdr)
	{
		$line=$server->execute('echo -ne "'.$newpasswd.'\n'.$newpasswd.'\n" | smbpasswd -s '.$user);
	}
	else {}
}

//#######################################################
//		Benutzer löschen
//#######################################################

if(isset($_POST['delete']))
{
	$deluser = $_POST['deluser'];	
	$line=$server->execute('echo -ne |  smbpasswd -x '.$deluser);
}

//#######################################################
//		Aktuelle Samba Benutzer anzeigen
//#######################################################

$sam_users = $server->execute("pdbedit -L", 2);


//#######################################################
//		Aktuelle System Benutzer anzeigen
//#######################################################

$seq_users = $server->execute("awk -F: '$3>999{print $1}' /etc/passwd", 2);

?>



<br>
<form action="index.php?p=samba&s=users" method="POST">

<fieldset>
<legend>Samba Benutzer</legend>
Jeder Benutzer, der auf die Samba Freigaben zugreifen soll, muss als Samba Benutzer angelegt werden.
<br>Wichtig hierbei ist, dass die Benutzer im vorraus auf dem System angelegt sein müssen.

</fieldset>

<!--###############################################################	
		Neuen Samba Benutzer anlegen
	###############################################################-->

<div class="halbe-box">
<fieldset>
<legend>Benutzer anlegen</legend>
<label>Benutzername:</label>
<input type="text" class="text-long" name="smbuser" placeholder="Name eines verfügbaren Systembenutzers"><br><br><br>
<label>Passwort:</label>
<input type="password" class="text-long" name="smbpasswd"><br><br><br>
<label>Passwort wiederholen:</label>
<input type="password" class="text-long" name="repeat"><br><br><br>
<input type="submit" class="button black" name="entry" value="eintragen">
</fieldset>

<!--###############################################################	
		Passwort ändern bei vorhandenem Samba Benutzer
	###############################################################-->

<fieldset>
<legend>Passwort &auml;ndern</legend>
<label>Benutzername:</label>
<input type="text" class="text-long" name="user" placeholder="Benutzername"><br><br><br>
<label>Neues Passwort:</label>
<input type="password" class="text-long" name="newpasswd"><br><br><br>
<label>Passwort wiederholen:</label>
<input type="password" class="text-long" name="newpasswdr"><br><br><br>
<input type="submit" class="button black" name="change" value="&auml;ndern">
</fieldset>

<!--###############################################################	
		Vorhandenen Samba Benutzer löschen
	###############################################################-->

<fieldset>
<legend>Benutzer l&ouml;schen</legend>
<label>Benutzername:</label>
<input type="text" class="text-long" name="deluser" placeholder="Benutzername des zu löschenden Benutzers"><br><br><br>
<input type="submit" class="button black" name="delete" value="l&ouml;schen">
</fieldset>
</div>

<!--###############################################################	
		Anzeigen der aktuell angelegten Samba Benutzer
	###############################################################-->

<div class="halbe-box lastbox">
	<fieldset>
		<legend>Angelegte Samba Benutzer</legend>
<div class="listbox">
        <?php
            foreach ($sam_users as $key => $value) {
                $ausgabe = explode(":", $value);
                echo $ausgabe[0] ."<br>";
            }
        ?>
      <br>
  </fieldset>
</div>

<!--###############################################################	
		Anzeigen der aktuell verfügbaren System Benutzer
	###############################################################-->

<div class="halbe-box lastbox">
	<fieldset>
		<legend>Verfügbare Systembenutzer</legend>
<div class="listbox">
        <?php
            foreach ($seq_users as $key => $value) {
                echo $value . "<br>";
            }
        ?>
      <br>
</div>
<br><br><br><br><br><br><br>
    <span class="info">Neue Systembenutzer legen Sie <a href="http://localhost/SAS/index.php?p=system&s=usergroups" target="_blank">hier</a> an.</span>