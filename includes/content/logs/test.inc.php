
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
<p>auth.log protokolliert alle Anmeldeversuche am System mit. Zugriffe über ssh, su und sudo werden ebenfalls protokolliert.</p>
<fieldset>
	<legend>Filter</legend>
	<form method="get" action="index.php?p=logs">
		<p>Geben Sie Schlüsselbegriffe (bspw. Benutzername, Zeit oder Befehl) ein:</p>
		<input type="text" name="" id="search" class="text-long">
	</form>
</fieldset>


<ul id="logline" class="log">
	<?php
		foreach ($log1f as $value) {
			echo "<li>".$value."</li>";
		}

		foreach ($log2f as $value) {
			echo "<li>".$value."</li>";
		}
	?>
</ul>