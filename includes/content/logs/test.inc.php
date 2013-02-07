<?php
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
<script>
    $(function() {
        $('#search').fastLiveFilter('#logline');
    });
</script>
<style type="text/css">
	span.datetime {
		color: #0100EB;
		font-weight: bold;
	}
</style>
<h3>auth.log</h3>
<div class="halbe-box">
<fieldset>
	<legend>Filter</legend>
	<form method="get" action="index.php?p=logs">
		<p>Geben Sie Schlüsselbegriffe<br>(z.B.: Benutzername, Zeit, Befehl) ein: </p>
		<input type="text" name="" id="search" placeholder="Suchbegriff..." class="text-medlong"> 
		<a href="#" class="tooltip">Info<span>mehrere Begriffe werden automatisch durch Leerzeichen getrennt</span></a>
	</form>
</fieldset>
</div>
<div class="halbe-box lastbox">
	<p><b>auth.log</b> protokolliert alle Anmeldeversuche am System mit. Zugriffe über ssh, su und sudo werden ebenfalls protokolliert.<br>Beim Herunterfahren des Systems wird diese Datei automatisch geleert.<br><br>
	<b>Wichtige Schlüsselbegriffe:</b><br> failed for, login, ssh, root, su, sudo, from, invalid, by</p>
</div>
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