<?php
$ssh->openConnection();
$ramload = $ssh->execute("free | head -2");        //für Serverload
?>

<h3> Hier ensteht die Seite "RAM Auslastung"</h3>
<fieldset>
<pre><?php echo $ramload;?></pre>
<br>
<div class="progress-bar green stripes">
    <span style="width: 10%"></span>
</div>
</fieldset>
<p style="text-align: center; font-weight: 700;">Entwickler: Gabriel</p>