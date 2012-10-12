<?php
    include '../../main/conf/config.php';
    
    if (isset($_POST['user']) && isset($_POST['pass']))
    {
        $password = md5($_POST['pass']);
        $username = ($_POST['user']);
        mysql_query("INSERT INTO sas_web_users(username,password) values('$username', '$password')") or die(mysql_error());
    }
            
?>
