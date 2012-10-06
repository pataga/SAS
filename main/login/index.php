<?php 
session_start();
$info = (isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==false) ? '<div align="center"><div class="error">Fehler: Login fehlgeschlagen!</div></div>' : "";
if (isset($_SESSION['loggedin']) && !$_SESSION['loggedin'])
{
    unset($_SESSION['loggedin']);
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
        <h3>Bitte loggen sie sich mit ihren Kundendaten ein.</h3><br>
        <?php echo $info; ?>

        <section class="loginform cf">
            <form name="login" action="login.php" method="post" accept-charset="utf-8">
                <ul>
                    <li>
                        <label for="usermail">E-Mail</label>
                        <input type="email" name="user" placeholder="mustermann@beispiel.de" required>
                    </li>
                    <li>
                        <label for="password">Passwort</label>
                        <input type="password" name="pw" placeholder="Passwort" required></li>
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