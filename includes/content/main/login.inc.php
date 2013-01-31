<?php
    if (is_dir('install') && !isset($data)) {
        header('Location: install');
        exit;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SAS | Login</title>
        <link rel="stylesheet" href="./css/login.css">
        <link rel="shortcut icon" href="./img/fav.ico">
        <script src="./js/vendor/modernizr-2.6.1.min.js"></script>
    </head>
    <!--[if IE]>
<script type="text/javascript">
alert ('Bitte nutzen Sie einen modernen Browser, wie etwa:\n\nGoogle Chrome oder Safari.\nDanke!');
</script>
<![endif]-->
    <body>
        <noscript>
            <div id="nojsactive">
               <p>Um ein besseres Nutzererlebnis im Server Admin System zu haben, <a href="http://www.enable-javascript.com/de/">aktiviere bitte JavaScript</a> in deinem Browser.</p>
            </div>
        </noscript>
        <div class="ribbon">
            <a href="https://github.com/pataga/SAS">Star us on GitHub</a>
        </div>
        <div class="logo">
            <h1>Server <span>Admin</span> System</h1>
        </div>
        <div class="box">
            <p>Bitte loggen Sie sich mit ihren Benutzerdaten ein.</p>
            <form action="" method="post">
                <input type="text" name="username" placeholder="Benutzername" tabindex="1" required autofocus="autofocus" autocomplete="off"><br>
                <input type="password" name="password" placeholder="Passwort" tabindex="2" required><br>
                <input type="submit" value="Login" tabindex="3" class="button black"><br>
            </form>
        </div>
        <p class="footer">&copy; <?php echo date("Y");?> SAS - Server Admin System
            <br>
            <a onclick="alert(unescape('Diese Seite ist vor%FCbergehend nicht erreichbar.'))" href="#">Patrick Farnkopf</a>
            <a onclick="alert(unescape('Diese Seite ist vor%FCbergehend nicht erreichbar.'))" href="#">Tanja Weiser</a>
            <a class="last" href="http://mangopix.de" target="_blank">Gabriel Wanzek</a>
        </p>
    </body>
</html>