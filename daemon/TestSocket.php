<?php
/**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
* @author Patrick Farnkopf
*
*/

if(!($sock = socket_create(AF_INET, SOCK_STREAM, 0))) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    die("Socket konnte nicht erstellt werden: [$errorcode] $errormsg \n");
}
     
echo "Socket erstellt \n";

if(!socket_connect($sock , '127.0.0.1' , 8000)) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    die("Verbindungsfehler: [$errorcode] $errormsg \n");
}
     
echo "Verbindung aufgebaut \n";
$message = chr(1)."\r\n\r\n";
     
if( ! socket_send ( $sock , $message , strlen($message) , 0)) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    die("Daten konnten nicht gesendet werden!: [$errorcode] $errormsg \n");
}
     
echo "Nachricht erfolgreich &uuml;bermittelt <br><br>";
?>
