<?php
/**
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.0.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
 * @author Gabriel Wanzek
 *
 */

$alog1 = "";
$alog2 = "";

if (isset($_POST['access'])) {
	$alog1 = $server->execute('cat /var/log/apache2/access.log');
	$alog2 = $server->execute('cat /var/log/apache2/access.log.1');
} 

if (isset($_POST['error'])) {
	$alog1 = $server->execute('cat /var/log/apache2/error.log');
	$alog2 = $server->execute('cat /var/log/apache2/error.log.1');
}

$log1f = explode("\n", $alog1);
$log2f = explode("\n", $alog2);

function highlightLog($logline) {
	$logline =  explode("\n",(wordwrap($logline, 30,"\n",false)));
	if (isset($logline[0])) {$logline[0] = '<span style="color:#00008F; font-weight: bold;">'.$logline[0].'</span>';}
	if (isset($logline[1])) {$logline[1] = '<span style="color:#9D2500; font-weight: bold;">'.$logline[1].'</span>';}
	return implode(" ", $logline);
}
?>
<h3>Apache-Log</h3>
	<div class="halbe-box">
		<p>
			Alle Zugriffe über http/https werden selbstverständlich mitgeloggt. Apache2 schreibt einen <code>access.log</code> und einen <code>error.log</code>. Wählen Sie die Logdatei aus, um diese auzugeben.
		</p>
	</div>
	<div class="halbe-box lastbox">
		<fieldset>
			<legend>Logdatei auswählen</legend>
			<form action="?p=logs&s=apachelog" method="post">
				<input type="submit" name="access" value="access.log" class="button black">
				&nbsp;&nbsp;
				<input type="submit" name="error" value="error.log" class="button grey">
			</form>
		</fieldset>
	</div>
<div class="clearfix"></div>

<ul id="logline" class="log">
	<?php
		foreach (array_reverse($log1f) as $value) {
			echo "<li>". highlightLog($value) ."</li>\n";
		}

		foreach (array_reverse($log2f) as $value) {
			echo "<li>". highlightLog($value)  ."</li>\n";
		}


	?>
</ul>