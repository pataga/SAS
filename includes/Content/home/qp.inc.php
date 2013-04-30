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
$out = "";
$service = $server->serviceStatus();
if (isset($_POST['a2-stop']))
    $out = $server->execute("service apache2 stop");
if (isset($_POST['a2-start']))
    $out = $server->execute("service apache2 start");

if (isset($_POST['proftpd-stop']))
    $out = $server->execute("service proftpd stop");
if (isset($_POST['proftpd-start']))
    $out = $server->execute("service proftpd start");

if (isset($_POST['mysql-stop']))
    $out = $server->execute("service mysql stop");
if (isset($_POST['mysql-start']))
    $out = $server->execute("service mysql start");

if (isset($_POST['smbd-stop']))
    $out = $server->execute("service smbd stop");    
if (isset($_POST['smbd-start']))
    $out = $server->execute("service smbd start");
?>
<h3>Quickpanel</h3>
<?php if (isset($_POST['action'])): ?>
    <span class="info">
        <img src="./img/load.gif" style="float:right;width:24px;height:24px;padding:7px;" >Aktion wird ausgeführt. Einen Moment bitte...
        <hr>
<pre class="simple">
<?=$out?>
</pre>
    </span>
    <script>setTimeout('window.location.href="?p=home&s=qp"', 2500)</script>
<?php endif; ?>
<fieldset>
<p>Hier können Sie ihren Dienste sofort starten/stoppen bzw. neustarten.</p>
    <div class="clearfix"></div>
    <div class="viertel-box boxcenter">
        <h5>Apache2</h5>
        <form action="?p=home&s=qp" method="post">
<?php
echo ($service['apache']) ? '<input type="hidden" name="action"><input type="submit" name="a2-stop" value="Stop" class="button pink">' : '<input type="hidden" name="action"><input type="submit" name="a2-start" value="Start" class="button green">';
?>
        </form>
    </div>
    <div class="viertel-box boxcenter">
        <h5>FTP</h5>
        <form action="?p=home&s=qp" method="post">
<?php
echo ($service['ftp']) ? '<input type="hidden" name="action"><input type="submit" name="proftpd-stop" value="Stop" class="button pink">' : '<input type="hidden" name="action"><input type="submit" name="proftpd-start" value="Start" class="button green">';
?>
        </form>
    </div>
    <div class="viertel-box boxcenter">
        <h5>MySQL</h5>
        <form action="?p=home&s=qp" method="post">
<?php
echo ($service['mysql']) ? '<input type="hidden" name="action"><input type="submit" name="mysql-stop" value="Stop" class="button pink">' : '<input type="hidden" name="action"><input type="submit" name="mysql-start" value="Start" class="button green">';
?>
        </form>
    </div>
    <div class="viertel-box boxcenter lastbox">
        <h5>Samba</h5>
        <form action="?p=home&s=qp" method="post">
<?php
echo ($service['samba']) ? '<input type="hidden" name="action"><input type="submit" name="smbd-stop" value="Stop" class="button pink">' : '<input type="hidden" name="action"><input type="submit" name="smbd-start" value="Start" class="button green">';
?>
        </form>
    </div>
</fieldset>