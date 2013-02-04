<div style="padding-top:40px;"></div>
<div id="top">
    <h3 id="n1" titel="Klicken zum aktualisieren" onclick="location.reload()" class="class">SAS Notification Center</h3>
</div>
<div class="clearfix"></div>
<?php
$result = $mysql->Query("SELECT * FROM sas_notifications ORDER BY id DESC LIMIT 25");
while ($row = $result->fetchObject()) {
    ?>
    <div id="post">
        <h2 class="ntitel"><?= $row->type ?></h2>
        <div id="ninfo">
            <div class="nlist"><label>Nr: </label><span class="format">#<?= $row->id ?></span></div>
            <div class="nlist"><label>ID: </label><span class="format">#1</span></div>
            <div class="nlist"><label>Zeitpunkt: </label><span class="format"><?= date("d.m.Y \u\m H:i",strToTime($row->datum)) ?> | <?= $row->zeit ?></span></div>
            <div class="nlist"><label>Typ: </label><span class="ok"><?= $row->type ?></span></div>
            <b>Meldung(en):</b>
            <div id="console"><?= $row->body ?></div>
        </div>
    </div>
    <hr class="nf">
<? } ?>
