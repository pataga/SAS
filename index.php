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

function exception_handler($exception) {
    echo $exception->getCode();
    switch ($exception->getCode()) {
        case 0xFA:
            \Classes\Main::Session()->unselectServer();
            header('Location: index.php');
            break;
        default:
            $_SESSION = [];
            session_destroy();
            \Classes\Main\Debug::setErrorMessage($exception);
            require_once 'includes/Content/error/error.inc.php';
            exit;
    }
}

set_exception_handler('exception_handler');

\Classes\Singleton::setRootDir(__DIR__);

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

//Initialisierung der Objekte der Main Klasse
\Classes\Main::start();


//Initialisiere Hauptobjekte
$mysql = \Classes\Main::MySQL();
$loader = \Classes\Main::Loader();
$server = \Classes\Main::Server();
$debug = \Classes\Main::Debug();
$cache = \Classes\Main::Cache();
$session = \Classes\Main::Session();
$header = \Classes\Main::Header();
$user = NULL;

//Remote Instance
$mysql_remote = null;

//Init Scripts
\Classes\ScriptLoader::loadMySQLScripts();

//Authentifizierung
if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = $session->authChallenge($_POST['username'],$_POST['password']);
    if ($user)
        \Classes\Main::setUser($user);
    else
        echo $session->loginErrorMessage();        
    $loader->reload();
}


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

ob_start();

try {
    require_once $loader->getIncFile();
} catch (\Classes\Main\Exception $e) {
    $debug->error($e);
}

$content = ob_get_contents();
ob_end_clean();

$header->printHeaders();

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
echo '<p class="memory">Speicherverbrauch '.floor(memory_get_usage()/1024).'KiB</p>';

?>
