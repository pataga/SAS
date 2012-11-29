<?php
$ssh->openConnection();
$load = $ssh->execute("uptime");
$uptime = $ssh->execute("who -b");
$userswho = $ssh->execute("users");
$kernelversion = $ssh->execute("cat /proc/version");
$sekundentmp = $ssh->execute("cat /proc/uptime");
$hostname = $ssh->execute("hostname -a");
$loadpart = explode("load average:", $load);
$serverload = $loadpart[1];
$sekunden0 = explode(".", $sekundentmp);
$sekunden = $sekunden0[0];
$serveruptime = (((((((($sekunden - ($sekunden % 60)) / 60) - (($sekunden - ($sekunden % 60)) / 60) % 60) / 60))) - (((((($sekunden - ($sekunden % 60)) / 60) - (($sekunden - ($sekunden % 60)) / 60) % 60) / 60)) % 24)) / 24) . " T. " . (((((($sekunden - ($sekunden % 60)) / 60) - (($sekunden - ($sekunden % 60)) / 60) % 60) / 60)) % 24) . " Std. " . ((($sekunden - ($sekunden % 60)) / 60) % 60) . " Min. " . ($sekunden % 60) . " Sek. ";
$bootdatetmp = str_replace("   ", "", $uptime);
$bootdate = str_replace("Systemstart", "", $bootdatetmp);
$userswholi = str_replace(" ", ", ", $userswho);
?>

<h3>Serverübersicht</h3>
<fieldset>
    <h5>Aktuelle Daten ihres Servers</h5>
    <div class="halbe-box">
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td>Host-IP:</td>
                <td><a href="http://<?php echo $data[0]; ?>" target="_blank"><?php echo $data[0]; ?></a></td>
            </tr>
            <tr class="odd">
                <td>Host-Name:</td>
                <td><?php echo $hostname; ?></td>
            </tr>
            <tr>
                <td>Kernel Version:</td>
                <td>
                    <a href="#" class="tooltip3">Kernel
                        <span><code class="simple"><?= $kernelversion; ?></code></span>
                    </a>
                </td>
            </tr>
            <tr class="odd">
                <td>Server online seit:</td>
                <td id="test"></td>
            </tr>
            <script>
                var sek=<?php echo $sekunden; ?>;
                function upservtime() {
                    var uppy = ((((((((sek - (sek % 60)) / 60) - ((sek - (sek % 60)) / 60) % 60) / 60))) - ((((((sek - (sek % 60)) / 60) - ((sek - (sek % 60)) / 60) % 60) / 60)) % 24)) / 24) + " T. " + ((((((sek - (sek % 60)) / 60) - ((sek - (sek % 60)) / 60) % 60) / 60)) % 24) + " Std. " + (((sek - (sek % 60)) / 60) % 60) + " Min. " + (sek % 60) + " Sek. ";
                    document.getElementById('test').innerHTML = uppy;  
                    window.setTimeout("upservtime()",1000); 
                    sek++;
                }
                upservtime();
            </script>    
            <tr>
                <td>Letzter Bootvorgang:</td>
                <td><?php echo $bootdate ?></td>
            </tr>
            <tr class="odd">
                <td>Eingeloggte User:</td>
                <td><?php echo $userswholi ?></td>
            </tr>
            <tr class="odd">
                <td>Load:</td>
                <td><?php echo $serverload; ?></td>
            </tr>
        </table>
        <br>
        <a href="<?php $_SERVER['SCRIPT_NAME'] ?>" onclick="location.reload();" class="button white">Aktualisieren</a>
    </div>
    <div class="halbe-box lastbox">
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td>Apache 2:</td>
                <td>
                    <?php
                    echo ($server->getServiceStatus($ssh, 'apache2')) ? '<span class="aktiv">aktiv</span>' : '<span class="inaktiv">inaktiv</span>';
                    ?>
                </td>
            </tr>
            <tr class="odd">
                <td>Postfix:</td>
                <td>
                    <?php
                    echo ($server->getServiceStatus($ssh, 'postfix')) ? '<span class="aktiv">aktiv</span>' : '<span class="inaktiv">inaktiv</span>';
                    ?>
                </td>
            </tr>
            <tr>
                <td>FTP:</td>
                <td>
                    <?php
                    echo ($server->getServiceStatus($ssh, 'proftpd')) ? '<span class="aktiv">aktiv</span>' : '<span class="inaktiv">inaktiv</span>';
                    ?>
                </td>
            </tr>
            <tr class="odd">
                <td>MySQL:</td>
                <td>
                    <?php
                    echo ($server->getServiceStatus($ssh, 'mysql')) ? '<span class="aktiv">aktiv</span>' : '<span class="inaktiv">inaktiv</span>';
                    ?>
                </td>
            </tr>
            <tr>
                <td>Samba:</td>
                <td>
                    <?php
                    echo ($server->getServiceStatus($ssh, 'smbd')) ? '<span class="aktiv">aktiv</span>' : '<span class="inaktiv">inaktiv</span>';
                    ?>
                </td>
            </tr>
            <tr>
                <td>Backups:</td>
                <td>
                    <span class="notaviable">nicht verf&uuml;gbar</span>
                </td>
            </tr>
            <tr>
                <td>E-Mail-Reports:</td>
                <td>
                    <span class="notaviable">nicht verf&uuml;gbar</span>
                </td>
            </tr>
            <tr>
                <td> N/A </td>
                <td>
                    <span class="notaviable">nicht verf&uuml;gbar</span>
                </td>
            </tr>
            <tr>
                <td> N/A </td>
                <td>
                    <span class="notaviable">nicht verf&uuml;gbar</span>
                </td>
            </tr>
        </table>
    </div>
    <br><br>
    <hr>
</fieldset>
<h3>Notizbuch</h3>
<fieldset>
    <form action="<?php echo "test" ?>"></form>
    <textarea name="notizen">Diese Seite ist bis auf das Notizfeld voll funktionsfähig</textarea>
    <input type="submit" class="button black" value="Notizen speichern">
    <br>
    <br>
    <a href="#">&auml;ltere Notizen</a>
</fieldset>
