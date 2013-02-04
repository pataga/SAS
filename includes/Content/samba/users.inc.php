<?php


/**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt
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
//		Aktuelle Benutzer anzeigen
//#######################################################

$line=$server->execute('pdbedit -L', 2);
$ausgabe = "";
foreach($line as $value)
{
	$pdbedit=explode(":",$value);
	$ausgabe .=$pdbedit[0]."<br>";
}

?>



<h3>Samba Nutzer</h3>
<form action="index.php?p=samba&s=users" method="POST">

<!--###############################################################	
		Neuen Samba Benutzer anlegen
	###############################################################-->

<div class="halbe-box">
<fieldset>
<legend>Benutzer anlegen</legend>
<label>Benutzername:</label>
<input type="text" class="text-long" name="smbuser"><br><br><br>
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
<input type="text" class="text-long" name="user"><br><br><br>
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
<input type="text" class="text-long" name="deluser"><br><br><br>
<input type="submit" class="button black" name="delete" value="l&ouml;schen">
</fieldset>
</div>

<!--###############################################################	
		Anzeigen der aktuell angelegten Samba Benutzer
	###############################################################-->

<div class="halbe-box lastbox">
<fieldset>
<legend>Aktuelle Benutzer:</legend>
<h5><?=$ausgabe."<br>"?></h5> 
</fieldset>
</div>
