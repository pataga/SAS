<?php 

if(isset($_POST['stop'])) 
	$server->execute('service proftpd stop');
if(isset($_POST['start'])) 
	$server->execute('service proftpd start');
if(isset($_POST['restart'])) 
	$server->execute('service proftpd restart');

?>
<form action="index.php?p=ftp&s=control" method="POST">
	<br><br>
<fieldset>	
	<legend>ProFTPD Steuerung</legend>
<div class ="drittel-box"> 
<h5>Stop</h5>
<p><b>Stoppt den Dienst sofort</b></p>
	<br><input type="submit" class="button pink" name="stop" value="stop"> 
</div>

<div class ="drittel-box"> 
<h5>Start</h5>
<p><b>Startet den Dienst</b></p>
	<br><input type="submit" class="button green" name="start" value="starten"> 
</div>

<div class ="drittel-box lastbox">
<h5>Restart</h5>
<p><b>Startet den Dienst neu</b></p>
	<br><input type="submit" class="button black" name="restart" value="neustarten">
</div>


</form>
</fieldset>
