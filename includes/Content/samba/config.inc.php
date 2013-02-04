<?php 
if (!$server->isInstalled('samba')) {
    header('Location:?p=samba&s=install');
    exit;
}
?>
<h3>Konfiguration</h3>
<fieldset>
	<p><b>Modulname: </b>config</p>
	<p><b>Modulbeschreibung: </b><br></p>
	<p><b>Programmierer(in):</b> Tanja</p>
	<p><b>Status:</b> Kein Status vorhanden</p>
</fieldset>

