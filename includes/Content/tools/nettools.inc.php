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
if (isset($_POST['net'])) {
    $net = $_POST['net'];
    switch ($net) {
        case 'ping':
            $out = $server->execute("ping ".$_POST['host']." -c 4 -W 5 -v");
            break;
        case 'traceroute':
            $out = $server->execute("traceroute ".$_POST['host']." -w 3 -q 2 -m 15");
            break;
        case 'whois':
            $out = $server->execute("whois ".$_POST['host']." -H ");
            break;
        case 'ifc':
            $out = $server->execute("ifconfig");
            break;
        case 'me':
            $win = true;
            $me = true;
            $out =  "<b>Ihre IP: </b><br>".$_SERVER['REMOTE_ADDR']."<br><br>";
            $out .= "<b>Ihr User-Agent: </b><br>".$_SERVER['HTTP_USER_AGENT']."<br><br>";
            break;
        default:
            $win = true;
            $out = "Keine Ausgabe vorhanden. Bitte führen Sie eine Aktion durch.";
            break;
    }
}
else {
        $win = true;
        $out = "Keine Ausgabe vorhanden. Bitte führen Sie eine Aktion durch.";
    }
if (isset($_POST['installtools'])) {
    $server->execute("apt-get install traceroute whois -fy");
    $out = "Aktion erfolgreich durchgef&uuml;hrt.";
}
?>
<h3>Netzwerk-Tools</h3>
<div class="zweidrittel-box">
<fieldset>
    <legend>Tool auswählen</legend>
    <form action="?p=tools&s=nettools" method="post">
        <select name="net" required>
            <option value="ping">Ping</option>
            <option value="traceroute">Traceroute</option>
            <option value="whois">Whois</option>
            <option value="ifc">Netzwerkkonfiguration anzeigen</option>
            <option value="me">Meine Netz-Daten anzeigen</option>
        </select><br><br>
        <p><b>Host</b> (IP-Adresse oder Domain ohne Protokoll):<br>
        <input type="text" class="text-long" name="host"></p>
        <input type="submit" class="button black" value="Aktion starten" name="go">
    </form>
</fieldset>
</div>
<div class="drittel-box lastbox">
<fieldset>
    <legend>Tools installieren</legend>
    <p>Um Traceroute und Whois zu nutzen, müssen diese Pakete installiert werden. (~100kB)</p>
    <p>Klicken Sie auf den Button um diese Tools zu installieren.</p>
        <form action="index.php?p=tools&s=nettools" method="post">
            <input type="submit" value="Installieren" name="installtools" class="button black">
        </form>
</fieldset>
</div>
<div class="clearfix"></div>
<fieldset>
    <legend>Ausgabe</legend>    
<?php
if(isset($win)) {
    echo '<div id="output"></div>'.$out;
} else {
    echo '<pre>'.$out.'</pre>';
}
?>
</fieldset>
<?php
if(isset($me)) {
    echo'<script type="text/javascript">
me = "<b>Ihr Browser:</b><br> "             + navigator.appName + "<br><br>";
me+= "<b>Browser-CodeName:</b><br> "        + navigator.appCodeName + "<br><br>";
me+= "<b>Ihre Browser Sprache:</b><br> "    + navigator.language + "<br><br>";
me+= "<b>Ihre Browser Version:</b><br> "    + navigator.appVersion + "<br><br>";
me+= "<b>Ihr Betriebssystem:</b><br>  "     + navigator.platform + "<br><br>";
me+= "<b>Browserfenstergröße:</b><br> "      + window.innerWidth + "x" + window.innerHeight + "px<br><br>";
document.getElementById("output").innerHTML=me;     
</script>';
}?>
<span class="show_hide">Hilfe zu den Begriffen</span>
<br>
<div class="spoiler_div"> 
<p><b>PING</b>, steht für "<b>P</b>acket <b>I</b>nter<b>n</b>et <b>G</b>roper", und sendet kleine Datenpakete an einen Zielrechner. Ist der Rechner vefügbar, so kommt eine Antwort zurück. Das Protokoll gibt anschließend aus ob die Daten zurück gekommen sind und wie lang dieser Vorgang gedauert hat.</p>
<p><b>Traceroute</b>, mit diesem Tool kann man den Weg von Datenpaketen verfolgen und sichtbar machen. Somit wird festgestellt durch welche "Stationen" sich ein vom Server gesendetes Datenpaket geht. Zusätzlich werden Informationen ausgegeben, wie: Zeit, Hostname der "Station" und deren IP-Adresse.</p>
<p><b>Whois</b>, ein Dienst, mit dem Informationen über den Inhaber und Administrator einer Domain abgefragt werden können. </p>
</div>