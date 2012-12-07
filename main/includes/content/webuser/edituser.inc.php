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


if (isset($_POST['edituser']))
{
	$username = $_POST['username'];
}

?>

<!--############ User bearbeiten ############//-->
<h3>Benutzer bearbeiten</h3>
<fieldset>
<form action="index.php?p=webuser&s=edit" method="POST">

<div class ="fuenftel-box"> 	
	<br>Username: 
</div>

<div class="vierfuenftel-box lastbox">
	<br><input type="text" class="text-long" name="username" id=""><br><br><br>
</div>

	<input type="submit" class="button black" name="edituser" value="Anzeigen">
</form>
</fieldset>
