<?php include 'inc/html/top.inc.php'; ?>
<!-- // #end mainNav -->
<div id="containerHolder">
    <div id="container">
        <div id="sidebar">
            <ul class="sideNav">
                <li><a <?php if ($_GET['page'] == "overview") echo 'class="active"'; ?> href="management.php?page=overview">Server&uuml;bersicht</a></li>
                <li><a <?php if ($_GET['page'] == "masteredit") echo 'class="active"'; ?> href="management.php?page=masteredit">Stammdaten &auml;ndern</a></li>
                <li><a <?php if ($_GET['page'] == "start") echo 'class="active"'; ?> href="management.php?page=start">Starten</a></li>
                <li><a <?php if ($_GET['page'] == "shutdown") echo 'class="active"'; ?> href="management.php?page=shutdown">Herunterfahren</a></li>
                <li><a <?php if ($_GET['page'] == "reboot") echo 'class="active"'; ?> href="management.php?page=reboot">Neustarten</a></li>
                <li><a <?php if ($_GET['page'] == "reset") echo 'class="active"'; ?> href="management.php?page=reset">Zur&uuml;cksetzen</a></li>
                <li><a <?php if ($_GET['page'] == "setup") echo 'class="active"'; ?> href="management.php?page=setup">Image aufspielen</a></li>
                <li><a <?php if ($_GET['page'] == "install") echo 'class="active"'; ?> href="management.php?page=install">Grundinstallation</a></li>
                <li><a <?php if ($_GET['page'] == "destroy") echo 'class="active"'; ?> href="management.php?page=destroy" style="color: rgb(255, 0, 0);">Selbstzerst&ouml;rung</a></li>
            </ul>
            <!-- // .sideNav -->
        </div>    
        <!-- // #sidebar -->

        <h2><a href="management.php?page=overview">Management</a> &raquo; 
            <?php
            if ($_GET['page'] == "overview")
                echo '<a href="management.php?page=overview" class="active">Server&uuml;bersicht</a>';
            else if ($_GET['page'] == "masteredit")
                echo '<a href="management.php?page=masteredit" class="active">Stammdaten &auml;ndern</a>';
            else if ($_GET['page'] == "start")
                echo '<a href="management.php?page=start" class="active">Starten</a>';
            else if ($_GET['page'] == "shutdown")
                echo '<a href="management.php?page=shutdown" class="active">Herunterfahren</a>';
            else if ($_GET['page'] == "reboot")
                echo '<a href="management.php?page=reboot" class="active">Neustarten</a>';
            else if ($_GET['page'] == "reset")
                echo '<a href="management.php?page=reset" class="active">Zur&uuml;cksetzen</a>';
            else if ($_GET['page'] == "setup")
                echo '<a href="management.php?page=setup" class="active">Image aufspielen</a>';
            else if ($_GET['page'] == "install")
                echo '<a href="management.php?page=install" class="active">Grundinstallation</a>';
            else if ($_GET['page'] == "destroy")
                echo '<a href="management.php?page=destroy"  style="color: rgb(255, 0, 0);" class="active">Selbstzerst&ouml;rung</a>';
            ?>
        </h2>
        <div id="main">
            <?php
            if (isset($_GET['page'])) {
                if ($_GET['page'] == "overview")
                    require 'inc/management/overview.inc.php';
                else if ($_GET['page'] == "masteredit")
                    require 'inc/management/masteredit.inc.php';
                else if ($_GET['page'] == "start")
                    require 'inc/management/start.inc.php';
                else if ($_GET['page'] == "shutdown")
                    require 'inc/management/shutdown.inc.php';
                else if ($_GET['page'] == "reboot")
                    require 'inc/management/reboot.inc.php';
                else if ($_GET['page'] == "reset")
                    require 'inc/management/reset.inc.php';
                else if ($_GET['page'] == "setup")
                    require 'inc/management/setup.inc.php';
                else if ($_GET['page'] == "install")
                    require 'inc/management/install.inc.php';
                else if ($_GET['page'] == "destroy")
                    require 'inc/management/destroy.inc.php';
                else
                    echo '<meta http-equiv="refresh" content="0; URL=management.php?page=overview">';
            }
            else
                echo '<meta http-equiv="refresh" content="0; URL=management.php?page=overview">';
            ?>
        </div>
        <!-- // #main -->
        <?php include 'inc/html/footer.inc.php'; ?>
