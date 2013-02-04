<?php 

?>
<br><br>
<form action="index.php?p=ftp&s=config" method="POST">
<fieldset>
<legend>Konfiguration</legend>
<div class="halbe-box">

<label>Servername:</label>
<input type="text" class="text-long" name="servername"><br><br><br>
<label>Servertyp:</label>
<input type="text" class="text-long" name="servertyp" placeholder="bspw. standalone">
</div>
<div class="halbe-box lastbox">
<br>
<select name="Produkt">
		<option value="0">IPV4</option>
		<option value="1">IPV6</option>
</select><br><br><br><br><br><br><br>
</div>

<div class="drittel-box">
Wilkommenstext?<br><br>
Default Root?<br>
</div>
<div class="zweidrittel-box lastbox">
<input type="radio" name="text" value="an" checked="checked">&nbsp;&nbsp;an
<input type="radio" name="text" value="aus">&nbsp;&nbsp;aus<br><br>
<input type="radio" name="dr" value="an" checked="checked">&nbsp;&nbsp;an
<input type="radio" name="dr" value="aus">&nbsp;&nbsp;aus
</div>
<label>Port:</label>
<input type="text" class="text-long" name="port" placeholder="Standard: 21">






</fieldset>
</form>