<?php
	class Loader
	{
		public $_page = "";
		public $_spage = "";
		private $content = "";

		function createDatabaseConnection ()
		{
			require_once("includes/config/config.mysql.php");
		}

		function loadTop ()
		{
			require_once("includes/content/main/top.inc.php");
		}

		function loadUserInterface ()
		{
			$this->content .= '	<div class="top">
						            <div class="logo">
						                <h1>Server <span>Admin</span> System</h1>
						            </div>
						            <div class="usermenu">
						                <img src="img/profile/0815.png" alt="Profilbild">
						                <h3>'.$_SESSION['username'].'</h3>
						                <a href="#">Meine Daten &auml;ndern</a>
						                <br>
						                <a href="?user=logout">Logout</a>
						            </div>
						        </div>';
		}

		function loadMainMenu ()
		{
			$this->content .= '<div id="wrapper"><div id="nav"><ul>';
			$result = mysql_query("SELECT * FROM sas_menu_main");
			while ($row = mysql_fetch_object($result))
			{
				$name = $row->name;
				$page = $row->page;

				$this->content .= "<li><a href='?p=$page'>$name</a></li>";
			}

			$this->content .= '</ul><br style="clear:left"></div>';
		}

		function loadSideMenu ()
		{
			$this->content .= '<div id="sidebar"><ul>';
			$page = mysql_real_escape_string($this->_page);
			$result = mysql_query("SELECT * FROM sas_menu_side WHERE page = '$page'");
			while ($row = mysql_fetch_object($result))
			{
				$name = $row->name;
				$page = $row->page;
				$spage = $row->spage;

				$this->content .= "<li><a href='?p=$page&s=$spage'>$name</a></li>";
			}

			$this->content .= '</ul></div>';
		}

		function getIncFile ()
		{
			if (!isset($_SESSION['server_id']))
				return 'includes/content/home/server.inc.php';
			$page = mysql_real_escape_string($this->_page);
			$spage = mysql_real_escape_string($this->_spage);

			$result = mysql_query("SELECT inc_path FROM sas_content WHERE page = '$page' AND spage = '$spage'");
			if (mysql_num_rows($result) > 0)
			{
				$row = mysql_fetch_object($result);
				return $row->inc_path;
			}
			else return 0;
		}

		function loadFooter ()
		{
			require_once("includes/content/main/footer.inc.php");
		}

		function loadContent ()
		{
			$this->loadTop();
			$this->loadUserInterface();
			$this->loadMainMenu();
			$this->content .= '<div id="main">';
			$this->loadSideMenu();
			$this->content .= '<div id="content">';
			print($this->content);
		}

		function loadLoginMask ()
		{
			header("Location: ./login/");
			die;
		}

		function reload ()
		{
			header ("Location:");
		}
	}
?>
