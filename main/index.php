<?php 
    session_start();

    include 'config/config.mysql.php';   //MySQL Konfigurationsdatei
    include 'functions/func.load.php';   //Funktionen zum Laden des Inhalts
    include 'functions/func.misc.php';   //Sonstige Funktionen
    include 'functions/func.auth.php';   //Auth Management

    $page = isset($_GET['p']) ? $_GET['p'] : loadError();
    $spage = isset($_GET['s']) ? $_GET['s'] : "";

    grandAccess();                       //Zugriff verwehren wenn inaktiv

    loadTop();                           //Lade Top + Hauptnavigation
    loadSideNav($page);                  //Lade Seitennavigation
    loadTree($page, $spage);             //Lade Baumstruktur
    loadContent($page, $spage);          //Lade Inhalt
    loadFooter();                        //Lade Fusszeile
?>

