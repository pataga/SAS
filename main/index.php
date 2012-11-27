<?php
	session_start();

	if (is_dir('install'))
	{
		header('Location: install');
		die();
	}

	require_once 'includes/config/config.mysql.php';
	require_once 'includes/classes/class.loader.php';
	require_once 'includes/classes/class.user.php';
	require_once 'includes/classes/class.server.php';
	require_once 'includes/classes/class.ssh.php';
	require_once 'includes/classes/class.db.php';
	require_once 'includes/classes/class.mysql.php';

	$loader = new Loader();
	$user = new User();
	$mysql = new MySQL($data);
	$server = new Server($mysql);
	$database = new Database($mysql, $server);
	$ssh = null;

	$data = array();


	if (isset($_SESSION['server_id']))
	{
		$data = $server->getServerData($_SESSION['server_id']);
		$mysql->setServerID($server->getID());
		$ssh = new SSH($data[0],'22',$data[1],$data[2]);
	}

	if (isset($_POST['username']) && isset($_POST['password']))
	{
		$user->setUsername($_POST['username']);
		$user->setPassword($_POST['password']);
		$user->AuthChallenge();
		$loader->reload();
	}

	if (!$user->isLoggedIn())
		$loader->loadLoginMask();

	if ($user->isLoggedIn() && isset($_GET['user']) && $_GET['user'] == 'logout')
	{
		$user->Logout();
		$loader->reload();
	}

	if ($user->isLoggedIn() && isset($_GET['server']) && $_GET['server'] == 'change' && isset($_SESSION['server_id']))
	{
		unset($_SESSION['server_id']);
		$loader->reload();
	}

	$loader->_page = isset($_GET['p']) ? $_GET['p'] : 'home';
	$loader->_spage = isset($_GET['s']) ? $_GET['s'] : null;

	$loader->loadContent();
	require_once $loader->getIncFile();
	$loader->loadFooter();
?>
