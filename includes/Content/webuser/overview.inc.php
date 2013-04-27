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

$result = $mysql->Query("SELECT * FROM sas_users");
$content = "<table><th>Benutzername</th><th>E-Mail</th>";
while ($row = $result->fetchObject()) {
    $content .= "<tr><td>".$row->username."</td>";
    $content .= "<td>".$row->email."</td>";
}
$content .= "</table>";

?>

<form action="index.php?p=webuser" method="POST">   
<br>
	<fieldset>
		<legend>Webuser</legend>
			Webuser sind Benutzer des Server Admin Systems. Sie können mehrere Benutzer anlegen, sodass mehrere Personen die Möglichkeit haben das System zu verwenden.
			Sie können die Rechte für jeden User individuell unter dem Menüpunkt "Benutzer bearbeiten" festlegen nachdem Sie diesen Benutzer erstellt haben. 
	</fieldset>
	<fieldset>
		 <legend>Benutzer</legend><br>

	     <?=$content?>
	 

	</fieldset>
</form>