<?php

session_start();

require_once 'includes/config/config.mysql.php';
require_once 'includes/classes/class.loader.php';
require_once 'includes/classes/class.user.php';
require_once 'includes/classes/class.server.php';
require_once 'includes/classes/class.ssh.php';
require_once 'includes/classes/class.db.php';
require_once 'includes/classes/class.mysql.php';

if (is_dir('install') && !isset($data)) {
    header('Location: install');
    die();
}

$mysql = new MySQL($data[0], $data[1], $data[2], $data[3]);
$mysql->selectDB($data[4]);
$loader = new Loader($mysql);
$user = new User($mysql);
$server = new Server($mysql);
$database = new Database($mysql, $server);

$ssh = null;

$data = array();

//Remote Instances
$mysql_remote = null;
$database_remote = null;


if (isset($_SESSION['server_id'])) {
    $data = $server->getServerData($_SESSION['server_id']);
    $ssh = new SSH($data[0], '22', $data[1], $data[2]);
}

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
        $mysql_remote = new MySQL($remote_mysql_data[0], $remote_mysql_data[1], $remote_mysql_data[2], $remote_mysql_data[3]);
        $database_remote = new Database($mysql_remote, $server);
    }
    
}

require_once $inc_file;
$loader->loadFooter();
?>
