<?php
    session_start();
    if (isset($_SESSION['loggedin']) && !$_SESSION['loggedin'] || !isset($_SESSION['loggedin'])) 
    {
        echo '<meta http-equiv="refresh" content="0; URL=login/">';
        die;
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>SAS - Server Admin System</title>

        <!-- CSS -->
        <link href="style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
        <!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie6.css" /><![endif]-->
        <!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie7.css" /><![endif]-->

        <!-- JavaScripts-->
        <script type="text/javascript" src="style/js/jquery.js"></script>
        <script type="text/javascript" src="style/js/jNice.js"></script>
    </head>

    <body>
        <div id="wrapper">
            <h1>Server <span>Admin</span> System</h1>

            <?php
            $file = $_SERVER["SCRIPT_NAME"];
            $break = Explode('/', $file);
            $pfile = $break[count($break) - 1];
            ?>

            <ul id="mainNav">
                <li><a href="index.php" <?php if (($pfile) == ("index.php")) echo "class='active'"; else " "; ?>>START</a></li> 
                <li><a href="apache.php"<?php if (($pfile) == ("apache.php")) echo "class='active'"; else " "; ?>>APACHE</a></li>
                <li><a href="postfix.php"<?php if (($pfile) == ("postfix.php")) echo "class='active'"; else " "; ?>>POSTFIX</a></li>
                <li><a href="ftp.php"<?php if (($pfile) == ("ftp.php")) echo "class='active'"; else " "; ?>>FTP</a></li>
                <li><a href="mysql.php"<?php if (($pfile) == ("mysql.php")) echo "class='active'"; else " "; ?>>MYSQL</a></li>
                <li><a href="samba.php"<?php if (($pfile) == ("samba.php")) echo "class='active'"; else " "; ?>>SAMBA</a></li>
                <li><a href="management.php"<?php if (($pfile) == ("management.php")) echo "class='active'"; else " "; ?>>MANAGEMENT</a></li>
                <li><a href="webuser.php"<?php if (($pfile) == ("webuser.php")) echo "class='active'"; else " "; ?>>WEBUSER</a></li>	
                <li><a href="tools.php"<?php if (($pfile) == ("tools.php")) echo "class='active'"; else " "; ?>>SERVERTOOLS</a></li>			
                <li class="logout"><a href="#">LOGOUT</a></li>
            </ul>
            <!-- // #end mainNav -->

