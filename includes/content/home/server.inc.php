<?php


    /**
    * Licensed under The Apache License
    *
    * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
    * @link https://github.com/pataga/SAS
    * @since SAS v1.0.0
    * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt
    * @author Patrick Farnkopf
    *
    */

    if (isset($_POST['server']) && $_POST['server'] != -1) {
        $session->setServerId($_POST['server']);
        $session->selectServer();
        $loader->reload();
    } else if (isset($_POST['name']) && isset($_POST['shost']) && isset($_POST['sport']) && isset($_POST['suser']) && isset($_POST['spass'])) {
        $database->addServer($_POST['name'], $_POST['shost'], $_POST['sport'], $_POST['suser'], $_POST['spass']);
        $loader->reload();
    }

    $result = $mysql->Query("SELECT id, name, host FROM sas_server_data");
    $server_selection = "";
    while ($row = $result->fetchObject()) {
        $server_selection .= "<option value='$row->id'>Server '$row->name' - $row->host</option>";
    }

    /* STATUS - ÜBERPRÜFUNG 

    $servers = ['localhost', '46.38.238.216', 'apfel.local'];
    $sc = count($servers);

    for ($i = 0; $i <= $sc ; $i++) {
            @$fp = fsockopen($servers[$i], "22", $errno, $errstr, 0.05); //timeout reicht wenn SAS im RZ-Netz ist
            if (!$fp) {
                //offline
            } else {
                //online
            }
        }
    */
?>
<h3>Server auswählen</h3>
<fieldset>
    <p>Bitte w&auml;hlen Sie ihren Server aus, den Sie mit SAS verwalten m&ouml;chten.</p>
    <form action="index.php" method="post">
        <label>Server:</label>
        <select name="server" class="shadow">
            <option value="-1"> </option>
            <?php echo $server_selection; ?>
        </select>
        <br><br>
        <input class="button black"type="submit" value="Server ausw&auml;hlen">
    </form>
</fieldset>
<h3>Server hinzuf&uuml;gen</h3>
<fieldset>
    <form action="index.php" method="post">
        <table>
            <p><label>Server Name:</label>
                <input type="text" name="name" placeholder="bspw.: Uranus" class="text-long required"></p>
            <p><label>Server Host:</label>
                <input type="text" name="shost" placeholder="bspw.: 203.7.201.90" class="text-long required"></p>
            <p><label>Server Domain(s):</label><a href="#" class="tooltip">Info<span><b>Achtung:</b><br>Bitte kein Protokoll (z.B.: http://) angeben!<br>Mehrere Domains durch Kommatrennung möglich, ohne Leerzeichen</span></a>
                <input type="text" name="sport" class="text-long"></p>         
            <p><label>SSH Port:</label>
                <input type="text" name="sport" placeholder="Standard: 22" class="text-long" required></p>
            <p><label>SSH Benutzername: </label>
                <input type="text" name="suser" class="text-long" placeholder="Standard: root" required></p>
            <p><label>SSH Passwort: </label>
                <input type="password" name="spass" class="text-long" required></p>
            <input type="submit" value="Server eintragen" class="button green">
        </table>
    </form>
</fieldset>



<!-- NEUE SERVERVERWALTUNG 
<h3>Serververwaltung</h3>
<table cellpadding="0" cellspacing="0">
    <tr>
        <th>Servername</th>
        <th>IP-Adresse</th>
        <th>Domains</th>
        <th>Status</th>
        <th>Aktionen</th>
    </tr>
    <tr>
        <td>localhost</td>
        <td>127.0.0.1</td>
        <td><a href="http://localhost">mango.local</a></td>        
        <td><span class="unknown">unbekannt</span></td>
        <td class="action">
            <form action="index.php" method="post">
            <input type="submit" class="view" value="Auswählen" name="######">
            <input type="submit" class="edit" value="Bearbeiten" name="######">
            </form>
        </td>
    </tr>
    <tr>
        <td>Melone</td>
        <td>46.38.238.216</td>
        <td>
            <a href="http://webflix.de">webflix.de</a><br>
            <a href="http://melone.yourvserver.net">melone.yourvserver.net</a>
        </td>        
        <td><span class="ok">erreichbar<span></td>
        <td class="action">
            <input type="submit" class="view" value="Auswählen" name="######">
            <input type="submit" class="edit" value="Bearbeiten" name="######">
        </td>
    </tr>
    <tr>
        <td>Apfel</td>
        <td>192.168.56.200</td>
        <td><a href="http://apfel.local">apfel.local</a></td>
        <td><span class="red">nicht erreichbar<span></td>
        <td class="action">
            <input type="submit" class="view" value="Auswählen" name="######">
            <input type="submit" class="edit" value="Bearbeiten" name="######">
        </td>
    </tr>
</table>
-->