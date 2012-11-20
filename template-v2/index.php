<?php
	require_once("classes/class.loader.php");

	$loader = new loader();
	$loader->$_page = isset($_GET['p']) ? $_GET['p'] : "";
	$loader->$_spage = isset($_GET['s']) ? $_GET['s'] : "";

	$loader->loadContent();
?>
