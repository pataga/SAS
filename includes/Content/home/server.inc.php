<?php


    /**
    * Licensed under The Apache License
    *
    * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
    * @link https://github.com/pataga/SAS
    * @since SAS v1.0.0
    * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
    * @author Patrick Farnkopf
    *
    */

    if (isset($_POST['select'])) {
        $session->setServerId($_POST['id']);
        $session->selectServer();
        $loader->reload();
    } else if (isset($_POST['name']) && isset($_POST['shost']) && isset($_POST['sport']) && isset($_POST['suser']) && isset($_POST['spass'])) {
        $mysql
        ->tableAction('sas_server_data')
        ->insert([
            'name' => $_POST['name'], 
            'host' => $_POST['shost'], 
            'port' => $_POST['sport'], 
            'user' => $_POST['suser'], 
            'pass' => $_POST['spass'], 
            'soapPort' => $_POST['soapPort'], 
            'soapKey' => $_POST['soapKey']
        ]);

        $loader->reload();
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

    <table cellpadding="0" cellspacing="0">
        <tr>
            <th>Servername</th>
            <th>IP-Adresse</th>
            <th>Domains</th>
            <th>Status</th>
            <th>Aktionen</th>
        </tr>
        <?php
        $result = $mysql->Query("SELECT * FROM sas_server_data");
        while ($row = $result->fetch()) {
        ?>
        <tr>
            <td><?=$row->name?></td>
            <td><?=$row->host?></td>
            <td>
                <?php
                foreach (explode(',', $row->domains) as $domain) {
                ?>
                    <a href="http://<?=trim($domain)?>"><?=$domain?></a><br>
                <?php
                }?>
            </td>
            <td>
                <?php
                try {
                    if (!fsockopen($row->host, "22", $errno, $errstr, 0.1))
                        throw new Exception('Connection failed', 0xA1);
                    echo '<span class="ok">erreichbar</span>';
                } catch (Exception $e) {
                    echo '<span class="red">nicht erreichbar</span>';
                }
                ?>
            </td>
            <td class="action">
                <form action="index.php" method="post">
                    <input type="hidden" name="id" value="<?=$row->id?>"/>
                    <input type="submit" class="view" value="Auswählen" name="select">
                    <input type="submit" class="edit" value="Bearbeiten" name="edit">
                </form>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
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
            <p><label>SOAP Port:</label>
                <input type="text" name="soapPort" placeholder="Daemon Port" class="text-long"></p>
            <p><label>SOAP Key:</label>
                <input type="text" name="soapKey" placeholder="Daemon Schl&uuml;ssel" class="text-long"></p>
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





