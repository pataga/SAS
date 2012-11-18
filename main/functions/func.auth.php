<?php
    function AuthChallenge($login_name, $login_pass)  //Authentifizierungsfunktion mit boolschen Rückgabewert
    {
        $result = mysql_query("SELECT * FROM sas_web_users WHERE username = '$login_name'") or die (mysql_error()); //Holt Datensatz von $username
        
        if (mysql_num_rows($result) > 0) //Wenn Datensatz existiert dann...
        {
            $row = mysql_fetch_object($result); //Macht aus $result ein Objekt
            
            if (md5($login_pass) == $row->password) //Wenn Eingabe Passwort mit dem aus DB übereinstimmt => TRUE
            {
                $_SESSION['username'] = $row->username;
                $_SESSION['id'] = $row->id;
                return true;
            }
            else //Ansonsten false
            {
                session_unset();
                session_destroy();
                return false;
            }
        }
        else //Wenn Datensatz nicht existiert => false
        {
            return false;
        }
    }

    function isLoggedIn()
    {
        if (isset($_SESSION['loggedin']) && !$_SESSION['loggedin'] || !isset($_SESSION['loggedin'])) 
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    function grandAccess()
    {
        if (!isLoggedIn())
        {
            header("Location: login/");
            die;
        }
        //ToDo: Weiterleitung auf Login Page
    }
?>
