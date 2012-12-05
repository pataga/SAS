<?php

/**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt
*
*/

//Starte Session
session_start();


//Lade MySQL Konfigurationsdatei
require_once 'includes/config/config.mysql.php';


//Lade benötigte Klassen
function __autoload($name) {
    $path = "includes/classes/";
    if (file_exists($path.'class.'.strtolower($name).'.php')) {
        require_once $path.'class.'.strtolower($name).'.php';
    } elseif (file_exists($path.'module/mysql/class.'.strtolower($name).'.php')) {
        require_once $path.'module/mysql/class.'.strtolower($name).'.php';
    } elseif (file_exists($path.'module/tools/class.'.strtolower($name).'.php')) {
        require_once $path.'module/tools/class.'.strtolower($name).'.php';
    } else {
        throw new Exception("Es ist ein Fehler aufgetreten! Die Klasse $name konnte nicht geladen werden!");
    }
    
}


//Erstelle Instanz der Hauptklasse. Dieses Objekt beinhaltet Objekte der Hauptklassen
$main = new Main($data);


//Wenn install Verzeichnis exisitiert und die Konfig Daten nicht gesetzt sind dann Installationsroutine
if (is_dir('install') && !isset($data)) {
    header('Location: install');
    die();
}


//Initialisiere Hauptobjekte
$mysql = $main->getMySQLInstance();
$loader = $main->getLoaderInstance();
$user = $main->getUserInstance();
$server = $main->getServerInstance();
$database = $main->getDatabaseInstance();
$ssh = $main->getSSHInstance();

//Remote Instance
$mysql_remote = null;

//Authentifizierung
if (isset($_POST['username']) && isset($_POST['password'])) {
    $user->setUsername($_POST['username']);
    $user->setPassword($_POST['password']);
    $user->AuthChallenge();
    $loader->reload();
}


//Wenn ServerID gesetzt, dann ....
if (isset($_SESSION['server_id'])) {
    //... setze ServerID in Klasse
    $server->setID($_SESSION['server_id']);
    //... versuche eine Remote MySQL Verbindung aufzubauen
    $remote_mysql_data = $server->getMySQLData();
    if (is_array($remote_mysql_data)) {
        $mysql_remote = new MySQL($remote_mysql_data[0],$remote_mysql_data[1],$remote_mysql_data[2],$remote_mysql_data[3]);
    }
}


//Wenn nicht angemeldet, dann LoginMaske
if (!$user->isLoggedIn())
    $loader->loadLoginMask();


//Wenn Logout Link geklickt, dann abmelden
if ($user->isLoggedIn() && isset($_GET['user']) && $_GET['user'] == 'logout') {
    $user->Logout();
    $loader->reload();
}


//Wenn Server wechseln geklickt, dann Server Session zerstören
if ($user->isLoggedIn() && isset($_GET['server']) && $_GET['server'] == 'change' && isset($_SESSION['server_id'])) {
    unset($_SESSION['server_id']);
    $loader->reload();
}


//Übergebe GET Variablen an Loader Klasse
$loader->_page = isset($_GET['p']) ? $_GET['p'] : 'home';
$loader->_spage = isset($_GET['s']) ? $_GET['s'] : null;


//Lade Top Content
$loader->loadContent();

//Lade Seiteninhalt
require_once $loader->getIncFile();

//Lade Footer
$loader->loadFooter();
?>
