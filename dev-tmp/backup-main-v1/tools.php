<?php include 'inc/html/top.inc.php'; ?>
<!-- // #end mainNav -->

<div id="containerHolder">
    <div id="container">
        <div id="sidebar">
            <ul class="sideNav">
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "overview") echo 'class="active"'; ?> href="tools.php?page=overview">Tool &Uuml;bersicht</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "stats") echo 'class="active"'; ?> href="tools.php?page=stats">Serverstatistiken</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "cronjobs") echo 'class="active"'; ?> href="tools.php?page=cronjobs">Cronjobs</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "taskmgr") echo 'class="active"'; ?> href="tools.php?page=taskmgr">Taskmanager</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "console") echo 'class="active"'; ?> href="tools.php?page=console">Serverkonsole</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "hddinfo") echo 'class="active"'; ?> href="tools.php?page=hddinfo">Speicherplatz Info</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "cpuload") echo 'class="active"'; ?> href="tools.php?page=cpuload">CPU Auslastung</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "ramload") echo 'class="active"'; ?> href="tools.php?page=ramload">RAM Auslastung</a></li>
                <li><a <?php if (isset($_GET['page']) && $_GET['page'] == "hwinfo") echo 'class="active"'; ?> href="tools.php?page=hwinfo">Hardware Informationen</a></li>

            </ul>
            <!-- // .sideNav -->
        </div>    
        <!-- // #sidebar -->

        <h2><a href="tools.php?page=overview">Servertools</a> &raquo; 
            <?php
            if (isset($_GET['page']) && $_GET['page'] == "overview")
                echo '<a href="tools.php?page=overview" class="active">Tool &Uuml;bersicht</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "stats")
                echo '<a href="tools.php?page=stats" class="active">Serverstatistiken</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "cronjobs")
                echo '<a href="tools.php?page=cronjobs" class="active">Cronjobs</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "taskmgr")
                echo '<a href="tools.php?page=taskmgr" class="active">Taskmanager</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "console")
                echo '<a href="tools.php?page=console" class="active">Serverkonsole</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "hddinfo")
                echo '<a href="tools.php?page=hddinfo" class="active">Speicherplatz Info</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "cpuload")
                echo '<a href="tools.php?page=cpuload" class="active">CPU Auslastung</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "ramload")
                echo '<a href="tools.php?page=ramload" class="active">RAM Auslastung</a>';
            else if (isset($_GET['page']) && $_GET['page'] == "hwinfo")
                echo '<a href="tools.php?page=hwinfo" class="active">Hardware Informationen</a>';
            ?>
        </h2>
        <div id="main">
            <?php
            if (isset($_GET['page'])) {
                if ($_GET['page'] == "overview")
                    require 'inc/tools/overview.inc.php';
                else if ($_GET['page'] == "stats")
                    require 'inc/tools/stats.inc.php';
                else if ($_GET['page'] == "cronjobs")
                    require 'inc/tools/cronjobs.inc.php';
                else if ($_GET['page'] == "taskmgr")
                    require 'inc/tools/taskmgr.inc.php';
                else if ($_GET['page'] == "console")
                    require 'inc/tools/console.inc.php';
                else if ($_GET['page'] == "hddinfo")
                    require 'inc/tools/hddinfo.inc.php';
                else if ($_GET['page'] == "cpuload")
                    require 'inc/tools/cpuload.inc.php';
                else if ($_GET['page'] == "ramload")
                    require 'inc/tools/ramload.inc.php';
                else if ($_GET['page'] == "hwinfo")
                    require 'inc/tools/hwinfo.inc.php';
                else
                    echo '<meta http-equiv="refresh" content="0; URL=tools.php?page=overview">';
            }
            else
                echo '<meta http-equiv="refresh" content="0; URL=tools.php?page=overview">';
            ?>    
</div>
<!-- // #main -->
<?php require 'inc/html/footer.inc.php'; ?>
