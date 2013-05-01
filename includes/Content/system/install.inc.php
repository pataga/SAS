<?php
/**
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.0.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
 * @author Tanja Weiser
 *
 */


if (isset($_POST['search'])) {
   $string = $_POST['aptcache'];
   $output = $server->execute('apt-cache search '.$string,2);

    $packet = array();
    for ($i = 0; $i < count($output); $i++) {
        $line = explode(' - ', $output[$i]);
        $packet[$i]['name'] = $line[0];
    }

}

if (isset($_POST['install'])) {
    $packetname = $_POST['aptgetinstall'];
    $server->execute('apt-get install '.$packetname. '-y -f');
}

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
            Gefundene Pakete: <br>
            <div class="listbox">
                <?
                    foreach ($packet as $value) {
                        echo $value['name']."<br>";
                     }
                 ?>
            </div>
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

