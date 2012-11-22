<?php
	require_once "includes/classes/class.ssh.php";

	$ssh = new SSH('localhost', '22', 'root', '');	//Host, Port, Username, Password
	echo $ssh->execute("ls -la");							//Befehl ausführen + Ausgabe
	echo $ssh->execute("ls -la",1);							//Befehl ausführen + Ausgabe mit HTML Formatierung (<br>)
?>