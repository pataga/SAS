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


<h3>Neue Samba-Freigabe hinzuf&uuml;gen</h3>
<fieldset>
    <form action="index.php?p=samba&s=shares" method="POST">
        <div class ="viertel-box">
            Freigabe Name: <br><br>
            Verzeichnispfad: <br><br>
            G&uuml;ltige Benutzer: <br><br>
            Schreibrechte f&uuml;r <br><br>
            Create Mask: <br><br>
            Directory Mask: <br><br><br>
            &Ouml;ffentliche Freigabe? 
            <br><br><br>
            Schreibrechte f&uuml;r jeden? 
        </div>
        <div class="dreiviertel-box lastbox">
            <input type="text" class="text-long" name="name" id=""><br><br>
            <input type="text" class="text-long" name="path" id=""><br><br>
            <input type="text" class="text-long" name="validusers" id=""><br><br>
            <input type="text" class="text-long" name="writelist" id=""><br><br>
            <input type="text" class="text-long" name="createmask" id=""><br><br>
            <input type="text" class="text-long" name="directorymask" id="">
            <br><br><br>
            <select name="public">
                <option value="1"> Ja </option>
                <option value="0"> Nein </option>
                <option value=" "> disabled</option>
            </select><br>
            <br>
            <select name="readonly">
                <option value="1"> Ja </option>
                <option value="0"> Nein </option>
                <option value=" "> disabled</option>
            </select>
        </div>
        <div class="clearfix"></div>
        <input type="submit" class="button green" name="add" value="Neue Freigabe Hinzuf&uuml;gen">
    </form>
</fieldset>