<?php

?>

<h3>Netzwerk-Tools</h3>
<div class="zweidrittel-box">
<fieldset>
	<legend>Tool auswählen</legend>
	Welche Aktion möchten Sie durchführen?
	<form action="index.php?p=tools&s=nettools" method="get">
		<input type="radio" name="net" value="ping">
		<label class="inline" for="ping">Ping</label>
		<br>
		<input type="radio" name="net" value="tr">
		<label class="inline" for="traceroute">Traceroute</label>
		<br>
		<input type="radio" name="net" value="whois">
		<label class="inline" for="whois">Whois</label>
		<br>
		<input type="radio" name="net" value="ifc">
		<label class="inline" for="ifc">Netzwerkkonfiguration anzeigen</label>
		<br>
		<input type="radio" name="net" value="my">
		<label class="inline" for="me">Meine Daten anzeigen lassen</label>
		<br>
		<p>Anzahl:<br> <input type="number" name="n" id="" min="1" step="1" max="30" required>
			<a href="#" class="tooltip">Info<span>Anzahl der Pings.<br>Muss angegeben werden.</span></a></p>
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
