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

//============================================================================
//Abfrage der Checkboxen Directory Mode - Besitzer

    if(isset($_POST['dbr']) && isset($_POST['dbw']) && isset($_POST['dbx'])){
          $DirectoryUser="7";
    }
    else if (isset($_POST['dbr']) && isset($_POST['dbw'])) {
          $DirectoryUser="6";
    }
    else if (isset($_POST['dbr']) && isset($_POST['dbx'])) {
          $DirectoryUser="5";
    }
    else if (isset($_POST['dbr'])) {
          $DirectoryUser="4";
    }
    else if (isset($_POST['dbw']) && isset($_POST['dbx'])) {
          $DirectoryUser="3";
    }
    else if (isset($_POST['dbw'])) {
          $DirectoryUser="2";
    }
    else if (isset($_POST['dbx'])) {
          $DirectoryUser="1";
    }
    else  $DirectoryUser="0";
//============================================================================

//============================================================================
//Abfrage der Checkboxen Directory Mode - Gruppen

    if(isset($_POST['dgr']) && isset($_POST['dgw']) && isset($_POST['dgx'])){
          $DirectoryGroup="7";
    }
    else if (isset($_POST['dgr']) && isset($_POST['dgw'])) {
          $DirectoryGroup="6";
    }
    else if (isset($_POST['dgr']) && isset($_POST['dgx'])) {
          $DirectoryGroup="5";
    }
    else if (isset($_POST['dgr'])) {
          $DirectoryGroup="4";
    }
    else if (isset($_POST['dgw']) && isset($_POST['dgx'])) {
          $DirectoryGroup="3";
    }
    else if (isset($_POST['dgw'])) {
          $DirectoryGroup="2";
    }
    else if (isset($_POST['dgx'])) {
          $DirectoryGroup="1";
    }
    else  $DirectoryGroup="0";
//============================================================================

//============================================================================
//Abfrage der Checkboxen Directory Mode - Sonstige

    if(isset($_POST['dsr']) && isset($_POST['dsw']) && isset($_POST['dsx'])){
          $DirectorySonst="7";
    }
    else if (isset($_POST['dsr']) && isset($_POST['dsw'])) {
          $DirectorySonst="6";
    }
    else if (isset($_POST['dsr']) && isset($_POST['dsx'])) {
          $DirectorySonst="5";
    }
    else if (isset($_POST['dsr'])) {
          $DirectorySonst="4";
    }
    else if (isset($_POST['dsw']) && isset($_POST['dsx'])) {
          $DirectorySonst="3";
    }
    else if (isset($_POST['dsw'])) {
          $DirectorySonst="2";
    }
    else if (isset($_POST['dsx'])) {
          $DirectorySonst="1";
    }
    else  $DirectorySonst="0";
//============================================================================

$dm = $DirectoryUser.$DirectoryGroup.$DirectorySonst;

//============================================================================
//Abfrage der Checkboxen Create Mode - Besitzer

    if(isset($_POST['cbr']) && isset($_POST['cbw']) && isset($_POST['cbx'])){
          $CreateUser="7";
    }
    else if (isset($_POST['cbr']) && isset($_POST['cbw'])) {
          $CreateUser="6";
    }
    else if (isset($_POST['dcbr']) && isset($_POST['cbx'])) {
          $CreateUser="5";
    }
    else if (isset($_POST['cbr'])) {
          $CreateUser="4";
    }
    else if (isset($_POST['cbw']) && isset($_POST['cbx'])) {
          $CreateUser="3";
    }
    else if (isset($_POST['cbw'])) {
          $CreateUser="2";
    }
    else if (isset($_POST['cbx'])) {
          $CreateUser="1";
    }
    else  $CreateUser="0";
//============================================================================

//============================================================================
//Abfrage der Checkboxen Create Mode - Gruppen

    if(isset($_POST['dcgr']) && isset($_POST['cgw']) && isset($_POST['cgx'])){
          $CreateGroup="7";
    }
    else if (isset($_POST['cgr']) && isset($_POST['cgw'])) {
          $CreateGroup="6";
    }
    else if (isset($_POST['cgr']) && isset($_POST['cgx'])) {
          $CreateGroup="5";
    }
    else if (isset($_POST['cgr'])) {
          $CreateGroup="4";
    }
    else if (isset($_POST['cgw']) && isset($_POST['cgx'])) {
          $CreateGroup="3";
    }
    else if (isset($_POST['cgw'])) {
          $CreateGroup="2";
    }
    else if (isset($_POST['cgx'])) {
          $CreateGroup="1";
    }
    else  $CreateGroup="0";
//============================================================================

//============================================================================
//Abfrage der Checkboxen Create Mode - Sonstige

    if(isset($_POST['csr']) && isset($_POST['csw']) && isset($_POST['csx'])){
          $CreateSonst="7";
    }
    else if (isset($_POST['csr']) && isset($_POST['csw'])) {
          $CreateSonst="6";
    }
    else if (isset($_POST['csr']) && isset($_POST['csx'])) {
          $CreateSonst="5";
    }
    else if (isset($_POST['csr'])) {
          $CreateSonst="4";
    }
    else if (isset($_POST['csw']) && isset($_POST['csx'])) {
          $CreateSonst="3";
    }
    else if (isset($_POST['csw'])) {
          $CreateSonst="2";
    }
    else if (isset($_POST['csx'])) {
          $CreateSonst="1";
    }
    else  $CreateSonst="0";
//============================================================================
    $cm = $CreateUser.$CreateGroup.$CreateSonst;
//============================================================================
        $content = "
        [$name]
        path = $path
        valid users = $validusers
        $public
        $writable
        $readonly
        directory mask = $dm
        create mask = $cm"
        ;

        $server->addToFile('/etc/samba/smb.conf', $content);
        // Schreiben der neuen Freigabe in die smb.conf
        $server->execute('service smbd reload');
        // Neustart


    }

?>

<br><br>
<fieldset>
<legend>Was sind Freigaben unter Samba?</legend>
Samba arbeitet als Server sobald Datenträger mit anderen Rechnern im Netzwerk geteilt werden.<br>
Um Bestimmte Ordner für andere Rechner freigeben zu können muss eine neue Freigabe in der Konfigurationsdatei von Samba eingetragen werden.
Die Freigaben tauchen in der Netzwerkumgebung auf und können bei Bedarf auch als festes Laufwerk eingebunden werden.
</fieldset>
<fieldset>
    <legend>Freigabe hinzuf&uuml;gen</legend>
    <form action="index.php?p=samba&s=shares" method="POST">
        <div class ="viertel-box"> 
            Freigabename 
                <a href="#" class="tooltip3">?
                <span><b>Info:</b><br>Name der neuen Freigabe.
                </span></a><br><br>
            Verzeichnispfad: 
                <a href="#" class="tooltip3">?
                <span><b>Info:</b><br>Hier geben Sie den Pfad für das Verzeichniss an, dass SIe Freigeben möchten<br><br><b>Achtung:</b>
                    Hier muss der absolute Pfad angegeben werden!
                </span></a><br><br>
            G&uuml;ltige Benutzer:
                <a href="#" class="tooltip3">?
                <span><b>Info:</b><br>Hier können Benutzer angegeben werden, welche die Berechtigung haben, nach Passwortabfrage, dieses Verzeichnis zu benutzen.
                </span></a><br><br>
            Schreibrechte f&uuml;r:
                <a href="#" class="tooltip3">?
                <span><b>Info:</b><br>Hier können Benutzer angegeben werden, welche Schreibrechte erhalten sollen.<br><br>
                    Bitte trennen Sie die einzelnen Benutzer mit einem Komma.<br>
                    Beispiel: user1, user2, user3
                </span></a><br><br>
            Schreibrechte für die Gruppe:
                <a href="#" class="tooltip3">?
                <span><b>Info:</b><br>Hier können Sie Gruppen angeben, die Schreibrechte erhalten sollen.<br><br>
                    Bitte trennen Sie die einzelnen Gruppen mit einem Komma.<br>
                    Beispiel: group1, group2, group3
                </span></a><br><br><br>          
            &Ouml;ffentliche Freigabe? 
            <br><br>
            Schreibrechte f&uuml;r jeden? 
            <br><br>
            Nur lesbar?
            <br><br><br>
            <b>Directory Mask:</b>
            <a href="#" class="tooltip3">Info
                <span><b>Info:</b><br>Hier können Sie die <b><u>Rechtemaske für Dateien</u></b> angeben die im Verzeichnis neu angelegt werden.<br>
                    Sie haben die Möglichkeit die Rechte für Besitzer, Gruppen und Sonstige Benutzer einzustellen. Hierbei müssen sie entscheiden welche Rechte
                    die verschiedenen User besitzen sollen.<br></span>
            </a><br><br>
            Besitzer:<br><br>
            Gruppe:<br><br>
            Sonstige:
            <br><br><br>
            <b>Create Mask:</b>
            <a href="#" class="tooltip3">Info
                <span><b>Info:</b><br>Hier können Sie die <b><u>Rechtemaske für Verzeichnisse</u></b> angeben die im Verzeichnis neu angelegt werden.<br>
                    Sie haben die Möglichkeit die Rechte für Besitzer, Gruppen und Sonstige Benutzer einzustellen. Hierbei müssen sie entscheiden welche Rechte
                    die verschiedenen User besitzen sollen.<br></span>
            </a><br><br>
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
        <input type="submit" class="button green" name="add" value="Neue Freigabe Hinzuf&uuml;gen"><br><br>
        <span class="info">Hinweis: Nach dem hinzufügen einer neuen Freigabe wird der Dienst automatisch neu gestartet.</span>
    </form>
</fieldset>