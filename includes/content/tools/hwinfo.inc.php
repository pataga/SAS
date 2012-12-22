<?php
/**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt
* @author Gabriel Wanzek
*
*/
?>
<?php 
$ssh->openConnection();
$hw_info_hw = $ssh->execute("lspci");
$hw_info_lw = $ssh->execute("lsblk");
$hw_info_sp = $ssh->execute("df -h");
?>

<h3>HW-Info</h3>
<fieldset>
	<legend>Vorhandene Hardware<sup>Beta</sup></legend>
<pre>
<?=$hw_info_hw?>
</pre>
<div class="clearfix"> <p>&nbsp;</p> </div>
<pre>
<?=$hw_info_lw?>
</pre>
<div class="clearfix"> <p>&nbsp;</p> </div>
<pre>
<?=$hw_info_sp?>
</pre>
<div class="clearfix"></div>
<hr>
<b>Info:</b> Momentan nur einfache Ausgaben die noch verarbeitet werden müssen.
</fieldset>
