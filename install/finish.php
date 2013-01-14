<?php


    /**
    * Licensed under The Apache License
    *
    * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
    * @link https://github.com/pataga/SAS
    * @since SAS v1.0.0
    * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt
    * @author Patrick Farnkopf
    *
    */

    require_once '../includes/config/config.mysql.php';

    mysql_connect($data[0],$data[2],$data[3]) or die(mysql_error());
    mysql_select_db($data[4]) or die(mysql_error());

    $user = isset($_POST['user']) ? $_POST['user'] : "";
    $pass = isset($_POST['pass']) ? $_POST['pass'] : "";
    $passr = isset($_POST['passr']) ? $_POST['passr'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";

    if ($pass == $passr)
    {
        $pass = md5($pass);
        mysql_query("INSERT INTO sas_users (username,password,email,admin) VALUES ('$user','$pass','$email',1)") or die(mysql_error());
    }
    else
    {
        header('Location:step3.php?p=r');
        die();
    }
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
        <div class="logoinstall">
            <h1>Server <span>Admin</span> System</h1>
            <h3>Installation</h3>
        </div>
            <div id="main">
                <div id="box1_install">
                    <fieldset>
                        <p>
                            <h5>Die Installation wurde erfolgreich abgeschlossen!</h5> 
                            Bitte l&ouml;schen Sie nun das "<code>install</code>" Verzeichnis und klicken sie danach auf den "Weiter" Button. <br>Andernfalls werden Sie erneut zur Installation weitergeleitet.</p>
                    </fieldset>
                    <div align="center"><a href=".." class="button black" style="width:300px;">Weiter</a></div>
                </div>
            </div>
    </body>
</html>