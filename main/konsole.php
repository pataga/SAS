<?php
    include 'inc/html/top.inc.php';
    include 'libs/Net/SSH2.php';

    if (isset($_POST['output']))
        $output = $_POST['output'];
    else
        $output = "root@server:";

    if (isset($_POST['command']))
    {
        $ssh = new Net_SSH2($_SESSION['server_ip']);
        $ssh->login($_SESSION['server_user'],$_SESSION['server_pass']);
        $output .= $ssh->exec($_POST['command']);
    }
?>

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
            <form action="konsole.php" class="jNice">
                <h3>Konsole</h3>
                <fieldset>

                    <label>Befehl ausf&uuml;hren:</label>
                    <input type="text" class="text-long" />
                    <input type="submit" value="Befehl ausf&uuml;hren" />
                    <br> <br> <br> 
                    <label>Konsolenausgabe:</label>
                    <textarea id="console" readonly="readonly"><?=$output?></textarea>

                </fieldset>
            </form>
        </div>
        <!-- // #main -->
    </div>
</div>
<?php include 'inc/html/footer.inc.php'; ?>
