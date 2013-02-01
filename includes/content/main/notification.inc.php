<div style="padding-top:40px;"></div>
<div id="top">
	<h3 id="n1" class="class">SAS Notification Center</h3>
</div>
<div class="clearfix"></div>
<div id="post">
	<h2 class="ntitel">Paketinstallation erfolgreich</h2>
	<div id="ninfo">
		<?php
		$result = $mysql->Query("SELECT * FROM sas_notifications ORDER BY id DESC LIMIT 10");
		while ($row = $result->fetchObject()) {
		?>
		<div class="nlist"><label>Nr: </label><span class="format">#<?=$row->id?></span></div>
		<div class="nlist"><label>ID: </label><span class="format">#456</span></div>
		<div class="nlist"><label>Zeitpunkt: </label><span class="format"><?=$row->datum?> <?=$row->zeit?></span></div>
		<div class="nlist"><label>Typ: </label><span class="ok"><?=$row->type?></span></div>
		<b>Meldung(en):</b>
		<div id="console">
<?=$row->body?>
		</div>
		<?}?>
	</div>
</div>
<hr>
<br>
<br>
<a class="closing" href="javascript:window.close()">Schlie&szlig;en</a>

