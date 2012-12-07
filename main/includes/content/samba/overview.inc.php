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
	// Stop
}
if(isset($_POST['restart']))
{
	// neustarten
}
?>

<h3>Samba Übersicht</h3>
<fieldset>
<p>Pfad zur Datei mit Inhalt: 
<br><br>
    <?php echo __file__;?></p>
</fieldset>
<fieldset>
<form action="index.php?p=samba" method="POST">
<div class ="drittel-box"> 
<h5>Stop</h5>
	<br><input type="submit" class="button pink" name="stop" value="stop"> 
</div>
<div class ="drittel-box lastbox">
<h5>Restart</h5>
	<br><input type="submit" class="button black" name="restart" value="neustarten">
</div>
</div>
</form>
</fieldset>
