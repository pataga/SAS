<?php include 'inc/html/top.inc.php'; ?>
<!-- // #end mainNav -->

<div id="containerHolder">
    <div id="container">
        <div id="sidebar">
            <ul class="sideNav">
                <li><a <?php if ($_GET['page'] == "home") echo 'class="active"'; ?> href="index.php?page=home">Home</a></li>
                <li><a <?php if ($_GET['page'] == "overview") echo 'class="active"'; ?> href="index.php?page=overview">System&uuml;bersicht</a></li>
                <li><a <?php if ($_GET['page'] == "panel") echo 'class="active"'; ?> href="index.php?page=panel">QuickPanel</a></li>
                <li><a <?php if ($_GET['page'] == "stats") echo 'class="active"'; ?> href="index.php?page=stats">Serverstatistiken</a></li>
                <li><a <?php if ($_GET['page'] == "doku") echo 'class="active"'; ?> href="index.php?page=doku">Dokumentation</a></li>
                <li><a <?php if ($_GET['page'] == "help") echo 'class="active"'; ?> href="index.php?page=help">Hilfe</a></li>
                <li><a <?php if ($_GET['page'] == "about") echo 'class="active"'; ?> href="index.php?page=about">&Uuml;ber SAS</a></li>
                <li><a <?php // if ($_GET['page'] == "#") echo 'class="active"';    ?> href="#">?</a></li>
                <li><a <?php // if ($_GET['page'] == "#") echo 'class="active"';    ?> href="#">?</a></li>
                <li><a <?php // if ($_GET['page'] == "#") echo 'class="active"';    ?> href="#">?</a></li>
            </ul>
            <!-- // .sideNav -->
        </div>    
        <!-- // #sidebar -->

        <h2><a href="index.php?page=overview">Start</a> &raquo; 
            <?php
            if ($_GET['page'] == "home")
                echo '<a href="index.php?page=home" class="active">Home</a>';
            else if ($_GET['page'] == "overview")
                echo '<a href="index.php?page=overview" class="active">System&uuml;bersicht</a>';
            else if ($_GET['page'] == "panel")
                echo '<a href="index.php?page=panel" class="active">QuickPanel</a>';
            else if ($_GET['page'] == "stats")
                echo '<a href="index.php?page=stats" class="active">Serverstatistiken</a>';
            else if ($_GET['page'] == "doku")
                echo '<a href="index.php?page=doku" class="active">Dokumentation</a>';
            else if ($_GET['page'] == "help")
                echo '<a href="index.php?page=help" class="active">Hilfe</a>';
            else if ($_GET['page'] == "about")
                echo '<a href="index.php?page=about" class="active">&Uuml;ber SAS</a>';
            ?>
        </h2>
        <div id="main">
            <?php
            if (isset($_GET['page'])) {
                if ($_GET['page'] == "home")
                    require 'inc/index/home.inc.php';
                else if ($_GET['page'] == "overview")
                    require 'inc/index/overview.inc.php';
                else if ($_GET['page'] == "panel")
                    require 'inc/index/panel.inc.php';
                else if ($_GET['page'] == "stats")
                    require 'inc/index/stats.inc.php';
                else if ($_GET['page'] == "doku")
                    require 'inc/index/doku.inc.php';
                else if ($_GET['page'] == "help")
                    require 'inc/index/help.inc.php';
                else if ($_GET['page'] == "about")
                    require 'inc/index/about.inc.php';
                else
                    echo '<meta http-equiv="refresh" content="0; URL=index.php?page=home">';
            }
            else
                echo '<meta http-equiv="refresh" content="0; URL=index.php?page=home">';
            ?>
        </div>
        <!-- // #main -->
        <?php include 'inc/html/footer.inc.php'; ?>

