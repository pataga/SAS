<?php
    if (!$server->isInstalled('mysql'))
    {
        header('Location: ?p=mysql&s=configure');
        die();
    }
?>
<h3>MySQL</h3>
<fieldset>
	<p><b>Modulname: </b>overview</p>
	<p><b>Modulbeschreibung: </b><br></p>
	<p><b>Programmierer(in):</b> Patrick</p>
	<p><b>Status:</b> in Entwicklung</p>
</fieldset>

