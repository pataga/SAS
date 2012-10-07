<?php
include 'libs/Net/SSH2.php';

if (isset($_POST['output']))
    $output = $_POST['output'];
else
    $output = "root@server:";

if (isset($_POST['command'])) {
    $ssh = new Net_SSH2($_SESSION['server_ip']);
    $ssh->login($_SESSION['server_user'], $_SESSION['server_pass']);
    $output .= $ssh->exec($_POST['command']);
}
?>

<form action="tools.php?page=console" method="POST" class="jNice">
    <h3>Konsole</h3>
    <fieldset>

        <label>Befehl ausf&uuml;hren:</label>
        <input type="text" class="text-long" />
        <input type="submit" value="Befehl ausf&uuml;hren" />

        <br> <br> <br> 
        <label>Konsolenausgabe:</label>
        <textarea id="console" readonly="readonly"><?php echo $output; ?></textarea>

    </fieldset>
</form>
</div>
<!-- // #main -->
<?php require 'inc/html/footer.inc.php'; ?>
