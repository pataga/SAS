<?php


/**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt
* @author Tanja Weiser
*
*/


if(isset($_POST['stop']))
{
	$ssh->openConnection();
	$ssh->execute('service smbd stop');
}
if(isset($_POST['restart']))
{
	$ssh->openConnection();
	$ssh->execute('service smbd restart');
}

$ssh->openConnection();
$line=$ssh->execute('pdbedit -L',2);
$ausgabe = "";
foreach($line as $value)
{
	$pdbedit=explode(":",$value);
	$ausgabe .=$pdbedit[0]."<br>";
}


?>

<h3>Samba Übersicht</h3>
<fieldset>
<div class ="drittel-box">
	<h5>Aktuell angelegte User:</h5>
</div>
<div class ="zweidrittel-box lastbox">
	<h5><?=$ausgabe."<br>"?></h5> 
</div>
</fieldset>

<fieldset>
<form action="index.php?p=samba" method="POST">
<div class ="drittel-box"> 
<h5>Stop</h5>
<p><b>Stoppt den Dienst sofort</b></p>
	<br><input type="submit" class="button pink" name="stop" value="stop"> 
</div>
<div class ="drittel-box lastbox">
<h5>Restart</h5>
<p><b>Startet den Dienst neu</b></p>
	<br><input type="submit" class="button black" name="restart" value="neustarten">
</div>
</div>
</form>
</fieldset>
