<?php
/**
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.0.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
 * @author Gabriel Wanzek
 * @version 1.0
 *
 */
// prozess status über apache2
$status_a2 = $server->execute("service apache2 status");

// apache2 version
$version_a2 = $server->execute("apache2ctl -v");

// gibt aktive a2 mods in liste aus
$en_mods_a2 = $server->execute("ls -1 /etc/apache2/mods-enabled/ | grep load");

// Verarbeitung...
$version_a2_ = explode("\n", $version_a2);
$version_a2_x = explode(": ", $version_a2_[0]);
$en_mods_a2_ = explode(".load", $en_mods_a2);
$out = "";
if (isset($_POST['a2-stop'])) {           //wenn hidden+submit ..
    $out = $server->execute("service apache2 stop");                              //.. führe das aus
} elseif (isset($_POST['a2-start'])) {
    $out = $server->execute("service apache2 start");
}
if (isset($_POST['a2-reload'])) {           //wenn hidden+submit ..
    $out = $server->execute("service apache2 reload");                              //.. führe das aus
}
if (isset($_POST['a2-restart'])) {           //wenn hidden+submit ..
    $out = $server->execute("service apache2 restart");                              //.. führe das aus
}
if (isset($_POST['a2_install'])) {           //wenn hidden+submit ..
    $server->execute("apt-get install apache2 -fy");
    $mysql->Query("UPDATE sas_server_data SET apache=1 WHERE id = " . $_SESSION['server']['id']);                              //.. führe das aus
}
if (isset($_POST['a2_isinstalled'])) {
    $mysql->Query("UPDATE sas_server_data SET apache=1 WHERE id = " . $_SESSION['server']['id']);
}
?>
<h3>Apache-Übersicht</h3>
<?php
if (!$server->isInstalled('apache')) {
    echo '<br><fieldset>
    <legend>Apache2 installieren</legend>
    <span class="error"> <b>Fehler:</b> Apache2 ist nicht installiert.</span><br>
    <form action="?p=apache#action" method="post">
    <p>Wenn Sie den Apache2 jetzt installieren möchten klicken Sie hier: <br><br>
    <input type="submit" name="a2_install" value="Apache2 installieren" class="button black">
    Wenn Sie den Apache2 schon installiert haben, klicken Sie <input type="submit" name="a2_isinstalled" value="hier" class="invs">.
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
        <a href="?p=apache" class="button white"><i class="icon-arrows-ccw"></i>  Aktualisieren</a>
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
<?php if (isset($_POST['action'])): ?>
    <span class="info" id="action">
        <img src="./img/load.gif" style="float:right;width:24px;height:24px;padding:7px;" >Aktion wird ausgeführt. Einen Moment bitte...
        <hr>
<pre class="simple">
<?=$out?>
</pre>
    </span>
    <script>setTimeout('window.location.href="?p=apache"', 2750)</script>
<?php endif; ?>
</fieldset>
<h4>Aktionen</h4>
<fieldset>
    <div class="drittel-box">
        <h5>Start / Stop</h5>
        <p><b><?php echo ($server->getServiceStatus('apache2')) ? 'Stoppt' : 'Startet'; ?> den Webserver sofort.</b></p>
        <form action="?p=apache#action" method="post">
            <?php
            echo ($server->getServiceStatus('apache2')) ? '<input type="hidden" name="action"><input type="submit" name="a2-stop" value="Stop" class="button pink">' : '<input type="hidden" name="action"><input type="submit" name="a2-start" value="Start" class="button green">';
            ?>
        </form>
    </div>
    <div class="drittel-box">
        <h5>Reload</h5>
        <p><b>Lädt die Apache Konfiguration neu</b></p>
        <form action="?p=apache#action" method="post">
            <input type="hidden" name="action">
            <input type="submit" name="a2-reload" value="neu laden" class="button darkblue">
        </form>
    </div>
    <div class="drittel-box lastbox">
        <h5>Restart</h5>
        <p><b>Startet den Webserver neu</b></p>
        <form action="?p=apache#action" method="post">
            <input type="hidden" name="action">
            <input type="submit" name="a2-restart" value="neustarten" class="button darkblue">
        </form>
    </div>
    <div class="clearfix"></div>
</fieldset>
<?php
if (isset($_POST['action'])) {
    echo '<span class="info"><b>Hinweis:</b> Bitte beachten Sie, dass der Status ggf. nach einer Aktion manuell aktuelisiert werden muss. Klicken Sie hierzu einfach den Aktualisieren-Button. Dies kommt durch die Zeitverzögerung der Verbindung zum Server zustande.</span>';
}
?>