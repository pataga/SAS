<?php
/**
 * Funktionssammlung
 *
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.1.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
 * @author Gabriel Wanzek
 * @version 0.2
 *
 */

/**
* Sucht nach dem übergebenen String in einem Wert eines eindimensionalem Arrays und gibt den Key zurück.
* Ähnlich "array_search()", jedoch benötigt diese als needle den vollständigen String, und nicht nur einen Teil.
* @param (array)    $array  | Array in dem gesucht werden soll
* @param (string)   $needle | Suchbegriff (Achtung: case sensitive!)
* @return (int)     Fund -> Key
* @return (NULL)    kein Fund
*/

function searchArrayValues ($array, $needle) {
    foreach ($array as $key => $value) {
        if(preg_match('/'.$needle.'/',$value)) {
            return $key;
        }
    }
}

/**
* Arbeitsspeicher - Informationen auslesen (Total, Belegt, Frei)
* @author Gabriel Wanzek
* @param string $input Ausgabe des Linux Befehls: "free | head -3 | tail -2"
* @param int $data Rückgabeinformation: 0 => MemTotal; 1 => MemUsed; 2 => MemFree
* @return double Wert in MB mit 2 Nachkommastellen
*/

function getMemoryData($input, $data) {
	$rms = ['Mem:', '-/+ buffers/cache:',"\n"];
	$memdata = array_values(array_filter(explode(" ", str_replace($rms, '', trim($input)))));
	if ($data == 0) {
		return round($memdata[0]/1024, 2);
	} elseif ($data == 1) {
		return round($memdata[5]/1024, 2);
	} elseif ($data == 2) {
		return round($memdata[6]/1024, 2);
	} else {
		return 0;
	}
}

/**
* Swap - Informationen auslesen (Total, Belegt, Frei)
* @author Gabriel Wanzek
* @param string $input Ausgabe des Linux Befehls: "free | grep Swap"
* @param int $data Rückgabeinformation: 0 => SwapTotal; 1 => SwapUsed; 2 => SwapFree
* @return string Wert in MB mit 2 Nachkommastellen
*/

function getSwapData($input, $data) {
	$swapdata = array_values(array_filter(explode(" ", str_replace('Swap:', '', trim($input))), 'strlen'));
	if ($data == 0) {
		return round($swapdata[0]/1024, 2);
	} elseif ($data == 1) {
		return round($swapdata[1]/1024, 2);
	} elseif ($data == 2) {
		return round($swapdata[2]/1024, 2);
	} else {
		return 0;
	}
}

/**
 * Gibt die installierte Version zurück
 * @return string Version
 */
function getVersion() {
	$verfile = "./data/version.txt";
	if (file_exists($verfile)) {
		return file_get_contents($verfile);
	}
}


/**
 * Gibt die aktuelle Version zurück die bei GitHub verfügbar ist
 * @return string Version oder False bei Fehler
 */
function getNewestVersion() {
   if (extension_loaded('openssl')) {
        if ($stream = @fopen('https://raw.github.com/pataga/SAS/master/data/version.txt', 'r')) {
            return stream_get_contents($stream);
        fclose($stream);
        }
        else
        	return false;
    }       
    else 
    	return false;
}

/**
 * Vergleicht installierte mit Repoversion
 * @return bool or string
 */
function checkVersion() {
	$vechk = getNewestVersion();
	if ($vechk) {
		if (preg_match('/'.getVersion().'/', $vechk)){
			return true;	//aktuell
		} else {
			return false; 	//nicht aktuell
		}
	} else {
		return "err";
	}
}
?>