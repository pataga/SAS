<?php
/**
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.0.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt
 * @author Gabriel Wanzek
 *
 */
$ssh->openConnection();

// prozess status über apache2
$status_a2 = $ssh->execute("service apache2 status");

// apache2 version
$version_a2 = $ssh->execute("apache2ctl -v");

// gibt aktive a2 mods in liste aus
$en_mods_a2 = $ssh->execute("ls -1 /etc/apache2/mods-enabled/ | grep load");

// Verarbeitung...
$version_a2_ = explode("\n", $version_a2);
$version_a2_x = explode(": ", $version_a2_[0]);
$en_mods_a2_ = explode(".load", $en_mods_a2);

if (isset($_POST['a2-stop']) && isset($_POST['a2-stop-h'])) {           //wenn hidden+submit ..
    $ssh->execute("service apache2 stop");                              //.. führe das aus
} elseif (isset($_POST['a2-start']) && isset($_POST['a2-start-h'])) {
    $ssh->execute("service apache2 start");
}
if (isset($_POST['a2-reload']) && isset($_POST['a2-reload-h'])) {           //wenn hidden+submit ..
    $ssh->execute("service apache2 reload");                              //.. führe das aus
}
if (isset($_POST['a2-restart']) && isset($_POST['a2-restart-h'])) {           //wenn hidden+submit ..
    $ssh->execute("service apache2 restart");                              //.. führe das aus
}
if (isset($_POST['a2_install'])) {           //wenn hidden+submit ..
    $ssh->execute("apt-get install apache2 -fy");
    $mysql->Query("UPDATE sas_server_data SET apache=1 WHERE id = " . $_SESSION['server_id']);                              //.. führe das aus
}
?>
<h3>Apache 2 &Uuml;bersicht</h3>
<?php
if (!$server->isInstalled('apache')) {
    echo '<fieldset>
    <legend>Apache2 installieren</legend>
    <span class="error"> <b>Fehler:</b> Apache2 ist nicht installiert.</span><br>
    <form action="?p=apache" method="post">
    <p>Wenn Sie den Apache2 jetzt installieren möchten klicken Sie hier: <input type="submit" name="a2_install" value="Apache2 installieren" class="button black">
    </p>
    </form>
</fieldset>';
}
?>
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
        <a href="?p=apache" class="button white">Aktualisieren</a>
    </div>
    <div class="halbe-box lastbox">
        <h5>Aktive Module:</h5>
        <div name="a2_module" class="a2_module"><?php
foreach ($en_mods_a2_ as $key => $value) {
    echo $value . "<br>";
};
?></div>
    </div>
    <div class="clearfix"></div>
</fieldset>
</fieldset>
<h4>Aktionen</h4>
<fieldset>
    <div class="drittel-box">
        <h5>Start / Stop</h5>
        <p><b><?php echo ($server->getServiceStatus($ssh, 'apache2')) ? 'Stoppt' : 'Startet'; ?> den Webserver sofort.</b></p>
        <form action="?p=apache" method="post">
            <?php
            echo ($server->getServiceStatus($ssh, 'apache2')) ? '<input type="hidden" name="a2-stop-h"><input type="submit" name="a2-stop" value="Stop" class="button pink">' : '<input type="hidden" name="a2-start-h"><input type="submit" name="a2-start" value="Start" class="button green">';
            ?>
        </form>
    </div>
    <div class="drittel-box">
        <h5>Reload</h5>
        <p><b>Lädt die Apache Konfiguration neu</b></p>
        <form action="?p=apache" method="post">
            <input type="hidden" name="a2-reload-h">
            <input type="submit" name="a2-reload" value="neu laden" class="button darkblue">
        </form>
    </div>
    <div class="drittel-box lastbox">
        <h5>Restart</h5>
        <p><b>Startet den Webserver neu</b></p>
        <form action="?p=apache" method="post">
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