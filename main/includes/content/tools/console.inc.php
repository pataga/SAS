<?php
if (isset($_POST['output']))
    $output = $_POST['output'];
else
    $output = "root@server:";

if (isset($_POST['command'])) {
    $ssh->openConnection();
    $output .= $ssh->execute($_POST['command']);
}
?>

<form action="?p=tools&s=console" method="POST">
    <h3>Konsole</h3>
    <fieldset>

        <label>Befehl ausf&uuml;hren:</label>
        <input type="text" name="command" class="text-long" />
        <input type="submit" value="Befehl ausf&uuml;hren" class="button black"/>

        <br> <br> <br> 
        <label>Konsolenausgabe:</label>
        <textarea id="console" readonly="readonly"><?php echo $output; ?></textarea>

    </fieldset>
</form>

