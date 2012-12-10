<?php
$ssh->openConnection();
$ramload = $ssh->execute("cat /proc/meminfo");        //für RAM-Info
$total = explode("\n", $ramload);
$totalram = str_replace("MemTotal:", " ", $total[0]);
$totalram_ = str_replace("kB", " ",$totalram);
$totalram__ = $totalram / 1024;					//Umrechnung in MB
$free = explode("\n", $ramload);
$freeram = str_replace("MemFree:", " ", $total[1]);
$freeram_ = str_replace("kB", " ",$freeram);
$freeram__ = $freeram / 1024;
$usedram = $totalram__ - $freeram__;
$swapload = $ssh->execute("free -m | grep Swap",2); 
$swapload_ = str_replace("Swap:", " ", $swapload[0]);
$swapload__ = str_replace("kB", " ",$totalram);
$swaploadend ="";
print_r($swapload);
?>
<h3>Arbeitsspeicher Informationen</h3>
<fieldset>
<div class="halbe-box">
<h4>RAM</h4>
<table>
	<tr>
		<td>Total:</td>
		<td><?php echo (int)$totalram__ ?> MB</td>
	</tr>
	<tr>
		<td>Frei:</td>
		<td><?php echo (int)$freeram__ ?> MB</td>
	</tr>
	<tr>
		<td>Belegt:</td>
		<td><?php echo (int)$usedram ?> MB</td>
	</tr>
</table>
</div>
<div class="halbe-box lastbox">
	<h4>Swap</h4>
	<table>
	<tr>
		<td>Total:</td>
		<td></td>
	</tr>
	<tr>8
		<td>Frei:</td>
		<td></td>
	</tr>
	<tr>
		<td>Belegt:</td>
		<td></td>
	</tr>
</table>
</div>
<div class="clearfix"></div>


<hr>
<div class="progress-bar green stripes">
    <span style="width: 10%"></span>
</div>
</fieldset>
