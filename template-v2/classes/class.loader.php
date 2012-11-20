<?php
	class loader
	{
		public $_page = "";
		public $_spage = "";
		private $content = "";

		function createDatabaseConnection ()
		{
			require_once("config/config.mysql.php");
		}

		function loadTop ()
		{
			require_once("inc/main/top.inc.php");
		}

		function loadMainMenu ()
		{
			$content .= '<div id="wrapper"><div id="nav"><ul>';
			$result = mysql_query("SELECT * FROM sas_main_menu");
			while ($row = mysql_fetch_object($result))
			{
				$name = $row->name;
				$page = $row->page;

				$content .= "<li><a href='?p=$page'>$name</a></li>";
			}

			$content .= '</ul><br style="clear:left"></div>';
		}

		function loadSideMenu ()
		{
			$content .= '<div id="sidebar"><ul>';
			$result = mysql_query("SELECT * FROM sas_side_nav");
			while ($row = mysql_fetch_object($result))
			{
				$name = $row->name;
				$page = $row->page;
				$spage = $row->spage;

				$content .= "<li><a href='?p=$page&s=$spage'>$name</a></li>";
			}

			$content .= '</ul></div>';
		}

		function loadIncFile ()
		{
			$result = mysql_query("SELECT inc_path FROM sas_page_content WHERE page = '$_page' AND spage = '$_spage'");
			if (mysql_num_rows($result) > 0)
			{
				$row = mysql_fetch_object($result);
				$path = $row->inc_path;
				require_once($path);
			}
		}

		function loadFooter ()
		{
			require_once("inc/main/footer.inc.php");
		}

		function loadContent ()
		{
			$this->createDatabaseConnection();
			$this->loadTop();
			$this->loadMainMenu();
			$content .= '<div id="main">';
			$this->loadSideMenu();
			$content .= '</div>';
			$this->loadIncFile();
			$this->loadFooter();
		}
	}
?>
