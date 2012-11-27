<?php
    /*
     *  Mit der SSH Klasse, kann eine Verbindung zu einem externen Server hergestellt werden
     *  Das Objekt der Klasse SSH heißt $ssh und ist aus jeder include Datei erreichbar
     */

    $ssh->openConnection();                 //SSH Verbindung öffnen
    echo $ssh->execute("ls -la");           //Befehl ausführen + Ausgabe
    echo $ssh->execute("ls -la", 1);        //Befehl ausführen + Ausgabe mit HTML Formatierung (<br>)
    $array = $ssh->execute("ls -la", 2)     //Befehl ausführen + Ausgabe als Array (Zeilenweise)
?>
