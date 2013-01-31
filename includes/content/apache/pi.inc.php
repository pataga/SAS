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

$phpinfo_txt = $server->execute("php -i");

if (isset($_POST['create_file']) && isset($_POST['create_file_s'])) {           //wenn hidden+submit ..
    $server->execute("touch /var/www/phpinfo.php");
    $server->execute("echo '<?php phpinfo(); ?>' > /var/www/phpinfo.php");
}

if (isset($_POST['del_file']) && isset($_POST['del_file_s'])) {         //wenn hidden+submit ..
    $server->execute("rm /var/www/phpinfo.php");
}
?>
<h3>PHP-Informationen</h3>
<fieldset>
    <div <?php echo (isset($_POST['show_txt']) && isset($_POST['show_txt_s'])) ? 'style="display: none;";' : ""; ?>>
        <iframe class="phpinfo" src="http://<?php echo $server->getAddress(); ?>/phpinfo.php" frameborder="0"></iframe>
        <br>
        <hr>
        <p>Um die phpinfo als HTML-Dokument zu sehen, muss der Webserver gestartet sein. Sollte dieser nicht gestartet sein, können Sie die phpinfo optional als Textdatei generieren.</p>
    </div>
<?php
if (isset($_POST['show_txt']) && isset($_POST['show_txt_s'])) {
    echo '<textarea id="phpinfotxt" readonly="readonly">' . $phpinfo_txt . '</textarea>';
}
?>
    <hr>
    <div class="drittel-box">
        <p style="margin-top:15px;">Falls die Datei nicht gefunden wird können Sie diese hier generieren:<br></p>
        <form action="?p=apache&s=phpinfo" method="post">
            <input type="hidden" name="create_file">
            <input type="submit" value="phpinfo generieren" name="create_file_s" class="button darkblue">
        </form>
    </div>
    <div class="drittel-box">

        <p style="margin-top:15px;">Die generierte Datei kann hiermit gegebenenfalls gelöscht werden:<br></p>
        <form action="?p=apache&s=phpinfo" method="post">
            <input type="hidden" name="del_file">
            <input type="submit" value="phpinfo löschen" name="del_file_s" class="button pink">
        </form>
    </div>
    <div class="drittel-box lastbox">
        <p style="margin-top:15px;">Gibt die vollständige phpinfo als text aus, ohne dass der Apache läuft.<br></p>
        <form action="?p=apache&s=phpinfo" method="post">
            <input type="hidden" name="show_txt">
            <input type="submit" value="phpinfo.txt" name="show_txt_s" class="button darkblue">
        </form>
    </div>
    <div class="clearfix"></div>

<?php
if (isset($_POST['create_file']) && isset($_POST['create_file_s'])) {
    echo '<hr>
<span class="success"><b>Hinweis:</b><br>Die Datei wurde unter folgendendem Pfad generiert:&nbsp;
    <code class="simple">
        <a href="http://' . $server->getAddress() . '/phpinfo.php" target="_blank">/var/www/phpinfo.php</a>
    </code>
</span>
';
}
if (isset($_POST['del_file']) && isset($_POST['del_file_s'])) {
    echo '<hr>
<span class="success"><b>Hinweis:</b><br>Die Datei wurde gelöscht.
</span>
';
}
?>
</fieldset>