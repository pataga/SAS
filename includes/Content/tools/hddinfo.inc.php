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
$hdd_info_1 = $server->execute("hdparm -i /dev/sda");
$hdd_info_2 = $server->execute("lsblk");
$hdd_info_3 = $server->execute("fdisk -l");
$hdd_info_4 = $server->execute("df -hl");
$hdd_info_5 = $server->execute("cat /proc/filesystems");
?>

<h3>Festplatten-Info</h3>
<fieldset>
<h5>Festplatten &amp; Partitionierung</h5>
Befehl: <code class="fancy">hdparm -i /dev/sda</code>
<pre class="simple">
<?=$hdd_info_1?>
</pre>
<hr>
<h5>Verfügbare "Block-devices"</h5>
Befehl: <code class="fancy">lsblk</code>
<hr>
<pre class="simple">
<?=$hdd_info_2?>
</pre>
<hr>
<h5>Auflisten der Informationen zu MBR-Partitionen - alle oder ein angegebener Datenträger</h5>
Befehl: <code class="fancy">fdisk -l</code>
<hr>
<pre class="simple">
<?=$hdd_info_3?>
</pre>
<hr>
<h5>Verfügbarer Speicherplatz</h5>
Befehl: <code class="fancy">df -hl</code>
<hr>
<pre class="simple">
<?=$hdd_info_4?>
</pre>
<hr>
<h5>Verfügbare Dateisysteme</h5>
Dateiausgabe: <code class="fancy">/proc/filesystems</code>
<hr>
<pre class="simple">
<?=$hdd_info_5?>
</pre>
<div class="clearfix"></div>
<hr>
<b>Info:</b> Momentan nur einfache Ausgaben die noch verarbeitet werden müssen.
</fieldset>
