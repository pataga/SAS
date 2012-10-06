<?php include 'inc/html/top.inc.php'; ?>
<!-- // #end mainNav -->

<div id="containerHolder">
    <div id="container">
        <div id="sidebar">
            <ul class="sideNav">
                <li><a href="#">Tool &Uuml;bersicht</a></li>
                <li><a href="#">Serverstatistiken</a></li>
                <li><a href="#">Cronjobs</a></li>
                <li><a href="#">Taskmanager</a></li>
                <li><a href="konsole.php" class="active">Serverkonsole</a></li>
                <li><a href="#">Speicherplatz Info</a></li>
                <li><a href="#">CPU Auslastung</a></li>
                <li><a href="#">RAM Auslastung</a></li>
                <li><a href="#">Hardware Informationen</a></li>

            </ul>
            <!-- // .sideNav -->
        </div>    
        <!-- // #sidebar -->

        <!-- h2 stays for breadcrumbs -->
        <h2><a href="tools.php">Servertools</a> &raquo; <a href="#" class="active">Serverkonsole</a></h2>

        <div id="main">
            <form action="" class="jNice">
                <h3>Serverauswahl</h3>
                <fieldset>
                    <label>Server ausw&auml;hlen:</label>
                    <select>
                        <option>Server 1</option>
                        <option>Server 2</option>
                        <option>Server 3</option>
                        <option>Server 4</option>
                        <option>Server 5</option>
                        <option>Server 6</option>
                    </select>
                    <input type="submit" class="submit2" value="Server verwenden" />
                </fieldset>
            </form>
            <form action="" class="jNice">
                <h3>Konsole</h3>
                <fieldset>

                    <label>Befehl ausf&uuml;hren:</label>
                    <input type="text" class="text-long" />
                    <input type="submit" value="Befehl ausf&uuml;hren" />
                    <br> <br> <br> 
                    <label>Konsolenausgabe:</label>
                    <textarea id="console" readonly="readonly">
total 109
drwxr-xr-x  18 root     root         4096 Jun  9 21:12 ./
drwxr-xr-x  18 root     root         4096 Jun  9 21:12 ../
drwxr-xr-x   2 root     root         4096 Jun  9 21:14 bin/
drwxr-xr-x   3 root     root         1024 Jun  9 20:32 boot/
drwxr-xr-x   6 root     root        36864 Jul 12 10:26 dev/
drwxr-xr-x  34 root     root         4096 Jul 12 10:25 etc/

(Beispiel | PHP muss noch eingebunden werden...)
                    </textarea>

                </fieldset>
            </form>
        </div>
        <!-- // #main -->
        <?php include 'inc/html/footer.inc.php'; ?>
