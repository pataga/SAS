<?php
    /*
     *  Mit der Server Klasse können Server Aktionen durchgeführt werden.
     *  Das Objekt der Klasse Server heißt $server und ist aus jeder include Datei erreichbar
     */

    $id = $server->getID();                 //Rückgabewert ist die ServerID des aktuellen Servers
    $array = $server->getServerData($id);   //Gibt einen Array mit den SSH Zugangsdaten zurück. Als Übergabeparameter wird die ServerID benötigt

    if ($server->isInstalled('mysql'))      //Prüft ob das Paket im Übergabeparameter installiert wurde
        echo 'MySQL ist installiert';
    else
        echo 'MySQL ist nicht installiert';

    $array = $server->getMySQLData();       //Gibt einen Array mit den MySQL Zugangsdaten des Remote Servers zurück
    $array = $server->serviceStatus($ssh);  //Gibt einen boolschen Array mit den Stati der Serverdienste zurück
    $bool = $server->getServiceStatus($ssh, $service);  //Gibt einen boolschen Wert mit dem Status von $service zurück
    $server->addToFile($ssh, $file, $content);          //Hängt an eine beliebige Datei (zB smb.conf) den Inhalt der $content an. Zeilenumbruch geschieht mit \n

?>
