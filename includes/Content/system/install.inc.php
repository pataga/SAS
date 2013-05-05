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
    $server->execute('apt-get install '.$packetname. ' -y -f'); 
    if (isset($_POST['install']))
        echo '<br><span class="success">Das Paket wurde installiert.</span>';
}


$a = $server->execute('dpkg -l', 2); // Anzeigen der Installierten Pakete

if (isset($_POST['remove'])) {
    $name = $_POST['paketname'];
    $server->execute('apt-get remove --purge '.$name. ' -y -f');
    echo '<br><span class="success">Das Paket wurde deinstalliert.</span>';

}



?>

<br>

<form action="index.php?p=system&s=install" method="POST">
    <fieldset>  
        <legend>Paketsuche</legend> 
        <div class="halbe-box">
            <input type="text" class="text-long" name="aptcache" placeholder="Suchbegriff">
            <br><br><br>
            <input type="submit" class="button blue" name="search" value="suchen">
        </div>
        <div class="halbe-box lastbox">
            Gefundene Pakete: <br><br>
            <div class="listbox">
                <?
                    if (isset($packet) && is_array($packet))
                    foreach ($packet as $value) {
                        echo $value['name']."<br>";
                     }
                 ?>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Installation</legend>
        <input type="text" class="text-long" name="aptgetinstall" placeholder="Paketname">
        <br><br><br>
        <input type="submit" class="button green" name="install" value="installieren">
    </fieldset>
    <fieldset>
        <legend>Deinstallation</legend>
        <div class="halbe-box">
            <input type="text" class="text-long" name="paketname" placeholder="Paketname">
            <br><br><br>
            <input type="submit" class="button pink" name="remove" value="l&ouml;schen">
        </div>
        <div class="halbe-box lastbox">
            Momentan installlierte Pakete auf Ihrem System: <br><br>
            <div class="listbox">
                <?
                    for ($i=6; $i<count($a);$i++) {
                         $line = explode(' ', $a[$i]);
                            echo $line[2].'<br>';
                    }
                ?>
            </div>
        </div>
    </fieldset>
</form>