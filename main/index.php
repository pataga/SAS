<?php
	session_start();
	require_once("includes/classes/class.loader.php");
	require_once("includes/classes/class.user.php");

	$loader = new Loader();
	$user = new User();

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

	$loader->_page = isset($_GET['p']) ? $_GET['p'] : "home";
	$loader->_spage = isset($_GET['s']) ? $_GET['s'] : " ";

	$loader->loadContent();
?>
