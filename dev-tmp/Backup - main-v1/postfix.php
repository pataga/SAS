<?php include 'inc/html/top.inc.php'; ?>
<!-- // #end mainNav -->

<div id="containerHolder">
    <div id="container">
        <div id="sidebar">
            <ul class="sideNav">
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "overview") echo 'class="active"'; ?> href="postfix.php?page=overview">Postfix &Uuml;bersicht</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "config") echo 'class="active"'; ?> href="postfix.php?page=config">Postfix Konfiguration</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "stats") echo 'class="active"'; ?> href="postfix.php?page=stats">Mail Statistiken</a></li>
                <li><a <?php // if (isset($_GET['page']) && $_GET['page'] == "#") echo 'class="active"';    ?> href="#">?</a></li>
                <li><a <?php // if (isset($_GET['page']) && $_GET['page'] == "#") echo 'class="active"';    ?> href="#">?</a></li>
                <li><a <?php // if (isset($_GET['page']) && $_GET['page'] == "#") echo 'class="active"';    ?> href="#">?</a></li>
                <li><a <?php // if (isset($_GET['page']) && $_GET['page'] == "#") echo 'class="active"';    ?> href="#">?</a></li>
                <li><a <?php // if (isset($_GET['page']) && $_GET['page'] == "#") echo 'class="active"';    ?> href="#">?</a></li>
                <li><a <?php // if (isset($_GET['page']) && $_GET['page'] == "#") echo 'class="active"';    ?> href="#">?</a></li>
            </ul>
            <!-- // .sideNav -->
        </div>    
        <!-- // #sidebar -->

        <h2><a href="postfix.php?page=overview">Postfix</a> &raquo; 
            <?php
            if (isset($_GET['page']) && $_GET['page'] == "overview")
                echo '<a href="postfix.php?page=overview" class="active">&Uuml;bersicht</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "config")
                echo '<a href="postfix.php?page=config" class="active">Konfiguration</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "stats")
                echo '<a href="postfix.php?page=stats" class="active">Mail Statistiken</a>';
            ?>
            </h2>
            <div id="main">
                <?php
                if (isset($_GET['page'])) {
                    if ($_GET['page'] == "overview")
                        require 'inc/postfix/overview.inc.php';
                    else if ($_GET['page'] == "config")
                        require 'inc/postfix/config.inc.php';
                    else if ($_GET['page'] == "stats")
                        require 'inc/postfix/stats.inc.php';
                    else
                        echo '<meta http-equiv="refresh" content="0; URL=postfix.php?page=overview">';
                }
                else
                    echo '<meta http-equiv="refresh" content="0; URL=postfix.php?page=overview">';
                ?>
            </div>
            <!-- // #main -->
            <?php include 'inc/html/footer.inc.php'; ?>

