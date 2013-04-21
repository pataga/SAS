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

$log1 = $server->execute('cat /var/log/syslog');
$log2 = $server->execute('cat /var/log/syslog.1');
$lcdate = $server->execute("ls -l | grep auth.log | awk '{print $6,$7,$8,$9}'");

$log1f = explode("\n", $log1);
$log2f = explode("\n", $log2);

function highlightLog($logline) {
	$logline =  explode("\n",(wordwrap($logline, 15,"\n",false)));
	if (isset($logline[0])) {$logline[0] = '<span style="color:#00008F; font-weight: bold;">'.$logline[0].'</span>';}
	if (isset($logline[1])) {$logline[1] = '<span style="color:#009D1A; font-weight: bold;">'.$logline[1].'</span>';}
	return implode(" ", $logline);
}
?>
<h3>System-Log</h3>
	<p>
		Auf einem System laufen, stets viele Dienste. Bei typischen Linuxinstallationen sind es schnell hunderte Prozesse, die im Hintergrund arbeiten. Die Dienste schreiben ihre Aktionen in die <code>syslog</code>.
	</p>
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