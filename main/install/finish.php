<?php
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
        mysql_query("INSERT INTO sas_users (username, password, email) VALUES ('$user','$pass','$email')") or die(mysql_error());
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
        <div class="top">
            <div class="logo" align="center" style="margin-left:180px;width:900px;">
                <h1>&nbsp;&nbsp;&nbsp;&nbsp;Server <span>Admin</span> System Installation</h1>
            </div>
            <div id="main">
                <div id="install">
                    <fieldset>
                        <b>Die Installation wurde erfolgreich abgeschlossen! Bitte l&ouml;schen sie nun das "install" Verzeichnis und klicken sie danach auf den "Weiter" Button.</b>
                    </fieldset>
                    <div align="center"><a href=".." class="button black" style="width:300px;">Weiter</a></div>
                </div>
            </div>
    </body>
</html>