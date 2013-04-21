<?php /**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
* @author Gabriel Wanzek
*/
$pini = $server->execute('cat /etc/php5/apache2/php.ini');
$piniarr = parse_ini_string($pini,false);
$gpv = $server->execute('php -r "echo substr(phpversion(),0,strpos(phpversion(), \"-\"));"'); // PHP-Version  (nur Zahlen)
$xgpv = preg_replace(['/No entry for terminal type/', '/using dumb terminal settings./', '/"bash";/'], '', $gpv); //Entferne Fehlermeldungen

$gle = $server->execute("php -r \"print_r(get_loaded_extensions());\" | grep = | awk {'print $3'}",2); //PHP-Extensions in Array laden

$ipe = $server->execute("ls -l /etc/apache2/mods-enabled/ | grep load | awk {'print $9'} | grep php"); //nach aktivem PHP-Modul suchen
$ipa = $server->execute("ls -l /etc/apache2/mods-available/ | grep load | awk {'print $9'} | grep php"); //nach verfügbaren PHP-Modul suchen

//Behandlung für 'aktiv'/'inaktiv'/'nicht installiert'
if (preg_match('/php5.load/',$ipe)) {
	$ps = 'Das PHP5-Modul ist auf ihrem Webserver aktiviert.';
} elseif (preg_match('/php5.load/',$ipa)) {
	$ps = 'Das PHP5-Modul ist auf ihrem Webserver deaktiviert. Sie können das Modul <a href="?p=apache&s=modules">hier</a> aktivieren.';
} else {
	$ps = 'Das PHP5-Modul wurde auf ihrem Webserver nicht gefunden.	<input type="submit" name="installphp" class="invs" value="PHP5 jetzt installieren."> ';
}

//PHP installieren
if (isset($_POST['installphp'])) {
	$server->execute('apt-get install php5 -fy');
}

// php.ini speichern
if (isset($_POST['pinisave'])) {
	$server->execute('echo "'.$_POST['pinidata'].'" >  /etc/php5/apache2/php.ini');
}

// php.ini speichern und apache2 neuladen
if (isset($_POST['pinisave'])) {
	$server->execute('echo "'.$_POST['pinidata'].'" >  /etc/php5/apache2/php.ini && service apache2 reload');
}
?>
<h3>PHP</h3>
<div class="halbe-box">
	<fieldset>
		<form action="?p=apache&s=php" method="post">
			<legend>Informationen</legend>
			<h6>Status</h6>
				<?=$ps?>
				<br>
			<h6>Version</h6>
				<?=$xgpv?>
				<br>
		</form>
	</fieldset>
</div>
<div class="halbe-box lastbox">
	<fieldset>
		<legend>Aktive PHP-Erweiterungen</legend>
		<div class="a2_module">
		<?php
		foreach ($gle as $value) {
			if (preg_match('/No entry for terminal type/', $value) || preg_match('/using dumb terminal settings/', $value)) {
				
			} else {
				echo $value."<br>\n";	
			}			
		}
		?> 
		</div>
	</fieldset>
</div>
<div class="clearfix"></div>
<fieldset>
	<legend>php.ini bearbeiten</legend>
	<p>
		Hier können php.ini-Direktiven bearbeitet werden. Eine Liste mit Beschreibungen und Standard-Werten erhalten Sie <a href="http://www.php.net/manual/de/ini.list.php">hier</a>.<br><i>Damit es übersichtlich bleibt, werden Kommentare nicht angezeigt und verarbeitet.</i>
	</p>
	<form action="?p=apache&s=php" method="post">
<!-- white-space: pre !!! ?-->
<textarea name="pinidata" id="console">
<?php
foreach ($piniarr as $key => $value) {
echo $key." = ".$value."\n";
}
?>
</textarea>
<!-- white-space: pre END ?-->
		<div class="clearfix"></div>
		<br>
		<input type="submit" name="pinisave" class="button green" value="Speichern">
		<input type="submit" name="pinisaverel" class="button orange" value="Speichern und Konfiguration neuladen">
	</form>
</fieldset>
