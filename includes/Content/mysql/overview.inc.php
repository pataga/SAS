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

$connected = false;
$data = $server->getMySQLData();
if (is_array($data)) {
    $connected = true;
    $dbModule = new \Classes\Module\MySQL\DBHandler($data);
}

?>

<h3>MySQL</h3>
<div class="halbe-box">
    <fieldset>
        <legend>Allgemeine Informationen</legend>
        <div class="halbe-box"><span style="font-size: 13px; font-weight: bold;">Status</span></div>
        <div class="halbe-box lastbox"><?=$connected?'<span class="aktiv">Verbunden':'<span class="inaktiv">Nicht Verbunden'?></span></div>
        <div class="clearfix"></div>
        <div class="halbe-box"><span style="font-size: 13px; font-weight: bold;">Version</span></div>
        <div class="halbe-box lastbox"><span style="font-size: 13px; font-weight: bold;"><?=$connected?$dbModule->getVersion() :'Unbekannt'?></span></div>
        <div class="clearfix"></div>
        <div class="halbe-box"><span style="font-size: 13px; font-weight: bold;">Datenbankanzahl</span></div>
        <div class="halbe-box lastbox"><span style="font-size: 13px; font-weight: bold;"><?=$connected?$dbModule->getDatabaseCount():'Unbekannt'?></span></div>
        <div class="clearfix"></div>
        <div class="halbe-box"><span style="font-size: 13px; font-weight: bold;">Benutzeranzahl</span></div>
        <div class="halbe-box lastbox"><span style="font-size: 13px; font-weight: bold;"><?=$connected?$dbModule->getUserCount():'Unbekannt'?></span></div>
        <div class="clearfix"></div>
    </fieldset>
</div>

<div class="halbe-box lastbox">
    <fieldset>
        <legend>Konfiguration</legend>
        <div class="halbe-box"><span style="font-size: 13px; font-weight: bold;">Host</span></div>
        <div class="halbe-box lastbox"><span style="font-size: 13px; font-weight: bold;"><?=is_array($data)?$data[\Classes\Server::MYSQL_HOST]:'nicht konfiguriert'?></span></div>
        <div class="clearfix"></div>
        <div class="halbe-box"><span style="font-size: 13px; font-weight: bold;">Port</span></div>
        <div class="halbe-box lastbox"><span style="font-size: 13px; font-weight: bold;"><?=is_array($data)?$data[\Classes\Server::MYSQL_PORT]:'nicht konfiguriert'?></span></div>
        <div class="clearfix"></div>
        <div class="halbe-box"><span style="font-size: 13px; font-weight: bold;">Benutzer</span></div>
        <div class="halbe-box lastbox"><span style="font-size: 13px; font-weight: bold;"><?=is_array($data)?$data[\Classes\Server::MYSQL_USER]:'nicht konfiguriert'?></span></div>
        <div class="clearfix"></div>
        <div align=center><a href="?p=mysql&s=configure" class="button black">Konfiguration &auml;ndern</a></div>
    </fieldset>
</div>

<div class="clearfix"></div>
