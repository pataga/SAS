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

$log1 = $server->execute('cat /var/log/boot.log');
$log2 = $server->execute('cat /var/log/dmesg');
$log1f = explode("\n", $log1);
$log2f = explode("\n", $log2);
?>
<h3>Bootmeldungen</h3>
	<p>
		Alle Meldungen die beim letzten Booten ausgegeben werden mitgeloggt.
		<br>
		Spinge zu: <a href="#dmesg">dmesg</a> | <a href="#boot">boot.log</a>
	</p>
<div class="clearfix"></div>
<ul id="logline" class="log">
	<fieldset style="color:#000;" id="dmesg">
		<legend>dmesg</legend>
			<?php
		foreach ($log2f as $value) {
			echo "<li>". $value ."</li>\n";
		}
	?>
	</fieldset>
	<li class="clearfix"></li>
	<fieldset style="color:#000;" id="boot">
		<legend>boot.log</legend>
			<?php
		foreach ($log1f as $value) {
			echo "<li>". str_replace(['[164G', '[170G',''], '', $value) ."</li>\n";
		}
	?>
	</fieldset>
</ul>