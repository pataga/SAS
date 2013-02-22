<?php /**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
* @author Gabriel Wanzek
*
*/
$pini = $server->execute('cat /etc/php5/apache2/php.ini');
$gpv = $server->execute('php -r "echo substr(phpversion(),0,strpos(phpversion(), \"-\"));"');
$ipe = $server->execute("ls -l /etc/apache2/mods-enabled/ | grep load | awk {'print $9'} | grep php");
$ipa = $server->execute("ls -l /etc/apache2/mods-available/ | grep load | awk {'print $9'} | grep php");
// ^^ Das ginge bestimmt auch einfacher, aber das ist mir vorzeitig egal :o)
$gle = $server->execute("php -r \"print_r(get_loaded_extensions());\" | grep = | awk {'print $3'}",1);

if (preg_match('/php5.aload/',$ipe)) {
	$ps = 'Das PHP-Modul ist auf ihrem Webserver aktiviert.';
} else {
	$ps = 'Das PHP-Modul ist auf ihrem Webserver deaktiviert oder wurde nicht gefunden. Sie können das ggf. Modul <a href="?p=apache&s=modules">hier</a> aktivieren. Alternativ muss PHP installiert werden:<br>
	<input type="submit" name="installphp" class="invs" value="PHP installieren"> ';
}

if (isset($_POST['installphp'])) {
	$server->execute('apt-get install php5 -fy');
}
if (isset($_POST['phpini'])) {
	//$server->execute('');
}
?>
<style>textarea.iniedit {width: 560px !important;font: 1em "Ubuntu Mono", monospace !important;color: #000 !important;height: 345px !important; line-height: 1.2; overflow: scroll !important;} textarea.iniedit:focus {background: #fff !important;}
</style>
<h3>PHP</h3>
<div class="halbe-box">
	<fieldset>
		<form action="?p=apache&s=php" method="post">
			<legend>Informationen</legend>
			<h6>Status</h6>
				<?=$ps?><br>
			<h6>Version</h6>
				<?=$gpv?><br>
		</form>
	</fieldset>
</div>
<div class="halbe-box lastbox">
	<fieldset>
		<legend>Aktive PHP-Erweiterungen</legend>
		<div class="a2_module">
		<?=$gle?>
		</div>
	</fieldset>
</div>
<div class="clearfix"></div>
<fieldset>
	<legend>php.ini bearbeiten</legend>
		<form action="?p=apache&s=php" method="post">
		<div class="vierfuenftel-box">
			<textarea name="phpini" class="iniedit" wrap="off"><?=$pini?></textarea>
		</div>
		<div class="fuenftel-box lastbox">	
			<h6>Hilfe</h6>
			Sie können die Datei mit <b>[STRG]+[F]</b> nach Schlüsselbegriffen durchsuchen.<br>
			<br>
			Sollten Sie Hilfe zur Konfiguration benötigen, klicken Sie <a href="http://www.php.net/manual/de/configuration.file.php" target="_blank">hier</a>.
		</div>
		<div class="clearfix"></div>
		<br>
		<input type="submit" value="Speichern" class="button black">
		<br>
	</form>
</fieldset>
