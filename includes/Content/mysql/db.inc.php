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

$data = $main->Server()->getMySQLData();
if (!$data) {
    header('Location: ?p=mysql&s=configure');
    exit;
}

$dbModule = new \Classes\Module\MySQL\DBHandler();

//ToDo: Implementierung

?>
<h3>MySQL</h3>
<fieldset>
    <p><b>Modulname: </b>Datenbank-Verwaltung</p>
    <p><b>Modulbeschreibung: </b><br></p>
    <p><b>Programmierer(in):</b> Patrick</p>
    <p><b>Status:</b> in Entwicklung</p>
</fieldset>
