<?php
/**
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.0.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt
 * @author Gabriel Wanzek
 *
 */

$log1 = $server->execute('cat /var/log/auth.log.1');
$log2 = $server->execute('cat /var/log/auth.log');
$lcdate = $server->execute("ls -l | grep auth.log | awk '{print $6,$7,$8,$9}'");

$log1f = explode("\n", $log1);
$log2f = explode("\n", $log2);

function highlightAuthlog($logline) {
	$logline =  explode("\n",(wordwrap($logline, 15,"\n",false)));
	if (isset($logline[0])) {$logline[0] = '<span style="color:#00008F; font-weight: bold;">'.$logline[0].'</span>';}
	if (isset($logline[1])) {$logline[1] = '<span style="color:#009D1A; font-weight: bold;">'.$logline[1].'</span>';}
	return implode(" ", $logline);
}



?>
<h3>auth.log</h3>
	<p><b>auth.log</b> protokolliert alle Anmeldeversuche am System mit. Zugriffe über ssh, su und sudo werden ebenfalls protokolliert.<br>Beim Herunterfahren des Systems wird diese Datei automatisch geleert.<br><b>Tipp:</b> Nutzen Sie die Suchfunktionen ihres Browsers, um bestimmte Ereignisse schneller zu finden<br><br>
	<b>Wichtige Schlüsselbegriffe:</b><br> failed for, login, ssh, root, su, sudo, from, invalid, by</p>
<div class="clearfix"></div>
<ul id="logline" class="log">
	<?php
		foreach (array_reverse($log2f) as $value) {
			echo "<li>". highlightAuthlog($value) ."</li>\n";
		}

		foreach (array_reverse($log1f) as $value) {
			echo "<li>". highlightAuthlog($value)  ."</li>\n";
		}


	?>
</ul>