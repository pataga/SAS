<?php
	if(!($sock = socket_create(AF_INET, SOCK_STREAM, 0)))
	{
	    $errorcode = socket_last_error();
	    $errormsg = socket_strerror($errorcode);
	     
	    die("Socket konnte nicht erstellt werden: [$errorcode] $errormsg \n");
	}
	 
	echo "Socket erstellt \n";

	if(!socket_connect($sock , '127.0.0.1' , 9100))
	{
	    $errorcode = socket_last_error();
	    $errormsg = socket_strerror($errorcode);
	     
	    die("Verbindungsfehler: [$errorcode] $errormsg \n");
	}
	 
	echo "Verbindung aufgebaut \n";
	if (isset($_GET['command']))
		$message = $_GET['command']."\r\n\r\n";
	 
	if( ! socket_send ( $sock , $message , strlen($message) , 0))
	{
	    $errorcode = socket_last_error();
	    $errormsg = socket_strerror($errorcode);
	     
	    die("Daten konnten nicht gesendet werden!: [$errorcode] $errormsg \n");
	}
	 
	echo "Nachricht erfolgreich &uuml;bermittelt <br><br>";
	$input = socket_read($sock, 1024000);
	echo $input;
?>
