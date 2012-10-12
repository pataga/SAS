<?php include 'inc/html/top.inc.php'; ?>
<!-- // #end mainNav -->

<div id="containerHolder">
    <div id="container">
        <div id="sidebar">
            <ul class="sideNav">
                <li><a <?php if ($_GET['page'] == "overview") echo 'class="active"'; ?> href="apache.php?page=overview">Apache &Uuml;bersicht</a></li>
                <li><a <?php if ($_GET['page'] == "control") echo 'class="active"'; ?> href="apache.php?page=control">Steuerung</a></li>
                <li><a <?php if ($_GET['page'] == "module") echo 'class="active"'; ?> href="apache.php?page=module">Module</a></li>
                <li><a <?php if ($_GET['page'] == "config") echo 'class="active"'; ?> href="apache.php?page=config">Konfiguration</a></li>
                <li><a <?php if ($_GET['page'] == "hostingsys") echo 'class="active"'; ?> href="apache.php?page=hostingsys">Hosting-System</a></li>
                <li><a <?php if ($_GET['page'] == "stats") echo 'class="active"'; ?> href="apache.php?page=stats">Zugriffstatistiken</a></li>
                <li><a <?php //if ($_GET['page'] == "#") echo 'class="active"';   ?> href="#">?</a></li>
                <li><a <?php //if ($_GET['page'] == "#") echo 'class="active"';   ?> href="#">?</a></li>
                <li><a <?php //if ($_GET['page'] == "#") echo 'class="active"';   ?> href="#">?</a></li>
            </ul>
            <!-- // .sideNav -->
        </div>    
        <!-- // #sidebar -->
        <h2><a href="apache.php?page=overview">Apache</a> &raquo; 
            <?php
            if ($_GET['page'] == "overview")
                echo '<a href="apache.php?page=overview" class="active">Apache &Uuml;bersicht</a>';
            else if ($_GET['page'] == "control")
                echo '<a href="apache.php?page=control" class="active">Steuerung</a>';
            else if ($_GET['page'] == "module")
                echo '<a href="apache.php?page=module" class="active">Module</a>';
            else if ($_GET['page'] == "config")
                echo '<a href="apache.php?page=config" class="active">Konfiguration</a>';
            else if ($_GET['page'] == "hostingsys")
                echo '<a href="apache.php?page=hostingsys" class="active">Hosting-System</a>';
            else if ($_GET['page'] == "stats")
                echo '<a href="apache.php?page=stats" class="active">Zugriffstatistiken</a>';
            ?>
        </h2>
        <div id="main">
            <?php
            if (isset($_GET['page'])) {
                if ($_GET['page'] == "overview")
                    require 'inc/apache/overview.inc.php';
                else if ($_GET['page'] == "control")
                    require 'inc/apache/control.inc.php';
                else if ($_GET['page'] == "module")
                    require 'inc/apache/module.inc.php';
                else if ($_GET['page'] == "config")
                    require 'inc/apache/config.inc.php';
                else if ($_GET['page'] == "hostingsys")
                    require 'inc/apache/hostingsys.inc.php';
                else if ($_GET['page'] == "stats")
                    require 'inc/apache/stats.inc.php';
                else
                    echo '<meta http-equiv="refresh" content="0; URL=apache.php?page=overview">';
            }
            else
                echo '<meta http-equiv="refresh" content="0; URL=apache.php?page=overview">';
            ?>    

        </div>
        <!-- // #main -->
        <?php include 'inc/html/footer.inc.php'; ?>