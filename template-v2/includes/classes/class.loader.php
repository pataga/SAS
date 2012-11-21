<?php
	class loader
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
						                <h3>Username</h3>
						                <a href="#">Meine Daten &auml;ndern</a>
						                <br>
						                <a href="#">Logout</a>
						            </div>
						        </div>';
		}

		function loadMainMenu ()
		{
			$this->content .= '<div id="wrapper"><div id="nav"><ul>';
			$result = mysql_query("SELECT * FROM sas_main_menu");
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
			$result = mysql_query("SELECT * FROM sas_side_nav WHERE page = '$this->_page'");
			while ($row = mysql_fetch_object($result))
			{
				$name = $row->name;
				$page = $row->page;
				$spage = $row->spage;

				$this->content .= "<li><a href='?p=$page&s=$spage'>$name</a></li>";
			}

			$this->content .= '</ul></div>';
		}

		function loadIncFile ()
		{
			$result = mysql_query("SELECT inc_path FROM sas_page_content WHERE page = '$this->_page' AND spage = '$this->_spage'");
			if (mysql_num_rows($result) > 0)
			{
				$row = mysql_fetch_object($result);
				$path = $row->inc_path;
				require_once($path);
			}
		}

		function loadFooter ()
		{
			require_once("includes/content/main/footer.inc.php");
		}

		function loadContent ()
		{
			$this->createDatabaseConnection();
			$this->loadTop();
			$this->loadUserInterface();
			$this->loadMainMenu();
			$this->content .= '<div id="main">';
			$this->loadSideMenu();
			$this->content .= '<div id="content">';
			print($this->content);
			$this->loadIncFile();
			$this->loadFooter();
		}
	}
?>
