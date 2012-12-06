<?php
if (isset($_POST['edituser']))
{
	$username = $_POST['username'];
}

?>

<!--############ User bearbeiten ############//-->

<fieldset>
<form action="index.php?p=webuser&s=edit" method="POST">

<h3>Benutzer bearbeiten</h3><br><br>
 	Username: <input type="text-long" name="username" id=""><br><br><br>
	<input type="submit" class="button black" name="edituser" value="Anzeigen">
	<br><br>
</form>
</fieldset>
