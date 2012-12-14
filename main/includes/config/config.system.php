<?php

/****************************
 * SAS System Konfiguration *
 ****************************/



/**************************************************************
 * Das Debuglevel gibt die Fehlerempfindlichkeit von SAS an
 * 
 * DebugLevel = 0 (Kein Debugging)
 * DebugLevel = 1 (Fehler werden in eine Logdatei geschrieben)
 * DebugLevel = 2 (Fehler werden in eine Logdatei geschrieben - Ladeabbruch bei Fatal Errors)
 *
 * Default: 2
 **************************************************************/
$debugLevel = 2;



/**************************************************************
 * Mit LogFile kann bestimmt werden, in welcher Datei die Fehler gespeichert werden sollen
 * 
 * Default: './error.log'
 **************************************************************/
$logFile = './error.log';

?>
