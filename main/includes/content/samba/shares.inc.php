<?php

	if(isset($_POST['add']))
	{


		$name = $_POST['name'];
		$path = $_POST['path'];
		$validusers = $_POST['validusers'];
		$writelist = $_POST['writelist'];
		$createmask = $_POST['createmask'];
		$directorymask = $_POST['directorymask'];

		if(isset($_POST['public']))
		{
			if($_POST['public'] == 1)
			$public = "public = yes";
			else if ($_POST['public'] == 0)
			$public = "public = no";
			else
			$public = "";
		}

		if(isset($_POST['writeable']))
		{
			if($_POST['writeable'] == 1)
			$writeable = "writeable = yes";
			else if ($_POST['writeable'] == 1)
			$writeable = "writeable = no";
			else
			$writeable = "";
		}

		if(isset($_POST['readonly']))
		{
			if($_POST['readonly'] == 1)
			$writeable = "read only = yes";
			else if ($_POST['readonly'] == 1)
			$writeable = "read only = no";
			else
			$writeable = "";
		}

		$ssh->openConnection();
		$ssh->execute("echo [$name] >> /etc/samba/smb.conf");
		$ssh->execute("echo $path >> /etc/samba/smb.conf");

}


?>


<html>
<form action="index.php?p=samba&s=shares" method="POST">

	<table >
		<tr>
		<td>Freigabe Name:</td>
		<td><input type="text" name="name" id=""></td>
		</tr>

		<tr>
		<td>Verzeichnispfad:</td>
		<td><input type="text" name="path" id=""></td>
		</tr>

		<tr>
		<td>G&uuml;ltige Benutzer:</td>
		<td><input type="text" name="validusers" id=""></td>
		</tr>

		<tr>
		<td>Schreibrechte f&uuml;r:</td>
		<td><input type="text" name="writelist" id=""></td>
		</tr>

		<tr>
		<td>Create Mask:</td>
		<td><input type="text" name="createmask" id=""></td>
		</tr>

		<tr>
		<td>Directory Mask:</td>
		<td><input type="text" name="directorymask" id=""></td>
		</tr>
	</table>

	<table>
		<tr>
		<td>&Ouml;ffentliche Freigabe?</td>
		<td><select name="public">
		<option value="1"> Ja </option>
		<option value="0"> Nein </option>
		<option value=" "> disabled</option>
		</select></td>
		</tr>

		<tr>
		<td>Schreibrechte f&uuml;r jeden?</td>
		<td><select name="writeable">
		<option value="1"> Ja </option>
		<option value="0"> Nein </option>
		<option value=" "> disabled</option>
		</select></td>
		</tr>

		<tr>
		<td>Nur Leserechte?</td>
		<td><select name="readonly">
		<option value="1"> Ja </option>
		<option value="0"> Nein </option>
		<option value=" "> disabled</option>
		</select></td>
		</tr>
	</table>

<br>
	<input type="submit" name="add" value="Neue Freigabe Hinzuf&uuml;gen">
</form>
</html>
