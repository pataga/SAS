<?php
	
	function isSelected($get, $name)
	{
		return isset($_GET[$get])&&$_GET[$get]=="$name"?"class='active'":"";
	}

	function loadMenu()
	{
		$result = mysql_query("SELECT * FROM sas_main_menu");

		while ($row = mysql_fetch_object($result))
		{
			$link = "index.php?p=".$row->page;
			$name = $row->name;

			echo '<li><a href="'.$link.'" '.isSelected($row->get, $row->page).'>'.$name.'</a></li>';
		}
	}

	function loadSideNav($p, $s)
	{
		$result = mysql_query("SELECT * FROM sas_side_nav WHERE getValue='$p'") or die (mysql_error());

		echo '<ul class="sideNav">';

		while ($row = mysql_fetch_object($result))
		{
			$link = "index.php?p=".$row->getValue."&s=".$row->sub_getValue;
			$name = $row->name;
			echo '<li><a href="'.$link.'" '.isSelected($row->sub_get, $row->sub_getValue).'>'.$name.'</a></li>';
		}

        echo '</ul></div> ';
	}

	function loadTree($get, $getValue)
	{
		$result = mysql_query("SELECT * FROM sas_side_nav WHERE get='$get' AND getValue='$getValue'") or die (mysql_error());

		while ($row = mysql_fetch_object($result))
		{
			if (isset($_GET[$row->sub_get]))
			{
				echo '<h2><a href="index.php?page=overview">'.$row->get.'</a> &raquo; <a href="index.php?page=home" class="active">'.$row->sub_get.'</a></h2>';
				break;
			}
		}
	}

	function loadContent($p, $s)
	{
		$result = mysql_query("SELECT * FROM sas_page_content WHERE page='$p' AND spage='$s'") or die (mysql_error());

		echo '<div id="main">';

		while ($row = mysql_fetch_object($result))
		{
			require $row->inc_path;
		}

		echo '</div>';
	}

	function loadFooter()
	{
		include 'inc/html/footer.inc.php';
	}

	function loadTop()
	{
		include 'inc/html/top.inc.php';
	}

	function loadError()
	{
		return;
	}
	
?>
