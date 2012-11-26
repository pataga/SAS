<?php
    $ssh->openConnection();
?>

<h3>Quickpanel</h3>
<fieldset>
    <div class="fuenftel-box boxcenter">
        <h5>Apache2</h5>
        <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
            <?php
            echo ($server->getServiceStatus($ssh, 'apache2')) ? '<input type="submit" name="a2-stop" value="Stop" class="button pink">' : '<input type="submit" name="a2-start" value="Start" class="button green">';
            ?>
        </form>
    </div>
    <div class="fuenftel-box boxcenter">
        <h5>Postfix</h5>
        <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
            <?php
            echo ($server->getServiceStatus($ssh, 'postfix')) ? '<input type="submit" name="a2-stop" value="Stop" class="button pink">' : '<input type="submit" name="a2-start" value="Start" class="button green">';
            ?>
        </form>
    </div>
    <div class="fuenftel-box boxcenter">
        <h5>FTP</h5>
        <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
            <?php
            echo ($server->getServiceStatus($ssh, 'proftpd')) ? '<input type="submit" name="a2-stop" value="Stop" class="button pink">' : '<input type="submit" name="a2-start" value="Start" class="button green">';
            ?>
        </form>
    </div>
    <div class="fuenftel-box boxcenter">
        <h5>MySQL</h5>
        <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
            <?php
            echo ($server->getServiceStatus($ssh, 'mysql')) ? '<input type="submit" name="a2-stop" value="Stop" class="button pink">' : '<input type="submit" name="a2-start" value="Start" class="button green">';
            ?>
        </form>
    </div>
    <div class="fuenftel-box boxcenter lastbox">
        <h5>Samba</h5>
        <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
            <?php
            echo ($server->getServiceStatus($ssh, 'smbd')) ? '<input type="submit" name="a2-stop" value="Stop" class="button pink">' : '<input type="submit" name="a2-start" value="Start" class="button green">';
            ?>
        </form>
    </div>
</fieldset>
<h3>DangerZone</h3>
<fieldset>
    <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
        <div class="drittel-box">
            <h5>Passwortabfrage</h5>
            <p>Um den Server neuzustarten oder herunterzufahren m&uuml;ssen Sie ihr Passwort eingeben</p>
            <input type="password" name="checkpw-qp" class="text-medlong">
        </div>

        <div class="drittel-box">
            <h5>Server neustarten</h5>
            <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
                <input type="submit" value="neustarten" class="button black">
            </form>
            <br><br>
            <p><b>Information:</b> <br>Diese Aktion kann mehrere Minuten dauern.</p>
        </div>
        <div class="drittel-box lastbox">
            <h5>Server herunterfahren</h5>
            <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
                <input type="submit" value="herunterfahren" class="button black">
            </form>
            <br>
            <p><b>Achtung!</b> <br> SAS kann den Server nicht mehr hochfahren. Diese Funktion muss ihnen ggf. der Provider zur Verf&uuml;gung stellen</p>
        </div>

    </form>
</fieldset>
