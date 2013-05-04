<?php
/**
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.0.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
 * @author Tanja Weiser
 *
 */

$log1 = $server->execute('cat /var/log/proftpd/proftpd.log',2);
$log2 = $server->execute('cat /var/log/proftpd/xferlog',2);

function highlightAuthlog($logline) {
	$logline =  explode("\n",(wordwrap($logline, 15,"\n",false)));
	if (isset($logline[0])) {$logline[0] = '<span style="color:#00008F; font-weight: bold;">'.$logline[0].'</span>';}
	if (isset($logline[1])) {$logline[1] = '<span style="color:#009D1A; font-weight: bold;">'.$logline[1].'</span>';}
	return implode(" ", $logline);
}

?>

<br><br>
	<fieldset>
		<legend>proftpd.log</legend>
			<div class="scrolly" style="width:760px;">
				<ul id="logline" class="log">
					<?php
						foreach ($log1 as $key => $value) {
							echo '<li style="overflow:hidden">'.highlightAuthlog($value).'</li>';

						}
					?>
				</ul>
			</div>
      		<br>
	</fieldset>
	
	<fieldset>
		<legend>proftpd.log</legend>
			<div class="scrolly" style="width:760px;">
				<ul id="logline" class="log">
					<?php
						foreach ($log2 as $key => $value) {
							echo '<li style="overflow:hidden">'.highlightAuthlog($value).'</li>';

						}
					?>
				</ul>
			</div>
      		<br>
	</fieldset>
	
	<fieldset>
        <legend>Informationen</legend>
        Informationen zu <a href="http://www.castaglia.org/proftpd/doc/xferlog.html" target="_blank">xferlog</a>
    </fieldset>