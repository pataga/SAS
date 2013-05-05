<?php 


/**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt
* @author Tanja Weiser
*
*/

// Status -> ftpwho
// Version -> proftpd --version
// Benutzer -> 
// Module -> proftpd --list
// Letzte Fehlrmedung -> proftpd -vv
// neustarten -> etc/init.d/proftpd restart

$version = $server->execute('proftpd --version');
$status = $server->execute('service proftpd status');
$seq_users = $server->execute("awk -F: '$3>999{print $1}' /etc/passwd", 2);
$module = $server->execute('proftpd --list',1);
//$module_ = explode("\n", $module);


?>


<br>
	<fieldset>
		<legend>Was ist ProFTPD?</legend>
			Das File Transfer Protocol (FTP) ist ein Dateiübertragungsverfahren.<br>
			Es wird genutzt um Dateien auf einen Server hochzuladen oder um Dateien auf den Client herunterzuladen.<br>
			ProFTPD (Pro File Transfer Protocoll Daemon) ist ein freier FTP-Server, der am häufigsten genutzt wird.
	</fieldset>
		<form action="index.php?p=ftp" method="POST">
	
<div class="halbe-box">
	<fieldset>
		<legend>Version</legend>
			<h5><?=$version?></h5><br>
	</fieldset>
</div>
<div class="halbe-box lastbox">
	<fieldset>
		<legend>Status</legend>
			<h5><?=$status?></h5>
	</fieldset>
</div>

<div class="halbe-box">
	<fieldset>
		<legend>Module</legend>
		<div class="listbox">
        <?php
            
               echo $module."<br>";
           
        ?>
     	 <br>
		</div>
	</fieldset>
</div>
<div class="halbe-box lastbox">
	<fieldset>
		<legend>Benutzer</legend>
<div class="listbox">
        <?php
            foreach ($seq_users as $key => $value) {
                echo $value . "<br>";
            }
        ?>
      <br>
</div>
<br><br><br><br><br><br><br>
    <span class="info">Neue Benutzer für ProFTPD legen Sie <a href="http://localhost/SAS/index.php?p=system&s=usergroups" target="_blank">hier</a> an.</span>
</fieldset>
</div>
