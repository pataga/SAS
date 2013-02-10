<?php 
$pini = $server->execute('cat /etc/php5/apache2/php.ini');
$gpv = $server->execute('php -r "echo substr(phpversion(),0,strpos(phpversion(), \"-\"));"');
$ipe = $server->execute("ls -l /etc/apache2/mods-enabled/ | grep load | awk {'print $9'} | grep php"); 
// ^^ Das ginge bestimmt auch einfacher aber das ist mir vorzeitig egal :o)
$gle = $server->execute("php -r \"print_r(get_loaded_extensions());\" | grep = | awk {'print $3'}",1);

if ($ipe == "php5.load" || "php.load") {
	$ps = 'Das PHP-Modul ist auf ihrem Webserver aktiviert.';
} else {
	$ps = 'Das PHP-Modul ist auf ihrem Webserver deaktiviert oder wurde nicht gefunden.';
}
?>
<h3>PHP</h3>
<div class="halbe-box">
	<fieldset>
		<legend>Informationen</legend>
		<h6>Status</h6>
			<?=$ps?><br>
		<h6>Version</h6>
			<code><?=$gpv?></code>
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
	<div class="vierfuenftel-box">
		<style>textarea.iniedit {width: 560px !important;font: 1em "Ubuntu Mono", monospace !important;color: #000 !important;height: 345px !important; line-height: 1.2; overflow: scroll !important;} textarea.iniedit:focus {background: #fff !important;}
		</style>
		<textarea class="iniedit" wrap="off"><?=$pini?></textarea>
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
</fieldset>