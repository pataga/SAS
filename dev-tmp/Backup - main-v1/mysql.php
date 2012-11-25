<?php include 'inc/html/top.inc.php'; ?>
<!-- // #end mainNav -->

<div id="containerHolder">
    <div id="container">
        <div id="sidebar">
            <ul class="sideNav">
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "overview") echo 'class="active"'; ?> href="mysql.php?page=overview">MySQL-Server &Uuml;bersicht</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "config") echo 'class="active"'; ?> href="mysql.php?page=config">Konfiguration</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "control") echo 'class="active"'; ?> href="mysql.php?page=control">Steuerung</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "db") echo 'class="active"'; ?> href="mysql.php?page=db">Datenbanken</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "users") echo 'class="active"'; ?> href="mysql.php?page=users">Benutzer</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "impexp") echo 'class="active"'; ?> href="mysql.php?page=impexp">Im-/Export</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "stats") echo 'class="active"'; ?> href="mysql.php?page=stats">Statistiken</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "sqlcmd") echo 'class="active"'; ?> href="mysql.php?page=sqlcmd">SQL Befehle ausf&uuml;hren</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "phpmyadmin") echo 'class="active"'; ?> href="mysql.php?page=pma">phpMyAdmin</a></li>
            </ul>
            <!-- // .sideNav -->
        </div>    
        <!-- // #sidebar -->
        <h2><a href="mysql.php?page=overview">MySQL-Server</a> &raquo; 
            <?php
            if (isset($_GET['page']) && $_GET['page'] == "overview")
                echo '<a href="mysql.php?page=overview" class="active">&Uuml;bersicht</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "config")
                echo '<a href="mysql.php?page=config" class="active">Konfiguration</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "control")
                echo '<a href="mysql.php?page=control" class="active">Steuerung</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "db")
                echo '<a href="mysql.php?page=db" class="active">Datenbanken</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "users")
                echo '<a href="mysql.php?page=users" class="active">Benutzer</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "impexp")
                echo '<a href="mysql.php?page=impexp" class="active">Im-/Export</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "stats")
                echo '<a href="mysql.php?page=stats" class="active">Statistiken</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "sqlcmd")
                echo '<a href="mysql.php?page=sqlcmd" class="active">SQL Befehle ausf&uuml;hren</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "pma")
                echo '<a href="mysql.php?page=pma" class="active">phpMyAdmin</a>';
            else
                
                ?>
        </h2>
        <div id="main">
            <?php
            if (isset($_GET['page'])) {
                if ($_GET['page'] == "overview")
                    require 'inc/mysql/overview.inc.php';
                else if ($_GET['page'] == "config")
                    require 'inc/mysql/config.inc.php';
                else if ($_GET['page'] == "control")
                    require 'inc/mysql/control.inc.php';
                else if ($_GET['page'] == "db")
                    require 'inc/mysql/db.inc.php';
                else if ($_GET['page'] == "users")
                    require 'inc/mysql/users.inc.php';
                else if ($_GET['page'] == "impexp")
                    require 'inc/mysql/impexp.inc.php';
                else if ($_GET['page'] == "stats")
                    require 'inc/mysql/stats.inc.php';
                else if ($_GET['page'] == "sqlcmd")
                    require 'inc/mysql/sqlcmd.inc.php';
                else if ($_GET['page'] == "pma")
                    require 'inc/mysql/pma.inc.php';
                else
                    echo '<meta http-equiv="refresh" content="0; URL=mysql.php?page=overview">';
            }
            else
                echo '<meta http-equiv="refresh" content="0; URL=mysql.php?page=overview">';
            ?>
        </div>
        <!-- // #main -->
        <?php include 'inc/html/footer.inc.php'; ?>


