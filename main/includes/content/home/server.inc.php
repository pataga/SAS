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
    <select name="server" class="shadow">
        <option value="-1"> </option>
        <?php echo $server_selection; ?>
    </select>
    <br><br>
    <input class="button black"type="submit" value="Server ausw&auml;hlen">
</form>
</fieldset>
<h3>Server hinzuf&uuml;gen</h3>
<fieldset>
<form action="index.php" method="post">
    <table>
        <p><label>Server Name:</label>
        <input type="text" name="name" class="text-long"></p>
        <p><label>Server Host:</label>
        <input type="text" name="shost" class="text-long"></p>
        <p><label>SSH Port:</label>
        <input type="text" name="sport" class="text-long"></p>
        <p><label>Benutzername: </label>
        <input type="text" name="suser" class="text-long"></p>
        <p><label>Passwort: </label>
        <input type="password" name="spass" class="text-long"></p>
        <input type="submit" value="Server eintragen" class="button green">
    </table>
</form>
<!--<hr>
<b>Dev-Info:</b>&nbsp;"<?php echo __file__;?>"</p>-->
</fieldset>
