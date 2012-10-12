<?php
    include '../../main/conf/config.php';
    
    //   $password = md5($_POST['password']);
    mysql_query("INSERT INTO sas_web_users (username, password) VALUES ('$username','$password'");
?>
