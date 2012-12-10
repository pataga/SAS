<?
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
?>

<script type="text/javascript">
function nur_zahlen(obj){
obj.value=obj.value.replace(/[^\d]/g,'');
}
</script>


<h3>Apache 2 Konfiguration</h3>
<div class="halbe-box">
    <fieldset>
        <legend>apache2.conf</legend>
        <p>
            <label>Timeout:</label> 
            <input type="text" class="text-long" name="a2_to" placeholder="Voreinstellung: 300" onblur="nur_zahlen(this)" onkeyup="nur_zahlen(this)">
            <a href="#" class="tooltip3">Info
                <span><b>Info:</b><br>Bestimmt die Anzahl Sekunden, bis eine Unterbrechung einer Anfrage gesendet wird</span>
            </a>
        </p>
        <p>
            <label>KeepAlive:</label>
            <select name="a2_ka_value" style="width: 278px;">
                <option value="a2_ka_on">An</option>
                <option value="a2_ka_off">Aus</option>
            </select>&nbsp;&nbsp;&nbsp;
            <a href="#" class="tooltip3">Info
                <span><b>Info:</b><br>legt fest, ob mehr als eine Anfrage pro Verbindung zulässig sind</span>
            </a>
        </p>
        <p>
            <label>MaxKeepAliveRequests:</label> 
            <input type="text" class="text-long" name="a2_to" placeholder="Voreinstellung: 100" onblur="nur_zahlen(this)" onkeyup="nur_zahlen(this)">
            <a href="#" class="tooltip3">Info
                <span><b>Info:</b><br>Zeitspanne in Sekunden, um auf die nächste Abfrage desselben Clients mit derselben Verbindung zu warten</span>
            </a>
        </p>
        <p>
            <label>StartServers:</label> 
            <input type="text" class="text-long" name="a2_to" placeholder="Voreinstellung: 5" onblur="nur_zahlen(this)" onkeyup="nur_zahlen(this)">
            <a href="#" class="tooltip3">Info
                <span><b>Info:</b><br>Anzahl der Server-Prozesse, die zu Beginn des Server-Betriebs gestartet werden</span>
            </a>
        </p>
        <p>
            <label>MinSpareServers:</label> 
            <input type="text" class="text-long" name="a2_to" placeholder="Voreinstellung: 5" onblur="nur_zahlen(this)" onkeyup="nur_zahlen(this)">
            <a href="#" class="tooltip3">Info
                <span><b>Info:</b><br>Minimale Anzahl der unbeschäftigten Kindprozesse des Servers</span>
            </a>
        </p>
        <p>
            <label>MaxSpareServers:</label> 
            <input type="text" class="text-long" name="a2_to" placeholder="Voreinstellung: 10" onblur="nur_zahlen(this)" onkeyup="nur_zahlen(this)">
            <a href="#" class="tooltip3">Info
                <span><b>Info:</b><br>Maximale Anzahl der unbeschäftigten Kindprozesse des Servers</span>
            </a>
        </p>
        <p>
            <label>MaxClients:</label> 
            <input type="text" class="text-long" name="a2_to" placeholder="Voreinstellung: 150" onblur="nur_zahlen(this)" onkeyup="nur_zahlen(this)">
            <a href="#" class="tooltip3">Info
                <span><b>Info:</b><br>Höchstzahl der parallel laufenden Serverprzesse</span>
            </a>
        </p>
        <p>
            <label>MaxRequestsPerChild:</label> 
            <input type="text" class="text-long" name="a2_to" placeholder="Voreinstellung: 0" onblur="nur_zahlen(this)" onkeyup="nur_zahlen(this)">
            <a href="#" class="tooltip3">Info
                <span><b>Info:</b><br>Obergrenze für die Anzahl von Anfragen, die ein einzelner Kindprozess während seines Lebens bearbeitet</span>
            </a>
        </p>

    </fieldset>
</div>
<div class="halbe-box lastbox">
    <fieldset>
        <legend>ports.conf</legend>
        <p>
        	Welche Port(s) sollen vom Apache verwendet werden?
        	<textarea placeholder="Standard: 80"></textarea>
        	<div class="clearfix"></div>
        	Nur einen Port Pro Zeile!
        </p>
    </fieldset>
</div>