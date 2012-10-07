<?php 
    session_start();
    $info = (isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==false) ? 
                        '<div align="center"><div class="error">Fehler: Login fehlgeschlagen!</div></div>' : "";

    if (isset($_SESSION['loggedin']) && !$_SESSION['loggedin'])
        unset($_SESSION['loggedin']);

    else if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
    {
        echo '<meta http-equiv="refresh" content="0; URL=../">'; 
        die;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SAS - Login</title>
        <link rel="stylesheet" href="normalize.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <br>
        <h1>Server <span>Admin</span> System</h1>
        <h3>Bitte melden sie sich mit ihren Benutzerdaten an</h3><br>
        <?php echo $info; ?>

        <section class="loginform cf">
            <form name="login" action="login.php" method="post" accept-charset="utf-8">
                <ul>
                    <li>
                        <label for="usermail">E-Mail</label>
                        <input type="text" name="user" placeholder="Benutzername" required>
                    </li>
                    <li>
                        <label for="password">Passwort</label>
                        <input type="password" name="pass" placeholder="Passwort" required></li>
                    <li>
                        <input type="submit" value="Login"><br>
                    </li>
                </ul>
            </form>
            <br><br><br>
            <p><a href="pw.html">Passwort vergessen?</a></p>
        </section>
        <br>
        
   </body>
</html>