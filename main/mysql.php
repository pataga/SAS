<?php
/**
 * MySQL Klassen Test 
 */

require_once 'includes/classes/class.mysql2.php';
$mysql = new MySQL('127.0.0.1', '3306', 'root', '');
$mysql->selectDB('sas');

$data = array (
    'id' => '5',
    'username' => 'test',
    'password' => 'test2',
    'email'    => 'test3'
);

$mysql->insert('sas_users', $data);

$result = $mysql->Query('SELECT * FROM sas_users');

while ($row = $result->fetchObject()) {
    echo $row->username;
}

?>