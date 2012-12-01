<?php
/**
 * MySQL Klassen Test 
 */
require_once 'includes/classes/class.table.php';
require_once 'includes/classes/class.mysql.php';

$mysql = new MySQL('127.0.0.1', '3306', 'root', '123');
$mysql->selectDB('sas2');


$res = $mysql->Query("SELECT * FROM sas_users");

while ($row = $res->fetchArray())
{
	echo $row['username']."<br>";
}

$table = $mysql->tableAction('sas_users');

$data = array(
'id' => '10',
'username' => 'test',
'password' => md5('geheim'),
'email' => 'test@test.de',
);

$table->insert($data);

?>
