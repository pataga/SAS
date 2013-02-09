<?php

/**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
* @author Patrick Farnkopf
*
*/

//Starte Session
session_start();

require_once 'includes/Classes/Main/Autoload.class.php';

//Lade benötigte Klassen
function __autoload($name) {
    require_once \Classes\Main\AutoLoad::getFilePath($name);
}

function exceptionErrorHandler($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0,$errno, $errfile, $errline);
}

set_error_handler('exceptionErrorHandler');

function exception_handler($exception) {
    $_SESSION = [];
    session_destroy();
    echo $exception->getMessage();
    require_once 'includes/Content/error/error.inc.php';
    exit;
}

set_exception_handler('exception_handler');

if (isset($_GET['install'])) {
    if ($installer = new \Classes\Install()) {
        require_once $installer->getFile();
        exit;
    }
}

if (is_dir(\Classes\Install::DIRECTORY)) {
    if ($installer = new \Classes\Install()) {
        if (file_get_contents(\Classes\Install::MYSQL_CONFIG_FILE) == '') {
            header('Location: ?install=1');
            exit();
        }
    }
}

//Timer start
$startTime = microtime(true);

//Erstelle Instanz der Hauptklasse. Dieses Objekt beinhaltet Objekte der Hauptklassen
$main = new \Classes\Main();


//Initialisiere Hauptobjekte
$mysql = $main->MySQL();
$loader = $main->Loader();
$server = $main->Server();
$database = $main->Database();
$debug = $main->Debug();
$cache = $main->Cache();
$session = $main->Session();
$user = NULL;

//Remote Instance
$mysql_remote = null;

//Authentifizierung
if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = $session->authChallenge($_POST['username'],$_POST['password']);
    $loader->reload();
}


//Wenn ServerID gesetzt, dann ....
/*if ($session->isServerChosen()) {
    //... setze ServerID in Klasse
    $server->setID($session->getServerId());
    //... versuche eine Remote MySQL Verbindung aufzubauen
    $rmd = $server->getMySQLData();
    if ($rmd) {
        $mysql_remote = new \MySQL($rmd);
    }
}*/


//Wenn nicht angemeldet, dann LoginMaske
if (!$session->isAuthenticated()) {
    try {
        require_once 'includes/Content/main/login.inc.php';
        exit;
    } catch (\Exception $e) {
        $debug->error($e);
        exit;
    }
}


//Wenn Logout Link geklickt, dann abmelden
if ($session->isAuthenticated() && isset($_GET['user']) && $_GET['user'] == 'logout') {
    $session->Logout();
    $loader->reload();
}


//Wenn Server wechseln geklickt, dann Server Session zerstören
if ($session->isAuthenticated() && 
    isset($_GET['server']) && 
    $_GET['server'] == 'change' && 
    $session->isServerChosen() &&
    $session->isAuthenticated()) {
    $session->unselectServer();
    $loader->reload();
}


//Übergebe GET Variablen an Loader Klasse
$loader->_page = isset($_GET['p']) ? $_GET['p'] : 'home';
$loader->_spage = isset($_GET['s']) ? $_GET['s'] : null;

ob_start();

try {
    require_once $loader->getIncFile();
} catch (\Classes\Main\Exception $e) {
    $debug->error($e);
}

$content = ob_get_contents();
ob_end_clean();

$cache->buildCache($content);


//Überprüfe auf Fehler
if ($debug->hasError()) {
    require_once 'includes/Content/error/error.inc.php';
    exit;
}


print($cache->getCache());

//Timer stop
$endTime = microtime(true);

//Calc Time
\Classes\Main::printLoadTime($startTime, $endTime);
?>
