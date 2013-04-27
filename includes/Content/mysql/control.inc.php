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

if (isset($_POST['start'])) {
    $server->execute('service mysql start');
}

if (isset($_POST['stop'])) {
    $server->execute('service mysql stop');
}

if (isset($_POST['reload'])) {
    $server->execute('service mysql reload');
}

if (isset($_POST['restart'])) {
    $server->execute('service mysql restart');
}


?>
<h3>MySQL-Steuerung</h3>
<fieldset>
    <div class="drittel-box">
        <h5>Start / Stop</h5>

        <p>
            <a href="#" class="tooltip3">Information
                <span><?=$server->getServiceStatus('mysql')?'Stoppt':'Startet'?> den Dienst</span>
            </a>
        </p>

        <form action="?p=mysql&s=control" method="post">
            <?=
                $server->getServiceStatus('apache2') ?
                '<input type="submit" name="stop" value="Stop" class="button pink">' :
                '<input type="submit" name="start" value="Start" class="button green">';
            ?>
        </form>
    </div>

    <div class="drittel-box">
        <h5>Reload</h5>

        <p>
            <a href="#" class="tooltip3">Information
                <span>Lädt die Konfigurationsdateien neu</span>
            </a>
        </p>

        <form action="?p=mysql&s=control" method="post">
            <input type="submit" name="reload" value="neu laden" class="button darkblue">
        </form>
    </div>

    <div class="drittel-box lastbox">
        <h5>Restart</h5>

        <p>
            <a href="#" class="tooltip">Information
                <span>Startet den MySQL-Dienst neu</span>
            </a>
        </p>

        <form action="?p=mysql&s=control" method="post">
            <input type="submit" name="restart" value="neu starten" class="button darkblue">
        </form>

    </div>

    <div class="clearfix"></div>
</fieldset>
