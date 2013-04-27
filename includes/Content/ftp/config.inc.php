<?php 

?>
<br><br>
    <form action="index.php?p=ftp&s=config" method="POST">
        <fieldset>
            <legend>Konfiguration</legend>
                <div class="halbe-box">
                    <label>Servertype:</label>
                            <a href="#" class="tooltip3">?
                                <span><b>Info:</b><br>
                                    Hier geben Sie den Servertypen an. MAn unterscheidet hier zwischen Inetd und Standalone. 
                                </span>
                            </a>
                        <input type="text" class="text-long" name="servertype" placeholder="bspw. standalone"><br><br><br>
                    <label>Servername:</label>
                            <a href="#" class="tooltip3">?
                                <span><b>Info:</b><br>
                                   Hier geben Sie den Namen des Servers an. 
                                </span>
                            </a>
                        <input type="text" class="text-long" name="servername"><br><br><br>
                    <label>Umask:</label>
                            <a href="#" class="tooltip3">?
                                <span><b>Info:</b><br>
                                    Mit Umask können Sie Zugriffsrechte für neu erstelle Dateien und Verzeichnisse festlegen.
                                    Zu beachten ist hierbei, dass die Rechtvergabe nicht wie bei den allgemeinen Rechten unter Linux erfolgen.<br><br>
                                    Um die Umask für Dateien zu erstellen muss die gesetzte Rechtemaske von der Zahl 666 abgezogen werden um die Umask zu bestimmen.<br>
                                    Beispielsweise ist die Umask standardmäßig auf 022 gesetzte. Also ist die Umask in diesem fall (666-022) = 644, dass bedeutet das 
                                    der Besitzer Lese- und Schreibrechte besitzt, die Gruppen und Sonstige Benutzer besitzen nur Leserechte.<br>
                                    Die Umask für Verzeichnisse wird nach dem gleichen Prinzip erstellt, nur dass die Maske hierbei von der Zahl 777 abgezogen wird.<br><br>
                                </span>
                            </a>
                        <input type="text" class="text-long" name="umask" placeholder="Standard: 022"><br><br><br>
                    <label>Administrator E-Mail:</label>
                             <a href="#" class="tooltip3">?
                                <span><b>Info:</b><br>
                                   Hier geben Sie die E-Mail Adresse des Server Administrators an. 
                                </span>
                            </a>
                        <input type="text" class="text-long" name="adminmail"><br><br><br>
                    <label>Port:</label>
                             <a href="#" class="tooltip3">?
                                <span><b>Info:</b><br>
                                   Die "Port"-Anweisung gibt an, auf welchen Port der Server im Standalone auf ankommende Verbindung wartet. 
                                </span>
                            </a>
                        <input type="text" class="text-long" name="port" placeholder="Standard: 21"><br><br><br>
                    <label>Wilkommenstext:</label>
                    <input type="radio" name="text" value="an" checked="checked">&nbsp;&nbsp;an
                    <input type="radio" name="text" value="aus">&nbsp;&nbsp;aus<br>
                        <input type="text" class="text-long" name="welcometext" placeholder="absoluter Dateipfad">
                </div>
                <div class="halbe-box lastbox"><br>
                    <select name="IPV">
		                <option value="0">IPV4</option>
		                <option value="1">IPV6</option>
                    </select><br><br>
                </div>

                <div class="viertel-box">
                    Default Root
                        <a href="#" class="tooltip3">?
                                <span><b>Info:</b><br>
                                   
                                </span>
                        </a>
                </div>
                <div class="viertel-box lastbox">
                    <input type="radio" name="dr" value="an" checked="checked">&nbsp;&nbsp;an
                    <input type="radio" name="dr" value="aus">&nbsp;&nbsp;aus
                </div>
        </fieldset>
        <fieldset>
            <legend>Informationen</legend>
                <a href="http://www.proftpd.de/Direktiven.54.0.html" target="_blank">Hier</a> finden Sie Informationen zu sämtlichen Konfigurationsmöglichkeiten.
        </fieldset>
    </form>