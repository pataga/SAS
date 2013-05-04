<?php
/**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
* @author Gabriel Wanzek
* @version 1.1
*
*/

$checkinstall = $server->execute('if [ -d /etc/apache2/ ]; then echo "true"; else echo "false"; fi');

if (preg_match("/false/", $checkinstall)) {
    echo "<script>setTimeout('window.location.href=\"?p=apache\"', 2000)</script><span class=\"error\"><b>Fehler!</b><br>Apache2 ist nicht installiert! Sie werden nun zur Installation umgeleitet.</span>";
}

$out = "";
if (isset($_POST['a2-stop'])) {
    $out = $server->execute("service apache2 stop");
} elseif (isset($_POST['a2-start'])) {
    $out = $server->execute("service apache2 start");
}
if (isset($_POST['a2-reload'])) {
    $out = $server->execute("service apache2 reload");
}
if (isset($_POST['a2-restart'])) {
    $out = $server->execute("service apache2 restart");
}
if (isset($_POST['a2-f-reload'])) {
    $out = $server->execute("service apache2 force-reload");
}
?>
<h3>Apache-Steuerung</h3>
<?php if (isset($_POST['action'])): ?>
    <span class="info" id="action">
        <img src="./img/load.gif" style="float:right;width:24px;height:24px;padding:7px;" >Aktion wird ausgeführt. Einen Moment bitte...
        <hr>
<pre class="simple">
<?=$out?>
</pre>
    </span>
    <script>setTimeout('window.location.href="?p=apache&s=control"', 2750)</script>
<?php endif; ?>
<fieldset>
    <div class="viertel-box">
        <h5>Start / Stop</h5>
        <p><b><?php echo ($server->getServiceStatus('apache2')) ? 'Stoppt' : 'Startet'; ?> den Webserver sofort.</b></p>
        <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
            <?php
            echo ($server->getServiceStatus('apache2')) ? '<input type="hidden" name="action"><input type="submit" name="a2-stop" value="Stop" class="button pink">' : '<input type="hidden" name="action"><input type="submit" name="a2-start" value="Start" class="button green">';
            ?>
            <input type="hidden" name="action">
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
            <input type="hidden" name="action">
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
            <input type="hidden" name="action">
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
            <input type="hidden" name="action">
        </form>
    </div>
    <div class="clearfix"></div>
</fieldset>