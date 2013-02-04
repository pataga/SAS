
<?php
$log1 = $server->execute('cat /var/log/auth.log.1');
$log2 = $server->execute('cat /var/log/auth.log');

$log1f = explode("\n", $log1);
$log2f = explode("\n", $log2);
?>
<script>
    $(function() {
        $('#search').fastLiveFilter('#logline');
    });
</script>
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
			echo "<li>".$value."</li>";
		}

		foreach (array_reverse($log1f) as $value) {
			echo "<li>".$value."</li>";
		}


	?>
</ul>