<!--
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt
* @author Tanja Weiser
*
-->
<br>
<form action="index.php?p=samba&s=control" method="POST">
<fieldset>
<legend>Samba Steuerung</legend>
Der unten aufgeführte Text stammt aus der Konfigurationsdatei des Samba Dienstes.<br>
Hier können Sie allgemeine Einstellungen vornehmen.
Beispielsweise können Sie globale Einstellungen, wie den Namen der Arbeitsgruppe abändern.
Wenn Sie keine Erfahrungen mit dem Samba Dienst haben sollten Sie sich vor einer Änderung dieser Textdatei über die verschiedenen Möglichkeiten informieren. 
</fieldset>
<textarea name="samba_config" id="console">


<?php

$datei = file("/etc/samba/smb.conf");
foreach($datei AS $meine_datei){
	echo $meine_datei;
}




?>


</textarea>
<div class="clearfix"></div>
<br><br>
<input type="submit" class="button green" name="change" value="speichern"><br><br><br>
    <fieldset>
        <legend>Informationen</legend>
        <a href="http://wiki.ubuntuusers.de/Samba_Server/smb.conf" target="_blank">Hier</a> finden Sie Informationen zu sämtlichen Konfigurationsmöglichkeiten.
    </fieldset>
</form>
