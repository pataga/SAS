<?php


/**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
* @author Patrick Farnkopf
*
*/


$content = "<table>";
$mysql = extension_loaded('mysql') ?
        "<span class='aktiv'>installiert" :
        "<span class='inaktiv'>nicht installiert" . "</span>";

$ssh2 = extension_loaded('ssh2') ?
        "<span class='aktiv'>installiert" :
        "<span class='inaktiv'>nicht installiert" . "</span>";

$ftp = extension_loaded('ftp') ?
        "<span class='aktiv'>installiert" :
        "<span class='inaktiv'>nicht installiert" . "</span>";

$sockets = extension_loaded('sockets') ?
        "<span class='aktiv'>installiert" :
        "<span class='inaktiv'>nicht installiert" . "</span>";
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
        <link rel="stylesheet" href="./css/normalize.min.css">
        <link rel="stylesheet" href="./css/main.css">
        <script src="js/vendor/modernizr-2.6.1.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.8.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </head>
    <body>
        <div id="main">
            <div class="logoinstall">
                <h1>Server <span>Admin</span> System</h1>
                <h3>Installation</h3>
            </div>
            <div id="box1_install">
                <fieldset>
                    <b>Willkommen in der Installationsroutine von SAS.</b> <br>Bitte beachten sie, dass die unten aufgelisteten PHP Extensions für den vollen Funktionsumfang von SAS ben&ouml;tigt werden.
                </fieldset>
                <div id="box2_install">
                    <table style="width:400px;">
                        <tr>
                            <td><h5>Extension</h5></td>
                            <td><h5>Status</h5></td>
                        </tr>
                        <tr>
                            <td>MySQL</td>
                            <td><?= $mysql ?></td>
                        </tr>
                        <tr>
                            <td>LibSSH2</td>
                            <td><?= $ssh2 ?></td>
                        </tr>
                        <tr>
                            <td>FTP</td>
                            <td><?= $ftp ?></td>
                        </tr>
                        <tr>
                            <td>Sockets</td>
                            <td><?= $sockets ?></td>
                        </tr>
                    </table>
                </div>
                <div id="installbutton"><a href="?install=2" class="button black">Schritt 2</a></div>
            </div>    
        </div>
    </body>
</html>
