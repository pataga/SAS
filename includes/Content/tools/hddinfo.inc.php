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
$fss = $server->execute("cat /proc/filesystems");
$lsblk = $server->execute("lsblk -ilo NAME,TYPE,SIZE,MOUNTPOINT");
$disks = $server->execute("fdisk -l | grep Disk | awk {'print $2, $3, $4'}");

$disksarr = explode("\n", str_replace(",", "", $disks));
foreach ($disksarr as $value) {
	$tmparr = explode(":", $value);
	if (isset($tmparr[0]) && isset($tmparr[1])) {
		$disk[$tmparr[0]] = $tmparr[1];
	}
}

if (isset($_POST['hdparm'])) {
	$hdparm = $server->execute("hdparm -i ".$_POST['cdisk']);
}

$lbexp = explode("\n", $lsblk);
foreach ($lbexp as $key => $value) {
	$trim = trim($value);
	$fnlexp = explode(" ", $trim);
	$lsblk_data[] = array_values(array_filter($fnlexp));
}
?>
<h3>Festplatten-Info</h3>
<fieldset>
	<legend>Festplatteninformationen</legend>
	<p>Wählen Sie eine Festplatte aus, um mehr Informationen über Sie herauszufinden.</p>
	<form action="?p=tools&s=hddinfo" method="post">
		<select name="cdisk">
				<?php foreach ($disk as $key => $value): ?>
				<option value="<?=$key?>"><?php echo $key." (".$value.")"; ?></option>
			<?php endforeach; ?>
		</select>
		<input type="submit" name="hdparm" value="Auswählen" class="button black">
	</form>
<?php echo (isset($hdparm)) ? "<pre class='simple'>".$hdparm."</pre>" : "";?>
</fieldset>
<div class="zweidrittel-box">
	<fieldset>
		<legend>Festplatten/Partitionen/Mountpoints</legend>
		<table>
			<tr>
				<th>Name</th>
				<th>Typ</th>
				<th>Größe</th>
				<th>Mount</th>
			</tr>
		<?php
		unset($lsblk_data[0]);
		foreach ($lsblk_data as $value) {
			echo "<tr>";
			foreach ($value as $key => $value) {
				echo "<td>".$value."</td>";
			}
			echo "<tr>";
		}
		?>
		</table>
	</fieldset>
</div>
<div class="drittel-box lastbox">
	<fieldset>
		<legend>Dateisysteme</legend>
		<p>Auflistung aller verfügbaren Dateisysteme</p>
	<div class="listbox_fss">
	<?echo str_replace("\n", "<br>", $fss)?>
	</div>
	</fieldset>
</div>