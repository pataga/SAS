<?php
$ssh->openConnection();
$status_a2 = $ssh->execute("service apache2 status");        //prozess status über apache2
$version_a2 = $ssh->execute("apachectl -v");        //apache2 version
$info_a2 = $ssh->execute("apache2ctl status");
$version_a2_ = explode("\n", $version_a2);
$version_a2_x = explode(": ", $version_a2_[0]);

?>
<h3>Apache 2 &Uuml;bersicht</h3>
<fieldset>
	<div class="halbe-box">
	<table>
		<tr>
			<td>Status: </td>
			<td><code class="simple"><?php echo $status_a2; ?></code></td>
		</tr>
		<tr styl;class="odd">
			<td>Version:</td>
			<td><code class="simple"><?php echo $version_a2_x[1]; ?></code></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr class="odd">
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr class="odd">
			<td></td>
			<td></td>
		</tr>
	</table>
	</div>
	<div class="halbe-box lastbox">
		<table>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr class="odd">
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
		</table>
	</div>
	<div class="clearfix"></div>
</fieldset>
<hr>
<fieldset>
<textarea name="" id="console" readonly="readonly"><?php echo $info_a2;?></textarea>
</fieldset>