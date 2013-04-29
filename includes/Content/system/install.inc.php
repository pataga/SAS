<?php
/**
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.0.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
 * @author 
 *
 */
 ?>

<h3>Paket Installation</h3>
<form action="index.php?p=system&s=install" method="POST">
    <fieldset>  
        <legend>Paketsuche</legend>	
        <div class="halbe-box">
            <input type="text" class="text-long" name="aptcache">
            <br><br><br>
            <input type="submit" class="button green" name="search" value="suchen">
            <br>
        </div>
        <div class="halbe-box lastbox">
            Gefundene Pakete:
        </div>
    </fieldset>
    <fieldset>
        <legend>Installation</legend>
        <label>Paketname:</label>
        <input type="text" class="text-long" name="aptgetinstall">
        <br><br><br>
        <input type="submit" class="button green" name="install" value="installieren">
    </fieldset>
</from>

