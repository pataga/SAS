<h3>Netzwerk-Tools</h3>
<div class="zweidrittel-box">
<fieldset>
    <legend>Tool auswählen</legend>
    <form action="index.php?p=tools&s=nettools" method="get">
        <p>Host (IP-Adresse oder Domain ohne Protokoll):<br>
        <input type="text" class="text-long" required name="host" autofocus></p>
        <select name="net" required>
            <option value="ping">Ping</option>
            <option value="traceroute">Ping</option>
            <option value="whois">Traceroute</option>
            <option value="ifc">Netzwerkkonfiguration anzeigen</option>
            <option value="me">Meine Netz-Daten anzeigen</option>
        </select><br><br>
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
    <pre>Keine Ausgabe vorhanden. Bitte führen Sie eine Aktion durch.</pre>
</fieldset>


<span class="show_hide">Hilfe zu den Begriffen</span>
<br>
<div class="spoiler_div"> 
<h4>Begriffserklärung</h4>
<ul>
    <li><b>PING</b>, steht für "<b>P</b>acket <b>I</b>nter<b>n</b>et <b>G</b>roper", und sendet kleine Datenpakete an einen Zielrechner. Ist der Rechner vefügbar, so kommt eine Antwort zurück. Das Protokoll gibt anschließend aus ob die Daten zurück gekommen sind und wie lang dieser Vorgang gedauert hat.</li>
    <li><b>Traceroute</b>, mit diesem Tool kann man den Weg von Datenpaketen verfolgen und sichtbar machen. Somit wird festgestellt durch welche "Stationen" sich ein vom Server gesendetes Datenpaket geht. Zusätzlich werden Informationen ausgegeben, wie: Zeit, Hostname der "Station" und deren IP-Adresse.</li>
</div>