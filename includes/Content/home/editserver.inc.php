<?php

/**
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.1.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
 * @author Patrick Farnkopf
 *
 */

if (!isset($_POST['edit'])) {
    $loader->reload();
}

$id = $_POST['id'];
$result = $mysql->Query('SELECT * FROM sas_server_data WHERE id = '.mysql_real_escape_string($id));
if ($row = $result->fetch()) {
?>

<h3><?=$row->name?> bearbeiten</h3>
<fieldset>
    <form action="index.php" method="post">
        <table>
            <p><label>Server Name:</label>
                <input type="text" name="name" placeholder="bspw.: Uranus" autocomplete="off" class="text-long required" value="<?=$row->name?>"></p>
            <p><label>Server Host:</label>
                <input type="text" name="shost" placeholder="bspw.: 203.7.201.90" autocomplete="off" class="text-long required" value="<?=$row->host?>"></p>
            <p><label>Server Domain(s):</label><a href="#" class="tooltip">Info<span><b>Achtung:</b><br>Bitte kein Protokoll (z.B.: http://) angeben!<br>Mehrere Domains durch Kommatrennung möglich, ohne Leerzeichen</span></a>
                <input type="text" name="sdomains" class="text-long" autocomplete="off" value="<?=$row->domains?>"></p>
            <p><label>SOAP Port:</label>
                <input type="text" name="soapPort" placeholder="Daemon Port" class="text-long" autocomplete="off" value="<?=$row->soapPort?>"></p>
            <p><label>SOAP Key:</label>
                <input type="text" name="soapKey" placeholder="Daemon Schl&uuml;ssel" class="text-long" autocomplete="off" value="<?=$row->soapKey?>"></p>
            <p><label>SSH Port:</label>
                <input type="text" name="sport" placeholder="Standard: 22" class="text-long" autocomplete="off" required value="<?=$row->port?>"></p>
            <p><label>SSH Benutzername: </label>
                <input type="text" name="suser" class="text-long" placeholder="Standard: root" autocomplete="off" value="<?=$row->user?>"></p>
            <p><label>neues SSH Passwort: </label>
                <input type="password" name="spass" class="text-long"  autocomplete="off"></p>
            <input type="submit" value="Speichern" name="save" class="button green">
            <input type="hidden" name="id" value="<?=$_POST['id']?>"/>
        </table>
    </form>
</fieldset>

<?php
} else {
    echo 'Ein Fehler ist aufgetreten!';
}
?>
