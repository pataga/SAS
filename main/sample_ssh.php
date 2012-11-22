<?php
	require_once "includes/classes/class.ssh.php";

	$ssh = new SSH('localhost', '22', 'root', ''); //Host, Port, Username, Password
	$ssh->authenticate();						   //Einloggen
	echo $ssh->execute("ls /var/www");			   //Befehl ausführen | Rückgabewert = STRING
?>
