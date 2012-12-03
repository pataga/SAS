<?php
    if (!$server->isInstalled('mysql')) {
        header('Location: ?p=mysql&s=configure');
        die();
    }
    if (isset($_POST['adduser'])) {
        $db = $_POST['user']."_".rand(5000,50000);
        $mysql_remote->Query("CREATE DATABASE $db");
        $mysql_remote->Query("GRANT ALL PRIVILEGES ON $db.* TO '".$_POST['user']."'@'%' IDENTIFIED BY '".$_POST['pass']."'");
        if ($_POST['admin'] == 1) {
            $mysql_remote->Query("GRANT ALL PRIVILEGES ON *.* TO '".$_POST['user']."'@'%' IDENTIFIED BY '".$_POST['pass']."' WITH GRANT OPTION");
        }
    }
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