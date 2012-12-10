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
