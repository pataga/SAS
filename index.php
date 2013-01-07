<?php

/**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt
* @author Patrick Farnkopf
*
*/

//Starte Session
session_start();


function exceptionErrorHandler($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0,$errno, $errfile, $errline);
}

set_error_handler('exceptionErrorHandler');

require_once 'includes/classes/Main/Autoload.class.php';

//Lade benötigte Klassen
function __autoload($name) {
    require_once \Main\AutoLoad::getFilePath($name);
}

//Timer start
$startTime = microtime(true);

//Lade MySQL Konfigurationsdatei
require_once 'includes/config/config.mysql.php';
require_once 'includes/config/config.system.php';


//Wenn install Verzeichnis exisitiert und die Konfig Daten nicht gesetzt sind dann Installationsroutine
if (is_dir('install') && !isset($data)) {
    header('Location: install');
    die();
}


//Erstelle Instanz der Hauptklasse. Dieses Objekt beinhaltet Objekte der Hauptklassen
$main = new \Main\Main($data, $debugLevel, $logFile);


//Initialisiere Hauptobjekte
$mysql = $main->getMySQLInstance();
$loader = $main->getLoaderInstance();
$user = $main->getUserInstance();
$server = $main->getServerInstance();
$database = $main->getDatabaseInstance();
$ssh = $main->getSSHInstance();
$debug = $main->getDebugInstance();
$cache = $main->getCacheInstance();


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
        $mysql_remote = new \MySQL\MySQL($main,$remote_mysql_data[0],$remote_mysql_data[1],$remote_mysql_data[2],$remote_mysql_data[3]);
    }
}


//Wenn nicht angemeldet, dann LoginMaske
if (!$user->isLoggedIn()) {
    try {
        require_once 'includes/content/main/login.inc.php';
        exit();
    } catch (\Exception\MException $e) {
        $debug->error($e);
        exit;
    }
}


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

ob_start();

try {
    require_once $loader->getIncFile();
} catch (\Exception\Exception $e) {
    $debug->error($e);
}

$content = ob_get_contents();
ob_end_clean();

$cache->buildCache($content);


//Überprüfe auf Fehler
if ($debug->hasError()) {
    require_once 'includes/content/error/error.inc.php';
    exit;
}


print($cache->getCache());

//Timer stop
$endTime = microtime(true);

//Calc Time
\Main\Main::printLoadTime($startTime, $endTime);
?>
