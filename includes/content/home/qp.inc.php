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

// Skript Funktionsfähig .. bis auf den ProFTPD-Server Start (Fehler unbekannt...)

//stelle SSH Verbindung her...
$ssh->openConnection();

if (isset($_POST['a2-stop']) && isset($_POST['a2-stop-h']))     //wenn hidden+submit ..
    $ssh->execute("service apache2 stop");      //.. führe das aus
if (isset($_POST['a2-start']) && isset($_POST['a2-start-h']))
    $ssh->execute("service apache2 start");
if (isset($_POST['postfix-stop']) && isset($_POST['postfix-stop-h'])) 
    $ssh->execute("service postfix stop");
if (isset($_POST['postfix-start']) && isset($_POST['postfix-start-h']))
    $ssh->execute("service postfix start");
if (isset($_POST['proftpd-stop']) && isset($_POST['proftpd-stop-h']))
    $ssh->execute("service proftpd stop");
if (isset($_POST['proftpd-start']) && isset($_POST['proftpd-start-h']))
    $ssh->execute("service proftpd start");
if (isset($_POST['mysql-stop']) && isset($_POST['mysql-stop-h']))
    $ssh->execute("service mysql stop");
if (isset($_POST['mysql-start']) && isset($_POST['mysql-start-h']))
    $ssh->execute("service mysql start");
if (isset($_POST['smbd-stop']) && isset($_POST['smbd-stop-h']))
    $ssh->execute("service smbd stop");    
if (isset($_POST['smbd-start']) && isset($_POST['smbd-start-h']))
    $ssh->execute("service smbd start");
//if (isset($_POST['']) && isset($_POST[''])) {
// $ssh->execute("");
//}
?>
<h3>Quickpanel</h3>
<fieldset>
    <div class="fuenftel-box boxcenter">
        <h5>Apache2</h5>
        <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
<?php
echo ($server->getServiceStatus($ssh, 'apache2')) ? '<input type="hidden" name="a2-stop-h"><input type="submit" name="a2-stop" value="Stop" class="button pink">' : '<input type="hidden" name="a2-start-h"><input type="submit" name="a2-start" value="Start" class="button green">';
?>
        </form>
    </div>
    <div class="fuenftel-box boxcenter">
        <h5>Postfix</h5>
        <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
<?php
echo ($server->getServiceStatus($ssh, 'postfix')) ? '<input type="hidden" name="postfix-stop-h"><input type="submit" name="postfix-stop" value="Stop" class="button pink">' : '<input type="hidden" name="postfix-start-h"><input type="submit" name="postfix-start" value="Start" class="button green">';
?>
        </form>
    </div>
    <div class="fuenftel-box boxcenter">
        <h5>FTP</h5>
        <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
<?php
echo ($server->getProFTPDStatus($ssh)) ? '<input type="hidden" name="proftpd-stop-h"><input type="submit" name="proftpd-stop" value="Stop" class="button pink">' : '<input type="hidden" name="proftpd-start-h"><input type="submit" name="proftpd-start" value="Start" class="button green">';
?>
        </form>
    </div>
    <div class="fuenftel-box boxcenter">
        <h5>MySQL</h5>
        <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
<?php
echo ($server->getServiceStatus($ssh, 'mysql')) ? '<input type="hidden" name="mysql-stop-h"><input type="submit" name="mysql-stop" value="Stop" class="button pink">' : '<input type="hidden" name="mysql-start-h"><input type="submit" name="mysql-start" value="Start" class="button green">';
?>
        </form>
    </div>
    <div class="fuenftel-box boxcenter lastbox">
        <h5>Samba</h5>
        <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
<?php
echo ($server->getServiceStatus($ssh, 'smbd')) ? '<input type="hidden" name="smbd-stop-h"><input type="submit" name="smbd-stop" value="Stop" class="button pink">' : '<input type="hidden" name="smbd-start-h"><input type="submit" name="smbd-start" value="Start" class="button green">';
?>
        </form>
    </div>
</fieldset>

<hr>

<!--Weitere Shortcuts folgen bald. -->
