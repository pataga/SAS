<?php 

/**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt
* @author Tanja Weiser
*
*/


if (isset($_POST['change'])) {
    $newConf = explode("\n", $_POST['proftpd_config']);
    $server->execute('echo "# SAS-Proftpd Konfig" > /etc/proftpd/proftpd.conf');
    foreach ($newConf as $key => $value) {
        $server->execute('echo "'.$value.'" >> /etc/proftpd/proftpd.conf');
    }
}

?>

<br><br>
    <form action="index.php?p=ftp&s=config" method="POST">
        <fieldset>
            <legend>Konfiguration</legend>
            Hier sehen Sie die Konfgurationsdatei des ProFTPD Dienstes. Hier können Sie allgemeine Einstellungen festlegen und abändern. 
            Beispielsweise wird Ihnen hier die Möglichkeit geboten den Servername zu ändern. Natürlich stehen Ihnen neben
            der Namensänderung noch weiter Konfigurationsmöglicheiten zur Verfügung. Falls Sie keine Erfahrung mit der Konfiguration eines ProFTPD
            Dienstes haben, können Sie den Link nutzen der Ihnen unter "Informationen" angebeben ist.
                   </fieldset>
        
        </fieldset>
            <textarea name="proftpd_config" id="console">
                <?php
                    $datei = $server->execute("cat /etc/proftpd/proftpd.conf");
                    echo $datei;
                ?>
            </textarea>
        <div class="clearfix"></div>
        <br><br>
        <input type="submit" class="button green" name="change" value="speichern"><br><br><br>
        <fieldset>
            <legend>Informationen</legend>
                <a href="http://www.proftpd.de/Direktiven.54.0.html" target="_blank">Hier</a> finden Sie Informationen zu sämtlichen Konfigurationsmöglichkeiten.
        </fieldset>
    </form>