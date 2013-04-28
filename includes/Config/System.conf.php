<?php
namespace Config;

interface System {
    /****************************
     * SAS System Konfiguration *
     ****************************/



    /**************************************************************
     * Das SYSTEM_DEBUG_LEVEL gibt die Fehlerempfindlichkeit von SAS an
     * 
     * SYSTEM_DEBUG_LEVEL = 0 (Kein Debugging)
     * SYSTEM_DEBUG_LEVEL = 1 (Fehler werden in eine Logdatei geschrieben)
     * SYSTEM_DEBUG_LEVEL = 2 (Fehler werden in eine Logdatei geschrieben - Ladeabbruch bei Fatal Errors)
     *
     * Default: 2
     **************************************************************/
    const SYSTEM_DEBUG_LEVEL = 1;



    /**************************************************************
     * Mit SYSTEM_LOG_FILE kann bestimmt werden, in welcher Datei die Fehler gespeichert werden sollen
     * 
     * Default: './error.log'
     **************************************************************/
    const SYSTEM_LOG_FILE = './error.log';
}

?>
