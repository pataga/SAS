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
<fieldset>
<form action="index.php?p=samba&s=shares" method="POST">

		<h3>Neue Samba-Freigabe hinzuf&uuml;gen</h3>

	<div class ="viertel-box">

			Freigabe Name: <br>
			Verzeichnispfad: <br>
			G&uuml;ltige Benutzer: <br>
			Schreibrechte f&uuml;r <br>
			Create Mask: <br>
			Directory Mask: <br>

			&Ouml;ffentliche Freigabe? <br>
			Schreibrechte f&uuml;r jeden? 

	</div>

	<div class="dreiviertel-box lastbox">

			<input type="text" name="name" id=""><br>
			<input type="text" name="path" id=""><br>
			<input type="text" name="validusers" id=""><br>
			<input type="text" name="writelist" id=""><br>
			<input type="text" name="createmask" id=""><br>
			<input type="text" name="directorymask" id=""><br>

			<select name="public">
				<option value="1"> Ja </option>
				<option value="0"> Nein </option>
				<option value=" "> disabled</option>
			</select><br>

			<select name="readonly">
				<option value="1"> Ja </option>
				<option value="0"> Nein </option>
				<option value=" "> disabled</option>
			</select>
	</div>

	    <input type="submit" class="button green" name="add" value="Neue Freigabe Hinzuf&uuml;gen">

</form>
</fieldset>
</html>
