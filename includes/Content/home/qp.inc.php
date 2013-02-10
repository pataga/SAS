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

if (isset($_POST['a2-stop']))
    $server->execute("service apache2 stop");
if (isset($_POST['a2-start']))
    $server->execute("service apache2 start");

if (isset($_POST['proftpd-stop']))
    $server->execute("service proftpd stop");
if (isset($_POST['proftpd-start']))
    $server->execute("service proftpd start");

if (isset($_POST['mysql-stop']))
    $server->execute("service mysql stop");
if (isset($_POST['mysql-start']))
    $server->execute("service mysql start");

if (isset($_POST['smbd-stop']))
    $server->execute("service smbd stop");    
if (isset($_POST['smbd-start']))
    $server->execute("service smbd start");

?>
<h3>Quickpanel</h3>
<fieldset>
<p>Hier können Sie ihren Dienste sofort starten/stoppen bzw. neustarten.</p>
    <div class="clearfix"></div>
    <div class="viertel-box boxcenter">
        <h5>Apache2</h5>
        <form action="index.php?p=home&s=qp" method="post">
<?php
echo ($server->getServiceStatus('apache2')) ? '<input type="submit" name="a2-stop" value="Stop" class="button pink">' : '<input type="submit" name="a2-start" value="Start" class="button green">';
?>
        </form>
    </div>
    <div class="viertel-box boxcenter">
        <h5>FTP</h5>
        <form action="index.php?p=home&s=qp" method="post">
<?php
echo ($server->getProFTPDStatus()) ? '<input type="submit" name="proftpd-stop" value="Stop" class="button pink">' : '<input type="submit" name="proftpd-start" value="Start" class="button green">';
?>
        </form>
    </div>
    <div class="viertel-box boxcenter">
        <h5>MySQL</h5>
        <form action="index.php?p=home&s=qp" method="post">
<?php
echo ($server->getServiceStatus('mysql')) ? '<input type="submit" name="mysql-stop" value="Stop" class="button pink">' : '<input type="submit" name="mysql-start" value="Start" class="button green">';
?>
        </form>
    </div>
    <div class="viertel-box boxcenter lastbox">
        <h5>Samba</h5>
        <form action="index.php?p=home&s=qp" method="post">
<?php
echo ($server->getServiceStatus('smbd')) ? '<input type="submit" name="smbd-stop" value="Stop" class="button pink">' : '<input type="submit" name="smbd-start" value="Start" class="button green">';
?>
        </form>
    </div>
</fieldset>