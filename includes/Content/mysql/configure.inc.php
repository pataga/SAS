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
$msg = '';

if (isset($_POST['submission'])) {
    $host = $server->getAddress();
    $remote = new \Classes\MySQL([$host,$_POST['port'],$_POST['username'],$_POST['password']]);
    if ($remote->isAlive()) {
        $mysql->tableAction('sas_server_mysql')->delete(['sid' => $session->getServerID()]);
        
        $mysql->tableAction('sas_server_mysql')->insert
        ([
            'sid' => $session->getServerID(),
            'host' => $host, 
            'port' => $_POST['port'],
            'username' => $_POST['username'], 
            'password' => $_POST['password']
        ]);

        $mysql->tableAction('sas_server_data')->update 
        (
            ['mysql' => 1],
            ['id' => $session->getServerID()]
        );

        $msg = 'Benutzerdaten erfolgreich eingetragen!';
    } else {
        $msg = 'Benutzerdaten inkorrekt!';
    }
}

?>
<fieldset style="margin-top:25px;">
    <legend>MySQL Verbindung einrichten</legend>
    <form action="index.php?p=mysql&s=configure" method="POST">
        <p>
            <label>
                Benutzername <a href="#" class="tooltip3">?
                    <span>Der Benutzername muss f&uuml;r den SAS Host verf&uuml;gbar sein!</span>
                </a>
            </label>
        <input type="text" name="username" placeholder="Benutzername eingeben" class="text-long" required></p>
        <p><label>Passwort</label>
        <input type="password" name="password" placeholder="Passwort eingeben" class="text-long" required></p>
        <p><label>Port</label>
        <input type="text" name="port" placeholder="Standard-Port: 3306" class="text-long" required></p>
        <p><input type="submit" name="submission" value="Benutzerdaten eintragen" class="button grey"></p>
    </form><br><br>
    <?=$msg?>
</fieldset>
 