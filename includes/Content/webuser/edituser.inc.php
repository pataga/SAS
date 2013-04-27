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



$result = $mysql->Query("SELECT * FROM sas_users");
$content = "<table>";
while ($row = $result->fetchObject()) {
    $content .= "<tr><td>".$row->username."</td>";
    $content .= "<td>".$row->email."</td>";
    $content .= "<td><form action='?p=webuser&s=edituser' method='post'><input type='submit' name='edit' value='bearbeiten'>
                        <input type='hidden' name='id' value='".$row->id."'></form></td>";
    $content.="<td><form action='?p=webuser&s=edituser' method='post'><input type='submit' name='delete' value='l&ouml;schen'>
                        <input type='hidden' name='idDelete' value='".$row->id."'></form></td></tr>";
}
$content .= "</table>";

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $result = $mysql->Query("SELECT * FROM sas_users WHERE id = ".$id);
    $row = $result->fetchObject();

    echo '

<h3>Benutzer bearbeiten</h3>
<fieldset>
<form action="index.php?p=webuser&s=edituser" method="post">
    <p><label>Username:</label><input type="text" name="user" value="'.$row->username.'" class="text-long"></p>
    <p><label>E-Mail:</label><input type="text" name="mail" value="'.$row->email.'" class="text-long"></p>
    <p><label>Passwort:</label><input type="password" name="pw" id="" class="text-long"></p>
    <p><label>Passwort wiederholen:</label><input type="password" name="pwr" id="" class="text-long"></p>
    <input type="submit" name="absenden" value="absenden" class="button blue"><br>
    <input type="hidden" name="id" value="'.$id.'">
</fieldset>

<fieldset>
<legend>Rechtevergabe</legend>
    <div class="halbe-box">
<fieldset>
    <legend>Home</legend>
    <p> <div class="drittel-box">&Uuml;bersicht</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div> 
        <div class="drittel-box lastbox"> Verweigern  <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Quickpanel</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
</fieldset>
</div>
<div class="halbe-box lastbox">
<fieldset>
    <legend>MySQL</legend>
    <p> <div class="drittel-box">&Uuml;bersicht</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Benutzer anlegen</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Datenbanke</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
</fieldset>
</div>
<div class="halbe-box">
<fieldset>
    <legend>Postfix</legend>
    <p> <div class="drittel-box">&Uuml;bersicht</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Konfiguration</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Benutzer</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Statistik</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
</fieldset>
</div>
<div class="halbe-box lastbox">
<fieldset>
    <legend>Control</legend>
    <p> <div class="drittel-box">&Uuml;bersicht</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Paket Installation</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Selbstzerst&ouml;rung</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Neustarten</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
</fieldset>
</div>
<div class="halbe-box">
<fieldset>
<legend>FTP</legend>
   <p> <div class="drittel-box">&Uuml;bersicht</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Control</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Verzeichnisse</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Benutzer</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Statistik</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
</fieldset>
</div>
<div class="halbe-box lastbox">
<fieldset>
<legend>Samba</legend>
    <p> <div class="drittel-box">&Uuml;bersicht</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Konfiguration</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">freigaben</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Freigaben bearbeiten</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Benutzer</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
</fieldset>
</div>
<div class="halbe-box">
<fieldset>
    <legend>Apache</legend>
    <p> <div class="drittel-box">&Uuml;bersicht</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Konfiguration</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Control</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Hosting-System</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Module</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Statistik</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">phpinfo</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
</fieldset>

<fieldset>
<legend>Webuser</legend>
    <p> <div class="drittel-box">&Uuml;bersicht</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Benutzer hinzuf&uuml;gen</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Benutzer bearbeiten</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
</fieldset>


<br><br>
    <input type="submit" name="absenden" value="absenden" class="button blue"><br>
    <input type="hidden" name="id" value="'.$id.'">
</form>
<br><br>


</div>
<div class="halbe-box lastbox">
<fieldset>
    <legend>Tools</legend>
    <p> <div class="drittel-box">&Uuml;bersicht</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Konsole</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">CPU Auslastung</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Cronjobs</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Festplatten Informationen</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Hardware Informationen</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
    <p> <div class="drittel-box">Arbeitsspeicher Informationen</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
     <p> <div class="drittel-box">Taskmanager</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
     <p> <div class="drittel-box">Statistiken</div> <div class="drittel-box"> Erlauben <input type="checkbox" name="" id=""></div>
        <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="" id=""></div>
    </p>
</fieldset>
</div>



</fieldset>

        ';
}


if (isset($_POST['absenden'])) {

    if(isset($_POST['pw']) && isset($_POST['pwr']) && $_POST['pw'] == $_POST['pwr']){

        $user=$_POST['user'];
        $email=$_POST['mail'];
        $pw=md5($_POST['pw']);

        $mysql->Query("UPDATE sas_users SET username = '$user', password = '$pw', email ='$email' WHERE id = ".$_POST['id']);
    }
    //Überprüfen ob Passwort gesetzt
    //$mysql->Query("UPDATE sas_users SET ... = ... WHERE id = ".$_POST['id']);
}


if (isset($_POST['edituser'])) {
    $username = $_POST['username'];
}

if (isset($_POST['delete'])) {
    $idDelete= $_POST['idDelete'];
    $mysql->Query("DELETE FROM sas_users WHERE id=$idDelete");
    $loader->reload();
}

?>




<!--############ User bearbeiten ############//-->

<? if (!isset($_POST['id'])) {?>
<br>
<fieldset>
    <legend>Benutzer bearbeiten</legend>
    <?=$content?>
<form action="index.php?p=webuser&s=edituser" method="POST">   
</form>
</fieldset>

<?}?>

