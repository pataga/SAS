<?php
$ssh->openConnection();

if (isset($_POST['a2-stop']) && isset($_POST['a2-stop-h'])) {
    $ssh->execute("service apache2 stop");
} elseif (isset($_POST['a2-start']) && isset($_POST['a2-start-h'])) {
    $ssh->execute("service apache2 start");
}
if (isset($_POST['postfix-stop']) && isset($_POST['postfix-stop-h'])) {
    $ssh->execute("service postfix stop");
} elseif (isset($_POST['postfix-start']) && isset($_POST['postfix-start-h'])) {
    $ssh->execute("service postfix start");
}
if (isset($_POST['proftpd-stop']) && isset($_POST['proftpd-stop-h'])) {
    $ssh->execute("service proftpd stop");
} elseif (isset($_POST['a2-start']) && isset($_POST['proftpd-start-h'])) {
    $ssh->execute("service proftpd start");
}
if (isset($_POST['mysql-stop']) && isset($_POST['mysql-stop-h'])) {
    $ssh->execute("service mysql stop");
} elseif (isset($_POST['mysql-start']) && isset($_POST['mysql-start-h'])) {
    $ssh->execute("service mysql start");
}
if (isset($_POST['smbd-stop']) && isset($_POST['smbd-stop-h'])) {
    $ssh->execute("service apache2 stop");
} elseif (isset($_POST['smbd-start']) && isset($_POST['smbd-start-h'])) {
    $ssh->execute("service apache2 start");
}

if (isset($_POST['shutdown-s']) && isset($_POST['shutdown'])) {
    //$ssh->execute("shutdown -h now");
    echo "Simulate: Shutdown";
} 

if (isset($_POST['reboot-s']) && isset($_POST['reboot'])) {
   //$ssh->execute("reboot");
echo "Simulate: Reboot";
}

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
            echo ($server->getServiceStatus($ssh, 'proftpd')) ? '<input type="hidden" name="proftpd-stop-h"><input type="submit" name="proftpd-stop" value="Stop" class="button pink">' : '<input type="hidden" name="proftpd-start-h"><input type="submit" name="proftpd-start" value="Start" class="button green">';
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
<h3>DangerZone</h3>
<fieldset>
    <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
        <div class="drittel-box">
            <h5>Sicherheitsabfrage</h5>
            <p>Um den Server neuzustarten oder herunterzufahren m&uuml;ssen Sie zur &Uuml;berprüfung ihren Benutzernamen eingeben:</p>
            <input type="text" name="checker" class="text-medlong">
        </div>

        <div class="drittel-box">
            <h5>Server neustarten</h5>
            <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
                <input type="submit" value="neustarten" name="reboot-s" class="button black">
                <input type="hidden" name="reboot">
            </form>
            <br><br>
            <p><b>Information:</b> <br>Diese Aktion kann mehrere Minuten dauern.</p>
        </div>
        <div class="drittel-box lastbox">
            <h5>Server herunterfahren</h5>
            <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
                <input type="submit" value="herunterfahren" name="shutdown-s" class="button black">
                <input type="hidden" name="shutdown">
            </form>
            <br>
            <p><b>Achtung!</b> <br> SAS kann den Server nicht mehr hochfahren. Diese Funktion muss ihnen ggf. der Provider zur Verf&uuml;gung stellen</p>
        </div>

    </form>
</fieldset>
