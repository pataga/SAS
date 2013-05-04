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
$checkinstall = $server->execute('if [ -d /etc/apache2/ ]; then echo "true"; else echo "false"; fi');

if (preg_match("/false/", $checkinstall)) {
    echo "<script>setTimeout('window.location.href=\"?p=apache\"', 2000)</script><span class=\"error\"><b>Fehler!</b><br>Apache2 ist nicht installiert! Sie werden nun zur Installation umgeleitet.</span>";
}

$en_mods_a2 = $server->execute("ls -1 /etc/apache2/mods-enabled/ | grep load", 2);
$av_mods_a2 = $server->execute("ls -1 /etc/apache2/mods-available/ | grep load", 2);

if (isset($_POST['akt'])) {
    $server->execute("a2enmod " . $_POST['akt'] . "&& service apache2 reload");
}

if (isset($_POST['deakt'])) {
    $server->execute("a2dismod " . $_POST['deakt'] . " && service apache2 reload");
}
?>
<h3>Apache-Module</h3>
<?php
if (isset($_POST['akt']))
    echo '<span class="success"><b>Info:</b><br>Das Modul ' . $_POST['akt'] . ' wurde aktiviert.</span>';
if (isset($_POST['deakt']))
    echo '<span class="success"><b>Info:</b><br>Das Modul ' . $_POST['deakt'] . ' wurde deaktiviert.</span>';
?>
<div class="halbe-box">
    <fieldset>
        <legend>Verfügbare Module</legend>
        <div name="a2_module" class="a2_module_big"><?php
foreach ($av_mods_a2 as $key => $value) {
    echo str_replace(".load", "<br>", $value);
}
?><br></div>

    </fieldset>
</div>
<div class="halbe-box lastbox">
    <fieldset>
        <legend>Aktive Module</legend>
        <div name="a2_module" class="a2_module_big"><?php
            foreach ($en_mods_a2 as $key => $value) {
                echo str_replace(".load", "<br>", $value);
            };
?><br></div>


    </fieldset>
</div>
<div class="clearfix"></div>

<div class="halbe-box">
    <fieldset>
        <legend>Modul aktivieren</legend>
        <form action="?p=apache&s=module" method="post">
            <input class="text-medium" name="akt" type="text" list="avmods" required>
            <datalist id="avmods">
                <?php
                foreach ($av_mods_a2 as $key => $value) {
                    echo "\t\t\t" . '<option value="' . str_replace(".load", '">', $value); //.'">';
                }
                ?>
            </datalist> 
            <input type="submit" value="aktivieren" class="button black">
        </form>
    </fieldset>
</div>
<div class="halbe-box lastbox">
    <fieldset>
        <legend>Modul deaktivieren</legend>
        <form action="?p=apache&s=module" method="post">
            <input class="text-medium" name="deakt" type="text" list="enmods" required>
            <datalist id="enmods">
                <?php
                foreach ($en_mods_a2 as $key => $value) {
                    echo "\t\t\t" . '<option value="' . str_replace(".load", '">', $value); //.'">';
                }
                ?>
            </datalist> 
            <input type="submit" value="deaktivieren" class="button black">
        </form>
    </fieldset>
</div>
<div class="clearfix"></div>
<fieldset>
    <legend>Informationen</legend>
    <a href="http://httpd.apache.org/docs/2.2/mod/index.html" target="_blank">Hier</a> finden Sie Informationen zu sämtlichen Modulen.
</fieldset>