<?php
    if (isset($_POST['server']) && $_POST['server'] != -1)
    {
        $_SESSION['server_id'] = $_POST['server'];
        $loader->reload();
    }
    else if (isset($_POST['name'])&&isset($_POST['shost'])&&isset($_POST['sport'])&&isset($_POST['suser'])&&isset($_POST['spass']))
    {
        $database->addServer($_POST['name'],$_POST['shost'],$_POST['sport'],$_POST['suser'],$_POST['spass']);
        $loader->reload();
    }

    $result = mysql_query("SELECT id, name, host FROM sas_server_data");
    $server_selection = "";
    while ($row = mysql_fetch_object($result))
    {
        $server_selection .= "<option value='$row->id'>Server '$row->name' - $row->host</option>";
    }
?>

<h3>Serverauswahl</h3>
<fieldset>
<p>Bitte w&auml;hlen Sie ihren Server aus, den Sie mit SAS verwalten m&ouml;chten.</p>
<form action="index.php" method="post">
    <label>Server:</label>
    <select name="server">
        <option value="-1"> </option>
        <?php echo $server_selection; ?>
    </select>
    <br><br>
    <input class="button black"type="submit" value="Server ausw&auml;hlen">
</form>
</fieldset>
<br>
<h3>Server hinzuf&uuml;gen</h3>
<fieldset>
<form action="index.php" method="post">
    <table>
        <tr><td> Server Name </td><td><input type="text" name="name"></td></tr>
        <tr><td> Server Host </td><td><input type="text" name="shost"></td></tr>
        <tr><td> SSH Port </td><td><input type="text" name="sport"></td></tr>
        <tr><td> Benutzername </td><td><input type="text" name="suser"></td></tr>
        <tr><td> Passwort </td><td><input type="password" name="spass"></td></tr>
        <tr><td>&nbsp;</td><td><input type="submit" value="Server eintragen"></td></tr>
    </table>
</form>
<hr>
<b>Dev-Info:</b>&nbsp;"<?php echo __file__;?>"</p>
</fieldset>
