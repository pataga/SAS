<?php
	session_start();
	require_once("includes/classes/class.loader.php");
	require_once("includes/classes/class.user.php");
	require_once("includes/classes/class.server.php");

	$loader = new Loader();
	$user = new User();
	$server = new Server();

	$loader->createDatabaseConnection();

	if (isset($_POST['username']) && isset($_POST['password']))
	{
		$user->setUsername($_POST['username']);
		$user->setPassword($_POST['password']);
		$user->AuthChallenge();
		$loader->reload();
	}

	if (!$user->isLoggedIn())
		$loader->loadLoginMask();

	if ($user->isLoggedIn() && isset($_GET['user']) && $_GET['user'] == "logout")
	{
		$user->Logout();
		$loader->reload();
	}

	$loader->_page = isset($_GET['p']) ? $_GET['p'] : "home";
	$loader->_spage = isset($_GET['s']) ? $_GET['s'] : " ";

	$loader->loadContent();
?>
