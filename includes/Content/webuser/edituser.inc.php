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

error_reporting(E_ERROR | E_WARNING | E_PARSE);

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

<!--############################### Benutzerdaten bearbeiten ########################################-->

<fieldset>
<form action="index.php?p=webuser&s=edituser" method="post">
    <p><label>Username:</label><input type="text" name="user" value="'.$row->username.'" class="text-long"></p>
    <p><label>E-Mail:</label><input type="text" name="mail" value="'.$row->email.'" class="text-long"></p>
    <p><label>Passwort:</label><input type="password" name="pw" value="" class="text-long"></p>
    <p><label>Passwort wiederholen:</label><input type="password" name="pwr" value="" class="text-long"></p>
    <input type="submit" name="absenden" value="absenden" class="button blue"><br>
    <input type="hidden" name="id" value="'.$id.'">
</fieldset>

<fieldset>
<legend>Rechtevergabe</legend>
<span class="info"><b>Hinweis:</b> Die Rechtevergabe ist global. Das heißt, dass die Rechte die Sie hier für die Benutzer vegeben auf jeden Ihrer Server angewandt werden.</span>
<br>

<!--############################### HOME ########################################-->

<div class="halbe-box">
<fieldset>
    <legend>Home</legend>
        <p> <div class="drittel-box">&Uuml;bersicht</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="1[]" value="0x01"'.($perm->isPermitted(1, 0x01) ? 'checked' : '').'></div> 
            <div class="drittel-box lastbox"> Verweigern  <input type="checkbox" name="1[]" value="0x00"'.($perm->isPermitted(1, 0x01) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Quickpanel</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="1[]" value="0x02"'.($perm->isPermitted(1, 0x02) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="1[]" value="0x00"'.($perm->isPermitted(1, 0x02) ? '' : 'checked').'></div>
        </p>
</fieldset>
</div>

<!--############################### PLUGINS ########################################-->

<div class="halbe-box lastbox">
<fieldset>
<legend>Plugins</legend>
        <p> <div class="drittel-box">&Uuml;bersicht</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="10[]" id="0x01" '.($perm->isPermitted(10, 0x01) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="10[]" id="0x00"'.($perm->isPermitted(10, 0x01) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Plugin hinzuf&uuml;gen</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="10[]" id="0x02"'.($perm->isPermitted(10, 0x02) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="10[]" id="0x00"'.($perm->isPermitted(10, 0x02) ? '' : 'checked').'></div>
        </p>
</fieldset>
</div>

<!--############################### PROFTPD ########################################-->

<div class="halbe-box">
<fieldset>
<legend>ProFTPD</legend>
       <p> <div class="drittel-box">&Uuml;bersicht</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="3[]" value="0x01"'.($perm->isPermitted(3, 0x01) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="3[]" value="0x00"'.($perm->isPermitted(3, 0x01) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Konfiguration</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="3[]" value="0x02"'.($perm->isPermitted(3, 0x02) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="3[]" value="0x00"'.($perm->isPermitted(3, 0x02) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Steuerung</div>    
            <div class="drittel-box"> Erlauben <input type="checkbox" name="3[]" value="0x04"'.($perm->isPermitted(3, 0x04) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="3[]" value="0x00"'.($perm->isPermitted(3, 0x04) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Statistiken</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="3[]" value="0x10"'.($perm->isPermitted(3, 0x10) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="3[]" value="0x00"'.($perm->isPermitted(3, 0x10) ? '' : 'checked').'></div>
        </p>
</fieldset>
</div>

<!--############################### SAMBA ########################################-->

<div class="halbe-box lastbox">
<fieldset>
<legend>Samba</legend>
        <p> <div class="drittel-box">&Uuml;bersicht</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="5[]" value="0x01"'.($perm->isPermitted(5, 0x01) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="5[]" value="0x00"'.($perm->isPermitted(5, 0x01) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Freigaben</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="5[]" value="0x02"'.($perm->isPermitted(5, 0x02) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="5[]" value="0x00"'.($perm->isPermitted(5, 0x02) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Steuerung</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="5[]" value="0x08"'.($perm->isPermitted(5, 0x08) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="5[]" value="0x00"'.($perm->isPermitted(5, 0x08) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Benutzer</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="5[]" value="0x10"'.($perm->isPermitted(5, 0x10) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="5[]" value="0x00"'.($perm->isPermitted(5, 0x10) ? '' : 'checked').'></div>
        </p>
</fieldset>
</div>

<!--############################### MYSQL ########################################-->

<div class="halbe-box">
<fieldset>
    <legend>MySQL</legend>
        <p> <div class="drittel-box">&Uuml;bersicht</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="4[]" value="0x01"'.($perm->isPermitted(4, 0x01) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="4[]" value="0x00"'.($perm->isPermitted(4, 0x01) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Steuerung</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="4[]" id="0x40"'.($perm->isPermitted(4, 0x40) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="4[]" value="0x00"'.($perm->isPermitted(4, 0x040 ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Datenbank Verwaltung</div>    
            <div class="drittel-box"> Erlauben <input type="checkbox" name="4[]" value="0x08"'.($perm->isPermitted(4, 0x08) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="4[]" value="0x00"'.($perm->isPermitted(4, 0x08) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Importieren / Exportieren</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="4[]" value="0x10"'.($perm->isPermitted(4, 0x10) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="4[]" value="0x00"'.($perm->isPermitted(4, 0x10) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Konsole</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="4[]" value="0x20"'.($perm->isPermitted(4, 0x20) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="4[]" value="0x00"'.($perm->isPermitted(4, 0x20) ? '' : 'checked').'></div>
        </p>
</fieldset>
</div>

<!--############################### TOOLS ########################################-->

<div class="halbe-box lastbox">
<fieldset>
    <legend>Tools</legend>
        <p> <div class="drittel-box">&Uuml;bersicht</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="8[]" value="0x01"'.($perm->isPermitted(8, 0x01) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="8[]" value="0x00"'.($perm->isPermitted(8, 0x01) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">HW Informationen</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="8[]" value="0x02"'.($perm->isPermitted(8, 0x02) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="8[]" value="0x00"'.($perm->isPermitted(8, 0x02) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">HDD Informationen</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="8[]" value="0x04"'.($perm->isPermitted(8, 0x04) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="8[]" value="0x00"'.($perm->isPermitted(8, 0x04) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">RAM Informationen</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="8[]" value="0x08"'.($perm->isPermitted(8, 0x08) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="8[]" value="0x00"'.($perm->isPermitted(8, 0x08) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Netzwerk-Tools</div>
            <div class="drittel-box"> Erlauben <input type="checkbox" name="8[]" value="0x10"'.($perm->isPermitted(8, 0x10) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="8[]" value="0x00"'.($perm->isPermitted(8, 0x10) ? '' : 'checked').'></div>
        </p>
</fieldset>
</div>

<!--############################### APACHE ########################################-->

<div class="halbe-box">
<fieldset>
    <legend>Apache</legend>
        <p> <div class="drittel-box">&Uuml;bersicht</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="2[]" value="0x01"'.($perm->isPermitted(2, 0x01) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="2[]" value="0x00"'.($perm->isPermitted(2, 0x01) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Steuerung</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="2[]" value="0x02"'.($perm->isPermitted(2, 0x02) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="2[]" value="0x00"'.($perm->isPermitted(2, 0x02) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Directory</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="2[]" value="0x20"'.($perm->isPermitted(2, 0x20) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="2[]" value="0x00"'.($perm->isPermitted(2, 0x20) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Module</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="2[]" value="0x04"'.($perm->isPermitted(2, 0x04) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="2[]" value="0x00"'.($perm->isPermitted(2, 0x04) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">PHP</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="2[]" value="0x08"'.($perm->isPermitted(2, 0x08) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="2[]" value="0x00"'.($perm->isPermitted(2, 0x08) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">PHP-Informationen</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="2[]" value="0x10"'.($perm->isPermitted(2, 0x10) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="2[]" value="0x00"'.($perm->isPermitted(2, 0x10) ? '' : 'checked').'></div>
        </p>
</fieldset>
</div>

<!--############################### LOGS ########################################-->

<div class="halbe-box lastbox">
<fieldset>
<legend>Logs</legend>
        <p> <div class="drittel-box">&Uuml;bersicht</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="6[]" id="0x01"'.($perm->isPermitted(6, 0x01) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="6[]" id="0x00"'.($perm->isPermitted(6, 0x01) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Bootmeldungen</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="6[]" id="0x02"'.($perm->isPermitted(6, 0x02) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="6[]" id="0x00"'.($perm->isPermitted(6, 0x02) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Authentifizierung</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="6[]" id="0x04"'.($perm->isPermitted(6, 0x04) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="6[]" id="0x00"'.($perm->isPermitted(6, 0x04) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">System</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="6[]" id="0x08"'.($perm->isPermitted(6, 0x08) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="6[]" id="0x00"'.($perm->isPermitted(2, 0x08) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Apache</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="6[]" id="0x10"'.($perm->isPermitted(6, 0x10) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="6[]" id="0x00"'.($perm->isPermitted(6, 0x10) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">MySQL</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="6[]" id="0x20"'.($perm->isPermitted(6, 0x20) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="6[]" id="0x00"'.($perm->isPermitted(6, 0x20) ? '' : 'checked').'></div>
        </p>
</fieldset>
</div>

<!--############################### SYSTEM ########################################-->

<div class="halbe-box">
<fieldset>
    <legend>System</legend>
        <p> <div class="drittel-box">&Uuml;bersicht</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="7[]" value="0x01"'.($perm->isPermitted(7, 0x01) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="7[]" value="0x00"'.($perm->isPermitted(7, 0x01) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Konsole</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="7[]" value="0x02"'.($perm->isPermitted(7, 0x02) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="7[]" value="0x00"'.($perm->isPermitted(7, 0x02) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Cronjobs</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="7[]" value="0x04"'.($perm->isPermitted(7, 0x04) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="7[]" value="0x00"'.($perm->isPermitted(7, 0x04) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Taskmanager</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="7[]" value="0x08"'.($perm->isPermitted(7, 0x08) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="7[]" value="0x00"'.($perm->isPermitted(7, 0x08) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">User&Gruppen</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="7[]" value="0x10"'.($perm->isPermitted(7, 0x10) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="7[]" value="0x00"'.($perm->isPermitted(7, 0x10) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Selbstzerst&ouml;rung</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="7[]" value="0x20"'.($perm->isPermitted(7, 0x20) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="7[]" value="0x00"'.($perm->isPermitted(7, 0x20) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Paketverwaltung</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="7[]" value="0x40"'.($perm->isPermitted(7, 0x40) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="7[]" value="0x00"'.($perm->isPermitted(7, 0x40) ? '' : 'checked').'></div>
        </p>
</fieldset>
</div>

<!--############################### WEBUSER ########################################-->

<div class="halbe-box lastbox">
<fieldset>
<legend>Webuser</legend>
        <p> <div class="drittel-box">&Uuml;bersicht</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="9[]" id="0x01"'.($perm->isPermitted(9, 0x01) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="9[]" id="0x00"'.($perm->isPermitted(9, 0x01) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Benutzer hinzuf&uuml;gen</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="9[]" id="0x02"'.($perm->isPermitted(9, 0x02) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="9[]" id="0x00"'.($perm->isPermitted(9, 0x02) ? '' : 'checked').'></div>
        </p>
        <p> <div class="drittel-box">Benutzer bearbeiten</div> 
            <div class="drittel-box"> Erlauben <input type="checkbox" name="9[]" id="0x04"'.($perm->isPermitted(9, 0x04) ? 'checked' : '').'></div>
            <div class="drittel-box lastbox"> Verweigern <input type="checkbox" name="9[]" id="0x00"'.($perm->isPermitted(9, 0x04) ? '' : 'checked').'></div>
        </p>
</fieldset>
</div>


<!--############################### SUBMIT BUTTON ########################################-->

<div class="halbe-box">
<br><br>
    <input type="submit" name="absenden" value="absenden" class="button blue"><br>
    <input type="hidden" name="id" value="'.$id.'">
<br><br>
</div>


</form>
</fieldset>

        ';
}


if (isset($_POST['absenden'])) {

    if(isset($_POST['pw']) && isset($_POST['pwr']) && $_POST['pw'] == $_POST['pwr']) {

        $user=$_POST['user'];
        $email=$_POST['mail'];
        $pw=sha1(sha1($_POST['user']).sha1($_POST['pw']));

        $mysql->Query("UPDATE sas_users SET username = '$user', password = '$pw', email ='$email' WHERE id = ".$_POST['id']);
    }

    for ($i=1; $i<=10; $i++) {
        $bitmask = 0x00;
        $mysql->Query("DELETE FROM sas_user_permission WHERE uid = ".$_POST['id']." AND pid = $i");
        if (@isset($_POST[$i])) {
            foreach (@$_POST[$i] as $mask) {
                $bitmask |= hexdec($mask);
            }
        }
        $mysql->Query("INSERT INTO sas_user_permission (pid, uid, sid, bitmask) VALUES ($i, ".$_POST['id'].", 0, $bitmask)");
    }

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

