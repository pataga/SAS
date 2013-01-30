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
        require_once './includes/content/samba/install.inc.php';
        exit;
    }

	if(isset($_POST['add']))
	{
		$name = $_POST['name'];
		$path = $_POST['path'];
		$validusers = $_POST['validusers'];
		$writelist = $_POST['writelist'];
		$readonly = $_POST['readonly'];

		if(isset($_POST['public']))
		{
			if($_POST['public'] == 1)
			$public = "public = yes";
			else 
			$public = "public = no";
		}

		if(isset($_POST['writable']))
		{
			if($_POST['writable'] == 1)
			$writable = "writable = yes";
			else 
			$writable = "writable = no";
		}

		if(isset($_POST['readonly']))
		{
			if($_POST['readonly'] == 1)
			$readonly = "read only = yes";
			else 
			$readonly = "read only = no";
		}

		$ssh->openConnection();
		// Öffnen der Verbindung

        $content = "
        [$name]
        path = $path
        valid users = $validusers
        create mask = $createmask
        directory mask = $directorymask
        public = $public
        writable = $writable
        read only = $readonly";

        $server->addToFile($ssh, '/etc/samba/smb.conf', $content);
        // Schreiben der neuen Freigabe in die smb.conf
        $ssh->execute('service smbd reload');
        // Neustart
        }

?>


<h3>Freigaben</h3>
<br>
Hinweis: Nach dem hinzufügen einer neuen Freigabe wird der Dienst automatisch neu gestartet.
<br><br>
<fieldset>
    <legend>Freigabe hinzuf&uuml;gen</legend>
    <form action="index.php?p=samba&s=shares" method="POST">
        <div class ="viertel-box"> 
            Freigabe Name: <br><br>
            Verzeichnispfad: <br><br>
            G&uuml;ltige Benutzer: <br><br>
            Schreibrechte f&uuml;r: <br><br>
            Schreibrechte für die Gruppe: <br><br><br>           
            &Ouml;ffentliche Freigabe? 
            <br><br>
            Schreibrechte f&uuml;r jeden? 
            <br><br>
            Nur lesbar?
            <br><br><br>
            <b>Directory Mode:</b><br><br>
            Besitzer:<br><br>
            Gruppe:<br><br>
            Sonstige:
            <br><br><br>
            <b>Create Mode:</b><br><br>
            Besitzer:<br><br>
            Gruppe:<br><br>
            Sonstige:



        </div>
        <div class="dreiviertel-box lastbox">
            <input type="text" class="text-long" name="name" id=""><br><br>
            <input type="text" class="text-long" name="path" id=""><br><br>
            <input type="text" class="text-long" name="validusers" id=""><br><br>
            <input type="text" class="text-long" name="writelist" id=""><br><br>
             <input type="text" class="text-long" name="" id="" required list="gruppen">
            <datalist id="gruppen">

                <option value="Gruppe 1"></option>
                <option value="Gruppe 2"></option>
                <option value="Admin"></option>
                <option value="Wichtig"></option>
                <option value="XYZ"></option>
            </datalist><br><br><br>

            <select name="public">
                <option value="1"> Ja </option>
                <option value="0"> Nein </option>
            </select>
            <br>
             <select name="writable">
                <option value="1"> Ja </option>
                <option value="0"> Nein </option>n>
            </select>
            <br>
            <select name="readonly">
                <option value="1"> Ja </option>
                <option value="0"> Nein </option>
            </select>
            <br><br>

            Lesen &nbsp; Schreiben &nbsp; Ausf&uuml;hren <br>
            <br>
            &nbsp;&nbsp;&nbsp;<input type="checkbox" name="dbr" value="db">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="dbw" value="db"
            >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="dbx" value="db">&nbsp;
            <br><br>
            &nbsp;&nbsp;&nbsp;<input type="checkbox" name="dgr" value="dg">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="dgw" value="dg">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="dgx" value="dg">&nbsp;
            <br><br>
            &nbsp;&nbsp;&nbsp;<input type="checkbox" name="dsr" value="ds">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="dsw" value="ds">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="dsx" value="ds">&nbsp;

            <br><br><br>
            Lesen &nbsp; Schreiben &nbsp; Ausf&uuml;hren <br>
            <br>
            &nbsp;&nbsp;&nbsp;<input type="checkbox" name="cbr" value="cb">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="cbw" value="cb">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="cbx" value="cb">&nbsp;
            <br><br>
            &nbsp;&nbsp;&nbsp;<input type="checkbox" name="cgr" value="cg">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="cgw" value="cg">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="cgx" value="cg">&nbsp;
            <br><br>
            &nbsp;&nbsp;&nbsp;<input type="checkbox" name="csr" value="cs">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="csw" value="cs">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="csx" value="cs">&nbsp;

        </div>
        
        <div class="clearfix"></div>
        <input type="submit" class="button green" name="add" value="Neue Freigabe Hinzuf&uuml;gen">
    </form>
</fieldset>