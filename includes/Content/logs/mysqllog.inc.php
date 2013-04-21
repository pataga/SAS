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

$mlog = "";

if (isset($_POST['access'])) {
	$mlog = $server->execute('cat /var/log/mysql.log');

} 

if (isset($_POST['error'])) {
	$mlog = $server->execute('cat /var/log/mysql.err');
}

$log1f = explode("\n", $mlog);

function highlightLog($logline) {
	$logline =  explode("\n",(wordwrap($logline, 30,"\n",false)));
	if (isset($logline[0])) {$logline[0] = '<span style="color:#00008F; font-weight: bold;">'.$logline[0].'</span>';}
	if (isset($logline[1])) {$logline[1] = '<span style="color:#9D2500; font-weight: bold;">'.$logline[1].'</span>';}
	return implode(" ", $logline);
}
?>
<h3>MySQL-Log</h3>
	<div class="halbe-box">
		<p>
			Probleme beim Starten, Ausführen oder Beenden von <code>mysqld</code> sowie hergestellte Clientverbindungen und ausgeführte Anweisungen werden in den Logdateien gespeichert.
		</p>
	</div>
	<div class="halbe-box lastbox">
		<fieldset>
			<legend>Logdatei auswählen</legend>
			<form action="?p=logs&s=mysqllog" method="post">
				<input type="submit" name="access" value="mysql.log" class="button black">
				&nbsp;&nbsp;
				<input type="submit" name="error" value="error.log" class="button pink">
			</form>
		</fieldset>
	</div>
<div class="clearfix"></div>

<ul id="logline" class="log">
	<?php
		foreach (array_reverse($log1f) as $value) {
			echo "<li>". highlightLog($value) ."</li>\n";
		}
	?>
</ul>