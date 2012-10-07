<?php
$mysql_host = "localhost";
$mysql_user = "root";
$mysql_pass = "";
$mysql_data = "sas";

mysql_connect($mysql_host, $mysql_user, $mysql_pass) or die (mysql_error());
mysql_select_db($mysql_data) or die (mysql_error());

?>
