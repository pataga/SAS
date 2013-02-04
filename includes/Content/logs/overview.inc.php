<?php 
$out = $server->execute('stat -c "*%n|%y#" /var/log/*');
$filter = ['*','|','#'];
$rep = ['<tr><td>','</td><td>','</tr>'];
$put = str_replace($filter, $rep, $out);
?>
<h3>System-Logs</h3>
<fieldset>
	<p><b>Modulname: </b>overview</p>
	<p><b>Modulbeschreibung: </b>Alle verfügbaren Logs in einer Übersicht</p>
	<p><b>Programmierer(in):</b> Gabriel</p>
	<p><b>Status:</b> Kein Status vorhanden</p>
</fieldset>

<fieldset>
	<legend>Verfügbare Logs</legend>
	<table>
		<tr>
			<th>Datei</th>
			<th>Letzte Änderung</th>
		</tr>
		<?=$put ?>
	</table>
</fieldset>


