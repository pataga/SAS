<?php

/**
*
* Minecraft Server Plugin für SAS (https://github.com/pataga/SAS)
*
* @link https://github.com/GabrielWanzek/sas-mc-plugin
* @license MIT License
* @author @GabrielWanzek
*
*/
$server = \Classes\Main::Server();
if (isset($_POST['dl'])) {
	$dlcmd = "mkdir -p /var/bukkit/ && cd /var/bukkit/ && wget -snd ".$_POST['dllink'];	
}

$script = "#!/bin/sh\n
 BINDIR=$(dirname \"$(readlink -fn \"$0\")\")\n
 cd \"\$BINDIR\"\n
 java -Xms1024M -Xmx1024M -jar craftbukkit.jar true\n";


?>
<h3>Minecraft-Plugin</h3>
<fieldset>
	<legend>Installation</legend>
	<div class="halbe-box">	
		<form action="?p=plugins&s=show&id=2" method="post">
			<p>
				Hiermit können Sie die aktuellste Bukkit.jar herunterladen. Diese wird unter <code>/var/bukkit/</code> gespeichert. 
				Wenn Sie eine ältere Version möchten, können Sie diese als Downloadlink angeben. Sollte die Datei vorhanden sein, wird diese überschrieben.
			</p>
			<p>
				<b>bukkit.jar Download-Link</b> (alternativ ändern):<br>
				<input type="text" class="text-long" name="dllink" value="http://dl.bukkit.org/latest-rb/craftbukkit.jar">
			</p>
			<br>
				<input type="submit" name="dl" value="Herunterladen" class="button black">
		</form>
	</div>
	<div class="halbe-box lastbox">
		<form action="?p=plugin&s=###" method="post">
			<p>
				Damit der Bukkit gestartet werden kann, muss ein Startskript her. Dieses wird hiermit automatisch erstellt.
				Sollte es bereits existieren, wird es hiermit überschrieben.
			</p>
			<p>
				<b>Arbeitsspeicher für Java (in MB)<br>
				<input type="text" class="text-small" name="dllink" value="1024">
			</p>
			<p style="line-height:1.2;"><input type="checkbox" name="" id=""> Online Mode?
				<a href="#" class="tooltip"><i class="icon-help-circled"></i>
                        <span style="width:400px;font-weight:400;">
                            <b>Gesetzt:</b><br>
                            Aktiviert. Server nimmt an, dass eine Internetverbindung besteht und vergleicht jeden verbundenen Spieler mit der Datenbank von Minecraft.<br>
                            <b>Nicht gesetzt:</b><br>
                            Deaktiviert. Der Server vergleicht verbindene Spieler nicht mit der Datenbank. (Ohne Minecraft-Account auf Server)
                        </span></a>
                    </p>
			<input type="submit" name="script" value="Script erstellen" class="button black">
			
		</form>
	</div>
	<div class="clearfix"></div>
</fieldset>