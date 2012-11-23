<?php
    if (isset($_POST['server']) && $_POST['server'] != -1)
    {
        $_SESSION['server_id'] = $_POST['server'];
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
<hr>
<b>Dev-Info:</b>&nbsp;"<?php echo __file__;?>"</p>
</fieldset>