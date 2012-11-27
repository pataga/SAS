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
        </div>
        <div id="main">
            <div id="install">
                <fieldset style="width:370px;">
                    <b><p>Zum Speichern verschiedener Daten ben&ouml;tigt SAS eine MySQL Datenbank. Bitte geben sie die Zugangsdaten zu einem MySQL Server sowie den Datenbanknamen an.</p><p>
                    Bitte beachten sie, dass die SAS Installationsroutine alle vorherigen SAS Tabellen &uuml;berschreibt, falls welche vorhanden sein sollten.</p></b>
                </fieldset>
                    
                <form action="step3.php" method="post">
                    <fieldset>
                        <p><label>MySQL Host:</label>
                        <input type="text" name="host" class="text-long" required></p>
                        <p><label>MySQL Port:</label>
                        <input type="text" name="port" class="text-long" required></p>
                        <p><label>MySQL Benutzername:</label>
                        <input type="text" name="user" class="text-long" required></p>
                        <p><label>MySQL Passwort:</label>
                        <input type="password" name="pass" class="text-long" required></p>
                        <p><label>MySQL Datenbank:</label>
                        <input type="text" name="db" class="text-long" required></p>

                        <div align="center"><input type="submit" value="Schritt 3" class="button black" style="width:270px;"></div>
                    </fieldset>
                </form>
            </div>
        </div>
    </body>
</html>
