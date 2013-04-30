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

?>
<h3>SAS Plugins</h3>
<a href="?p=plugins&s=cssinfo"><div class="viertel-box boxitem"><p>CSS-Info</p></div></a>


<?

$result = $mysql->tableAction('sas_plugins')->select();

for ($i = 1; $row = $result->fetch(); $i++) {
	if ($i == 3) {
		echo '<a href="?p=plugins&s=show&id='.$row->id.'"><div class="viertel-box boxitem lastbox"><p><i>'.$row->name.'</i></p></div></a><div class="clearfix"></div>';
		$i = -1;
	} else {
		echo '<a href="?p=plugins&s=show&id='.$row->id.'"><div class="viertel-box boxitem"><p><i>'.$row->name.'</i></p></div></a>';
	}
}

?>
<div class="clearfix"></div>
<!--<a href="#LEER"><div class="viertel-box boxitem"><p><i>leer</i></p></div></a>
<a href="#LEER"><div class="viertel-box boxitem"><p><i>leer</i></p></div></a>
<a href="#LEER"><div class="viertel-box boxitem"><p><i>leer</i></p></div></a>
<a href="#LEER"><div class="viertel-box boxitem lastbox"><p><i>leer</i></p></div></a>
<div class="clearfix"></div>-->
<fieldset>
	<select>
		<option selected>Ideen für Plugins</option>
			<optgroup label="Vorschläge">
			<option>Minecraft Install &amp; Control Plugin</option>
			<option>lighttpd Plugin</option>
			<option>vsftpd <i>oder</i> DrFTPD Plugin</option>
			<option>CUPS Plugin</option>
			<option>Ampache Plugin</option>
			<option>PostgreSQL Plugin</option>
			<option>CMS Verwaltungs und Installationspugin</option>
			<option>DHCP-Server-Plugin</option>
		</optgroup>
	</select>
</fieldset>
