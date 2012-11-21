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
			$id = $row->id;
			
			if ($id == "10"){
				echo '<li class="last"><a href="'.$link.'" '.isSelected("p", $row->page).'>'.$name.'</a></li>';
			}
			
			else {
				echo '<li><a href="'.$link.'" '.isSelected("p", $row->page).'>'.$name.'</a></li>';
			}
		}
	}

	function loadSideNav($p, $s)
	{
		$result = mysql_query("SELECT * FROM sas_side_nav WHERE page='$p'") or die (mysql_error());

		echo '<ul class="sideNav">';

		while ($row = mysql_fetch_object($result))
		{
			$link = "index.php?p=".$row->page."&s=".$row->spage;
			$name = $row->name;
			echo '<li><a href="'.$link.'" '.isSelected("s", $row->spage).'>'.$name.'</a></li>';
		}

        echo '</ul></div> ';
	}

	function loadTree($p)
	{
		$result = mysql_query("SELECT * FROM sas_side_nav WHERE page='$p'") or die (mysql_error());

		while ($row = mysql_fetch_object($result))
		{
			if (isset($_GET[$row->spage]))
			{
				echo '<h2><a href="index.php?page=overview">'.$row->page.'</a> &raquo; <a href="index.php?page=home" class="active">'.$row->spage.'</a></h2>';
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
		header("Location: index.php?p=home");
	}
	
?>
