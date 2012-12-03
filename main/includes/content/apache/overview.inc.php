<?php
$ssh->openConnection();

// prozess status über apache2
$status_a2 = $ssh->execute("service apache2 status");

// apache2 version
$version_a2 = $ssh->execute("apache2ctl -v");

// gibt aktive a2 mods in liste aus
$en_mods_a2 = $ssh->execute("ls -1 /etc/apache2/mods-enabled/");

// Verarbeitung...
$version_a2_ = explode("\n", $version_a2);
$version_a2_x = explode(": ", $version_a2_[0]);


if (isset($_POST['a2-stop']) && isset($_POST['a2-stop-h'])) {           //wenn hidden+submit ..
    $ssh->execute("service apache2 stop");                              //.. führe das aus
    $loader->reload();
} elseif (isset($_POST['a2-start']) && isset($_POST['a2-start-h'])) {
    $ssh->execute("service apache2 start");
    $loader->reload();
}
if (isset($_POST['a2-reload']) && isset($_POST['a2-reload-h'])) {           //wenn hidden+submit ..
    $ssh->execute("service apache2 reload");                              //.. führe das aus
    $loader->reload();
}
if (isset($_POST['a2-restart']) && isset($_POST['a2-restart-h'])) {           //wenn hidden+submit ..
    $ssh->execute("service apache2 restart");                              //.. führe das aus
    $loader->reload();
}
?>
<h3>Apache 2 &Uuml;bersicht</h3>
<fieldset>
    <div class="halbe-box">
        <h5>Info:</h5>
        <table>
            <tr>
                <td>Status: </td>
                <td><code class="simple"><?php echo $status_a2; ?></code></td>
            </tr>
            <tr class="odd">
                <td>Version:</td>
                <td><code class="simple"><?php echo $version_a2_x[1]; ?></code></td>
            </tr>
        </table>
        <br>
        <a href="<?php $_SERVER['SCRIPT_NAME'] ?>" class="button white">Aktualisieren</a>
    </div>
    <div class="halbe-box lastbox">
        <h5>Aktive Module:</h5>
        <textarea name="" id="a2_module" readonly="readonly"><?php echo $en_mods_a2; ?></textarea>
    </div>
    <div class="clearfix"></div>
</fieldset>
</fieldset>
<h4>Aktionen</h4>
<fieldset>
    <div class="drittel-box">
        <h5>Start / Stop</h5>
        <p><b><?php echo ($server->getServiceStatus($ssh, 'apache2')) ? 'Stoppt' : 'Startet'; ?> den Webserver sofort.</b></p>
        <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
            <?php
            echo ($server->getServiceStatus($ssh, 'apache2')) ? '<input type="hidden" name="a2-stop-h"><input type="submit" name="a2-stop" value="Stop" class="button pink">' : '<input type="hidden" name="a2-start-h"><input type="submit" name="a2-start" value="Start" class="button green">';
            ?>
        </form>
    </div>
    <div class="drittel-box">
        <h5>Reload</h5>
        <p><b>Lädt die Apache Konfiguration neu</b></p>
        <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
            <input type="hidden" name="a2-reload-h">
            <input type="submit" name="a2-reload" value="neu laden" class="button darkblue">
        </form>
    </div>
    <div class="drittel-box lastbox">
        <h5>Restart</h5>
        <p><b>Startet den Webserver neu</b></p>
        <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
            <input type="hidden" name="a2-restart-h">
            <input type="submit" name="a2-restart" value="neustarten" class="button darkblue">
        </form>
    </div>
    <div class="clearfix"></div>
</fieldset>
<?php
if (isset($_POST['a2-restart']) || isset($_POST['a2-reload']) || isset($_POST['a2-restart'])) {
    echo '<span class="info"><b>Hinweis:</b> Bitte beachten Sie, dass der Status ggf. nach einer Aktion manuell aktuelisiert werden muss. Klicken Sie hierzu einfach den Aktualisieren-Button. Dies kommt durch die Zeitverzögerung der Verbindung zum Server zustande.</span>';
}
?>
<!--
<fieldset>
        <textarea name="" id="console" readonly="readonly"><?php ?></textarea>
</fieldset>
-->