<?php
    $ssh->openConnection();
    $uptime .= $ssh->execute("uptime");
    $kernelversion .= $ssh->execute("cat /proc/version");
    $hostname .= $ssh->execute("hostname -a");
    // $uptime .= $ssh->execute(uptime);
    // $uptime .= $ssh->execute(uptime);
    // $uptime .= $ssh->execute(uptime);
    $uptimepart = explode("load average:",$uptime);
    $serverload = $uptimepart[1];
//----------------------------------------------
    $uptimetmp1 = explode("up",$uptime);
    $uptimetmp2 = $uptimetmp1[1];
    $uptimetmp3 = explode(", ",$uptimetmp2);
    $uptimetmp4 = $uptimetmp3[0].$uptimetmp3[1];
    $find = array();
    $find[0] = "days";
    $find[1] = "min";
    $find[2] = "day";
    $replace = array();
    $replace[0] = "Tagen";
    $replace[1] = "Minuten";
    $replace[2] = "Tag";
    $serveruptime = str_replace($find, $replace, $uptimetmp4);
//----------------------------------------------

?>
<fieldset>
    <?php print_r($uptimetmp3); ?>
</fieldset>
<h3>Serverübersicht</h3>
<fieldset>
	<h5>Aktuelle Daten ihres Servers</h5>
	 <div class="halbe-box">
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
							<td><?php echo $kernelversion; ?></td>
                        </tr>
                        <tr class="odd">
                            <td>Server online seit:</td>
							<td><?php echo $serveruptime;?></td>
                        </tr>
                        <tr>
                            <td>Letzter Bootvorgang:</td>
							<td>11.11.12 - 21:52:11</td>
                        </tr>
                        <tr class="odd">
                            <td>Eingeloggte User:</td>
							<td>5</td>
                        </tr>
                        <tr class="odd">
                            <td>Load: [<a href="#" class="tooltip">Info
                            	<span>
                            		Load = "Auslastung des Servers"<br>
                            		1. Wert: letzte Minute<br>
                            		2. Wert: letzten 5 Minuten<br>
                            		2. Wert: letzten 15 Minuten<br>
                            	</span>
							</a>]
						</td>
							<td><?php echo $serverload; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="halbe-box lastbox">
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
