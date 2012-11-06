<?php 
    session_start();

    include 'config/config.mysql.php';   //MySQL Konfigurationsdatei
    include 'functions/func.load.php';   //Funktionen zum Laden des Inhalts
    include 'functions/func.misc.php';   //Sonstige Funktionen
    include 'functions/func.auth.php';   //Auth Management

    grandAccess();                       //Zugriff verwehren wenn inaktiv
    $get = GET();

    if ($get == "error")
        loadError();                    //Lade Fehlerseite => Todo: Erstelle Fehlerseite

    loadTop();                          //Lade Top + Hauptnavigation
    loadSideNav($get, $_GET[$get]);     //Lade Seitennavigation
    loadTree($get, $_GET[$get]);        //Lade Baumstruktur
    loadContent($get, $_GET[$get]);     //Lade Inhalt
    loadFooter();                       //Lade Fusszeile
?>

