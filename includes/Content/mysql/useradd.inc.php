<?php

/**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
* @author Patrick Farnkopf
*
*/

$data = $main->Server()->getMySQLData();
if (!$data) {
    header('Location: ?p=mysql&s=configure');
    exit;
}

$dbModule = new \Classes\Module\MySQL\DBHandler($data);


?>

<h3 class="ubuntu">MySQL Benutzer anlegen</h3> 
<fieldset>
    <form action="?p=mysql&s=adduser" method="post">
        <p><label>Benutzername:</label>
        <input type="text" name="user" class="text-long required" required></p>
        <p><label>Passwort:</label>
        <input type="password" name="pass" class="text-long required" required></p>
        <p><label>Passwort wiederholen:</label>
        <input type="password" name="passr" class="text-long required" required></p>
        <p><label>Vollzugriff?:</label>
        <select name="admin">
            <option value="0">Nein</option>
            <option value="1">Ja</option>
        </select></p>
        <input class="button white" type="submit" name="adduser" value="Benutzer anlegen">
    </form>
</fieldset>