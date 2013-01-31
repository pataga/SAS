<?php
?>
<h3>Dev: Status der Module</h3>
<h4>Home:</h4>
<ul class="square">
	<li><b>Übersicht:</b> Fast fertig</li>
	<li><b>Quickpanel:</b> Fertig</li>
	<li><b>Über SAS:</b> Fertig, wird ggf. erweitert</li>
	<li><b>SAS-Doku:</b> Fertig, wird ggf. erweitert</li>
	<li><b>SAS-Repo:</b> Fertig, wird ggf. erweitert</li>
</ul>
<h4>Apache:</h4>
<ul class="square">
	<li><b>Übersicht:</b> Soweit fertig</li>
	<li><b>Konfiguration:</b> Template fertig</li>
	<li><b>Steuerung:</b> Soweit fertig</li>
	<li><b>Virtuelle Hosts:</b> Planung</li>
	<li><b>Module:</b> Fast fertig, keine Fehlerbehandlung vorhanden</li>
	<li><b>PHP:</b> Planung</li>
	<li><b>PHP-Information:</b> Soweit fertig</li>
	<li><b>Statistiken:</b> Planung</li>
</ul>

<?php
$filename = __FILE__;

try {
 	if (file_exists($filename)) {
    echo "<i>Stand: ".date("d.m.Y H:i:s", filemtime($filename)).", kann durch die Versionsverwaltung verfälscht werden</i>";
	}
} catch (Exception $e) {
	echo "<i>Stand: konnte nicht ermittelt werden.</i>"; 	
}
?>