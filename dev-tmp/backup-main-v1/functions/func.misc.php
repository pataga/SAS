<?php
	function GET()
	{
		$result = mysql_query("SELECT get FROM sas_main_menu");

		while ($row = mysql_fetch_object($result))
		{
			if (isset($_GET[$row->get]))
				return $row->get;
		}

		return "error";
	}
?>
