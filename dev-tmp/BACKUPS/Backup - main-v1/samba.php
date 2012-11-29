<?php include 'inc/html/top.inc.php'; ?>
<!-- // #end mainNav -->

<div id="containerHolder">
    <div id="container">
        <div id="sidebar">
            <ul class="sideNav">
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "overview") echo 'class="active"'; ?> href="samba.php?page=overview">Sambaserver &Uuml;bersicht</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "config") echo 'class="active"'; ?> href="samba.php?page=config">Konfiguration</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "control") echo 'class="active"'; ?> href="samba.php?page=control">Steuerung</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "variables") echo 'class="active"'; ?> href="samba.php?page=variables">Globale Variablen</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "users") echo 'class="active"'; ?> href="samba.php?page=users">Benutzer</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "shares") echo 'class="active"'; ?> href="samba.php?page=shares">Freigaben</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "pw") echo 'class="active"'; ?> href="samba.php?page=pw">Passw&ouml;rter</a></li>
                <li><a <?php //if (isset($_GET['page']) && $_GET['page'] == "#") echo 'class="active"';      ?> href="#">?</a></li>
                <li><a <?php //if (isset($_GET['page']) && $_GET['page'] == "#") echo 'class="active"';      ?> href="#">?</a></li>
                <li><a <?php //if (isset($_GET['page']) && $_GET['page'] == "#") echo 'class="active"';      ?> href="#">?</a></li>
            </ul>
            <!-- // .sideNav -->
        </div>    
        <!-- // #sidebar -->

        <h2><a href="samba.php?page=overview">Samba-Server</a> &raquo; 
            <?php
            if (isset($_GET['page']) && $_GET['page'] == "overview")
                echo '<a href="samba.php?page=overview" class="active">&Uuml;bersicht</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "config")
                echo '<a href="samba.php?page=config" class="active">Konfiguration</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "control")
                echo '<a href="samba.php?page=control" class="active">Steuerung</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "variables")
                echo '<a href="samba.php?page=variables" class="active">Globale Variablen</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "users")
                echo '<a href="samba.php?page=users" class="active">Benutzer</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "shares")
                echo '<a href="samba.php?page=shares" class="active">Freigaben</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "pw")
                echo '<a href="samba.php?page=pw" class="active">Passwörter</a>';
            ?>
        </h2>
        <div id="main">
            <?php
            if (isset($_GET['page'])) {
                if ($_GET['page'] == "overview")
                    require 'inc/samba/overview.inc.php';
                else if ($_GET['page'] == "config")
                    require 'inc/samba/config.inc.php';
                else if ($_GET['page'] == "control")
                    require 'inc/samba/control.inc.php';
                else if ($_GET['page'] == "variables")
                    require 'inc/samba/variables.inc.php';
                else if ($_GET['page'] == "users")
                    require 'inc/samba/users.inc.php';
                else if ($_GET['page'] == "shares")
                    require 'inc/samba/shares.inc.php';
                else if ($_GET['page'] == "pw")
                    require 'inc/samba/pw.inc.php';
                else
                    echo '<meta http-equiv="refresh" content="0; URL=samba.php?page=overview">';
            }
            else
                echo '<meta http-equiv="refresh" content="0; URL=samba.php?page=overview">';
            ?>
        </div>
        <!-- // #main -->
        <?php include 'inc/html/footer.inc.php'; ?>
