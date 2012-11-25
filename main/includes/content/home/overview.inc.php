<?php
    $ssh->openConnection();
    $load = $ssh->execute("uptime");
    $uptime = $ssh->execute("who -b");
    $userswho = $ssh->execute("users");
    $kernelversion = $ssh->execute("cat /proc/version");
    $sekundentmp = $ssh->execute("cat /proc/uptime");
    $hostname = $ssh->execute("hostname -a");
    $loadpart = explode("load average:",$load);
    $serverload = $loadpart[1];
//----------------------------------------------
    $sekunden0 = explode(".",$sekundentmp);
    $sekunden = $sekunden0[0];
    $serveruptime = (((((((($sekunden-($sekunden%60))/60) - (($sekunden-($sekunden%60))/60)%60)/60)))-(((((($sekunden-($sekunden%60))/60) - (($sekunden-($sekunden%60))/60)%60)/60))%24))/24)." T. ".(((((($sekunden-($sekunden%60))/60) - (($sekunden-($sekunden%60))/60)%60)/60))%24)." Std. ".((($sekunden-($sekunden%60))/60)%60)." Min. ". ($sekunden%60)." Sek. ";
//----------------------------------------------
     $bootdatetmp = str_replace("   ", "", $uptime);
     $bootdate = str_replace("Systemstart", "", $bootdatetmp);
     $userswholi = str_replace(" ", ", ", $userswho);
//----------------------------------------------
?>
<h3>Serverübersicht</h3>
<fieldset>
	<h5>Aktuelle Daten ihres Servers</h5>
	 <div class="zweidrittel-box">
	 <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td>Host-IP:</td>
                            <td><?php echo $data[0];?></td>
                        </tr>
                        <tr class="odd">
							<td>Host-Name:</td>
							<td><?php echo $hostname; ?></td>
                        </tr>
                        <tr>
							<td>Kernel Version:</td>
							<td>
                                <a href="#" class="tooltip">Kernel
                                <span><code><?=$kernelversion; ?></code></span>
                            </a>
                            </td>
                        </tr>
                        <tr class="odd">
                            <td>Server online seit:</td>
							<td><?php echo $serveruptime;?></td>
                        </tr>
                        <tr>
                            <td>Letzter Bootvorgang:</td>
							<td><?php echo $bootdate ?></td>
                        </tr>
                        <tr class="odd">
                            <td>Eingeloggte User:</td>
							<td><?php echo $userswholi ?></td>
                        </tr>
                        <tr class="odd">
                            <td>Load: 
						</td>
							<td><?php echo $serverload; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="drittel-box lastbox">
                		 <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td>Apache 2:</td>
                            <td><span class="aktiv">Aktiv</span></td>
                        </tr>
                        <tr class="odd">
							<td>Postfix:</td>
							<td><span class="inaktiv">Inaktiv</span></td>
                        </tr>
                        <tr>
							<td>FTP:</td>
							<td><span class="aktiv">Aktiv</span></td>
                        </tr>
                        <tr class="odd">
                            <td>MySQL:</td>
							<td><span class="aktiv">Aktiv</span></td>
                        </tr>
                        <tr>
                            <td>Samba:</td>
							<td><span class="inaktiv">Inaktiv</span></td>
                        </tr>
                        <tr>
                            <td>Backups:</td>
							<td><span class="inaktiv">Inaktiv</span></td>
                        </tr>
                        <tr>
                            <td>E-Mail-Reports:</td>
							<td><span class="aktiv">Aktiv</span></td>
                        </tr>
                        <tr>
                            <td>XYZ:</td>
							<td><span class="aktiv">Aktiv</span></td>
                        </tr>
                        <tr>
                            <td>123:</td>
							<td><span class="aktiv">Aktiv</span></td>
                        </tr>
                    </table>
                </div>
	<br><br>
	<hr>

</fieldset>
<h3>Notizbuch</h3>
<fieldset>
	<textarea>
	</textarea>
	<input type="submit" class="button black" value="Notizen speichern">
	<br>
	<br>
	<a href="#">&auml;ltere Notizen</a>
</fieldset>
