<?php include 'inc/html/top.inc.php'; ?>
<!-- // #end mainNav -->

<div id="containerHolder">
    <div id="container">
        <div id="sidebar">
            <ul class="sideNav">
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "overview") echo 'class="active"'; ?> href="ftp.php?page=overview">FTP-Server &Uuml;bersicht</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "control") echo 'class="active"'; ?> href="ftp.php?page=control">FTP-Server Steuerung</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "config") echo 'class="active"'; ?> href="ftp.php?page=config">Konfiguration</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "users") echo 'class="active"'; ?> href="ftp.php?page=users">FTP-Users</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "directories") echo 'class="active"'; ?> href="ftp.php?page=directories">FTP-Verzeichnisse</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "stats") echo 'class="active"'; ?> href="ftp.php?page=stats">Statistiken</a></li>
                <li><a <?php // if ($_GET['page'] == "#") echo 'class="active"';   ?> href="#">?</a></li>
                <li><a <?php // if ($_GET['page'] == "#") echo 'class="active"';   ?> href="#">?</a></li>
                <li><a <?php // if ($_GET['page'] == "#") echo 'class="active"';   ?> href="#">?</a></li>
            </ul>
            <!-- // .sideNav -->
        </div>    
        <!-- // #sidebar -->
        <h2><a href="ftp.php?page=overview">FTP-Server</a> &raquo; 
            <?php
            if (isset($_GET['page']) && $_GET['page'] == "overview")
                echo '<a href="ftp.php?page=overview" class="active">FTP-Server &Uuml;bersicht</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "control")
                echo '<a href="ftp.php?page=control" class="active">FTP-Server Steuerung</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "config")
                echo '<a href="ftp.php?page=config" class="active">Konfiguration</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "users")
                echo '<a href="ftp.php?page=users" class="active">FTP-Users</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "directories")
                echo '<a href="ftp.php?page=directories" class="active">FTP-Verzeichnisse</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "stats")
                echo '<a href="ftp.php?page=stats" class="active">Statistiken</a>';
            ?>
        </h2>
        <div id="main">
            <?php
            if (isset($_GET['page'])) {
                if ($_GET['page'] == "overview")
                    require 'inc/ftp/overview.inc.php';
                else if ($_GET['page'] == "control")
                    require 'inc/ftp/control.inc.php';
                else if ($_GET['page'] == "config")
                    require 'inc/ftp/config.inc.php';
                else if ($_GET['page'] == "users")
                    require 'inc/ftp/users.inc.php';
                else if ($_GET['page'] == "directories")
                    require 'inc/ftp/directories.inc.php';
                else if ($_GET['page'] == "stats")
                    require 'inc/ftp/stats.inc.php';
                else
                    echo '<meta http-equiv="refresh" content="0; URL=ftp.php?page=overview">';
            }
            else
                echo '<meta http-equiv="refresh" content="0; URL=ftp.php?page=overview">';
            ?>    
        </div>
        <!-- // #main -->
        <?php include 'inc/html/footer.inc.php'; ?>