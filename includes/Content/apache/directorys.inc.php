<?php
/**
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.1.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
 * @author Gabriel Wanzek
 *
 */

$checkinstall = $server->execute('if [ -d /etc/apache2/ ]; then echo "true"; else echo "false"; fi');

if (preg_match("/false/", $checkinstall)) {
    echo "<script>setTimeout('window.location.href=\"?p=apache\"', 2000)</script><span class=\"error\"><b>Fehler!</b><br>Apache2 ist nicht installiert! Sie werden nun zur Installation umgeleitet.</span>";
}

//prüfe ob /etc/apache2/sas-dd.conf existiert -- wenn nicht, erstelle diese
$sasddexis = $server->execute('if [ -f /etc/apache2/sas-dd.conf ]; then echo "true"; fi');
if ($sasddexis != "true") {
    $server->execute('touch /etc/apache2/sas-dd.conf');
}

//prüfe ob 'Include sas-dd.conf' in der datei /etc/apache2/apache2.conf steht
$checkconf = $server->execute('cat /etc/apache2/apache2.conf | grep sas-dd');
$cfstatus = (preg_match('/Include sas-dd.conf/', $checkconf)) ? true : false ;

if(isset($_POST['insertinc'])) {
	$server->execute('echo -ne "\n# Include SAS-Directory Settings\nInclude sas-dd.conf\n" >> /etc/apache2/apache2.conf && service apache2 reload');
}

// Dieser Part hat mich zwei Tassen Kaffee und eine Apache Neuinstallation gekostet [auf dem Schlauch stehen ist nervtötend!]
if (isset($_POST['go'])) {
    $cmdp1 = "";
    foreach ($_POST['options'] as $value) {
        $cmdp1 .= '\t'.$value.'\n';
    }
    $cmd = 'echo -ne "\n<Directory '.$_POST['path'].'>\n\t#'.$_POST['comment'].'\n'.$cmdp1.'</Directory>\n" >> /etc/apache2/sas-dd.conf';
    $server->execute($cmd);
}
?>
<script>
$(function(){var e=$("#variable");var t=$("#option").size()+1;$("#onemore").live("click",function(){$('<p><label>Direktive:</label><input type="text" id="option" name="options[]" class="text-long"><a href="#" id="away"><i class="icon-cancel-squared"></i> Entfernen</a></p>').appendTo(e);t++;return false});$("#away").live("click",function(){if(t>2){$(this).parents("p").remove();t--}return false})})
</script>
<h3>&lt;Directory&gt;</h3>
<fieldset>
	Die meisten Einstellungen in der httpd.conf, die das Verhalten der veröffentlichten Website betreffen, sind Verzeichnisoptionen. &lt;Directory&gt; ... &lt;/Directory&gt; ist der wichtigste der entsprechenden Container.<br>
    <b>Hinweis:</b> Damit die Direktiven übernommen werden, müssen Sie die Konfiguration des Apache2 neuladen. Das können Sie <a href="?p=apache&s=control">hier</a> tun.
</fieldset>
<div class="zweidrittel-box">
	<fieldset>
	<legend>Neu</legend>
	<form action="?p=apache&s=directorys" method="post">
		<p>
            <label>Kommentar:</label> 
            <input type="text" class="text-long" name="comment" placeholder="optional">
            <a href="#" class="tooltip3"><i class="icon-help-circled" style="font-size:15px"></i>
                <span><b>Info:</b><br>Wird als #Kommentar hinzugefügt über dem Container eingefügt.</span>
            </a>
        </p>
        <p>
            <label>Verzeichnispfad:</label> 
            <input type="text" class="text-long" name="path" placeholder="" required>
            <a href="#" class="tooltip3"><i class="icon-help-circled" style="font-size:15px"></i>
                <span><b>Info:</b><br></span>
            </a>
        </p>
        <div id="variable" style="margin-bottom:25px;">
        <p>
            <label>Direktive:</label> 
            <input type="text" class="text-long" name="options[]" placeholder="" id="option">
            <a href="#" class="tooltip3"><i class="icon-help-circled" style="font-size:15px"></i>
                <span><b>Info:</b><br>Wird als Kommentar hinzugefügt in der ersten Zeile des Containers eingefügt.</span>
            </a>
        </p>
        <a href="#" id="onemore" class="button black"><i class="icon-plus-squared"></i> weitere Direktive hinzufügen</a>
        <br><br>
        </div>
        <input type="submit" value="Eintragen" name="go" class="button black">
	</form>
</fieldset>
</div>
<div class="zweidrittel-box lastbox">
</div>
<fieldset>
    <legend>Konfiguration einbinden</legend>
    <p>Damit diese Direktiven in die Apache2-Konfigurationen eingebunden werden muss die Datei "<code>sas-dd.conf</code>" in der Konfigurationsdatei "<code>apache2.conf</code>" eingebunden sein.</p>
    <b>Status:</b><br>
<?php if ($cfstatus): ?>
    Datei ist eingebunden.
<?php else: ?>
    Datei ist nicht eingebunden.
    <hr>
    <p>Klicken Sie jetzt auf "einbinden" um die Datei "<code>sas-dd.conf</code>" einzubinden. Anschließend werden die  Apache2-Konfiguration neugeladen.</p>
    <form action="?p=apache&s=directorys" method="post">
        <input type="submit" name="insertinc" value="einbinden" class="button green">
    </form>
<?php endif; ?>    
</fieldset>
<div class="clearfix"></div>
<fieldset>
    <legend>Informationen</legend>
    <a href="http://httpd.apache.org/docs/2.2/de/mod/core.html#directory" target="_blank">Hier</a> finden Sie weitere Informationen
</fieldset>
