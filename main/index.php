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

session_start();

require_once 'includes/config/config.mysql.php';

function __autoload($name) {
    require_once 'includes/classes/class.'.strtolower($name).'.php';
}

$main = new Main($data);

if (is_dir('install') && !isset($data)) {
    header('Location: install');
    die();
}

$mysql = $main->getMySQLInstance();
$loader = $main->getLoaderInstance();
$user = $main->getUserInstance();
$server = $main->getServerInstance();
$database = $main->getDatabaseInstance();
$ssh = $main->getSSHInstance();

//Remote Instance
$mysql_remote = null;

if (isset($_POST['username']) && isset($_POST['password'])) {
    $user->setUsername($_POST['username']);
    $user->setPassword($_POST['password']);
    $user->AuthChallenge();
    $loader->reload();
}

if (!$user->isLoggedIn())
    $loader->loadLoginMask();

if ($user->isLoggedIn() && isset($_GET['user']) && $_GET['user'] == 'logout') {
    $user->Logout();
    $loader->reload();
}

if ($user->isLoggedIn() && isset($_GET['server']) && $_GET['server'] == 'change' && isset($_SESSION['server_id'])) {
    unset($_SESSION['server_id']);
    $loader->reload();
}



$loader->_page = isset($_GET['p']) ? $_GET['p'] : 'home';
$loader->_spage = isset($_GET['s']) ? $_GET['s'] : null;
$loader->loadContent();
$inc_file = $loader->getIncFile();

if (isset($_SESSION['server_id'])) {
    $remote_mysql_data = $server->getMySQLData();
    if (is_array($remote_mysql_data)) {
        $mysql_remote = new MySQL($remote_mysql_data[0],$remote_mysql_data[1],$remote_mysql_data[2],$remote_mysql_data[3]);
    }
}

require_once $inc_file;
$loader->loadFooter();
?>
