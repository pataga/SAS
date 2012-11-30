<?php
/**
 * MySQL Klassen Test 
 */

require_once 'includes/classes/class.mysql.php';
$mysql = new MySQL('127.0.0.1', '3306', 'root', 'toor');
$mysql->selectDB('sas');


$res = $mysql->Query("SELECT * FROM sas_users");

while ($row = $res->fetchArray())
{
	echo $row['username']."<br>";
}

?>