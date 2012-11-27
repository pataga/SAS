<?php
    $content = "<table>";
    $mysql = extension_loaded('mysql') ?
    "<div style='color:green;'>installiert":
    "<div style='color:red;'>nicht installiert"."<div>";

    $ssh2 = extension_loaded('ssh2') ?
    "<div style='color:green;'>installiert":
    "<div style='color:red;'>nicht installiert"."<div>";

    $ftp = extension_loaded('ftp') ?
    "<div style='color:green;'>installiert":
    "<div style='color:red;'>nicht installiert"."<div>";

    $sockets = extension_loaded('sockets') ?
    "<div style='color:green;'>installiert":
    "<div style='color:red;'>nicht installiert"."<div>";
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SAS</title>
        <link rel="stylesheet" href="../css/normalize.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <script src="../js/vendor/modernizr-2.6.1.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.8.2.min.js"><\/script>')</script>
        <script src="../js/plugins.js"></script>
        <script src="../js/main.js"></script>
    </head>
    <body>
        <div class="top">
            <div class="logo" align="center" style="margin-left:180px;width:900px;">
                <h1>&nbsp;&nbsp;&nbsp;&nbsp;Server <span>Admin</span> System Installation</h1>
            </div>
            <div id="main">
                <div id="install">
                    <fieldset>
                        <b>Willkommen in der Installationsroutine von SAS. Bitte beachten sie, dass die unten aufgelisteten PHP Extensions für den vollen Funktionsumfang von SAS ben&ouml;tigt werden.</b>
                    </fieldset>
                    <fieldset>
                        <div align="center">
                            <table>
                                <tr>
                                    <td><h4>Extension</h4></td>
                                    <td><h4>Status</h4></td>
                                </tr>
                                <tr>
                                    <td>MySQL</td>
                                    <td><?=$mysql?></td>
                                </tr>
                                <tr>
                                    <td>LibSSH2</td>
                                    <td><?=$mysql?></td>
                                </tr>
                                <tr>
                                    <td>FTP</td>
                                    <td><?=$mysql?></td>
                                </tr>
                                <tr>
                                    <td>Sockets</td>
                                    <td><?=$mysql?></td>
                                </tr>
                            </table>
                        </div>
                    </fieldset>
                    <div align="center"><a href="step2.php" class="button black" style="width:370px;">Schritt 2</a></div>
                </div>
            </div>
    </body>
</html>
