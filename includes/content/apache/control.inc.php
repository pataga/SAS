<?php
$ssh->openConnection();
if (isset($_POST['a2-stop']) && isset($_POST['a2-stop-h'])) {
    $ssh->execute("service apache2 stop");
} elseif (isset($_POST['a2-start'])) {
    $ssh->execute("service apache2 start");
}
if (isset($_POST['a2-reload'])) {
    $ssh->execute("service apache2 reload");
}
if (isset($_POST['a2-restart'])) {
    $ssh->execute("service apache2 restart");
}
if (isset($_POST['a2-f-reload'])) {
    $ssh->execute("service apache2 force-reload");
}
?>

<h3>Apache2 Steuerung</h3>
<fieldset>
    <div class="viertel-box">
        <h5>Start / Stop</h5>
        <p><b><?php echo ($server->getServiceStatus($ssh, 'apache2')) ? 'Stoppt' : 'Startet'; ?> den Webserver sofort.</b></p>
        <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
            <?php
            echo ($server->getServiceStatus($ssh, 'apache2')) ? '<input type="hidden" name="a2-stop-h"><input type="submit" name="a2-stop" value="Stop" class="button pink">' : '<input type="hidden" name="a2-start-h"><input type="submit" name="a2-start" value="Start" class="button green">';
            ?>
        </form>
    </div>
    <div class="viertel-box">
        <h5>Reload</h5>
        <p>
            <a href="#" class="tooltip3">Information
                <span>Lädt die Konfigurationsdateien neu, ohne dass Verbindungen getrennt werden</span>
            </a>
        </p>
        <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
            <input type="submit" name="a2-reload" value="neu laden" class="button darkblue">
        </form>
    </div>
    <div class="viertel-box">
        <h5>Force-Reload</h5>
        <p>
            <a href="#" class="tooltip3">Information
                <span>Lädt die Konfigurationsdateien neu, auch wenn dabei Verbindungen getrennt werden müssen</span>
            </a>
        </p>
        <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
            <input type="submit" name="a2-f-reload" value="neu laden" class="button darkblue">
        </form>
    </div>
    <div class="viertel-box lastbox">
        <h5>Restart</h5>
        <p>
            <a href="#" class="tooltip">Information
                <span>Startet den Webserver neu</span>
            </a>
        </p>
        <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
            <input type="submit" name="a2-restart" value="neu starten" class="button darkblue">
        </form>
    </div>
    <div class="clearfix"></div>
</fieldset>