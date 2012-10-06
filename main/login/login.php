<?php

session_start();

if (isset($_POST['user']) && isset($_POST['pw'])) {
    mysql_connect("localhost", "root", "");
    mysql_select_db("testphp");
    $result = mysql_query("SELECT * FROM users WHERE user = '" . $_POST['user'] . "'");

    if (mysql_num_rows($result) > 0) {
        $row = mysql_fetch_object($result);

        if ($_POST['pw'] == $row->pw) {
            echo '<meta http-equiv="refresh" content="0; URL=../">';
            $_SESSION['loggedin'] = true;
        } else {
            echo '<meta http-equiv="refresh" content="0; URL=index.php">';
            $_SESSION['loggedin'] = false;
        }
    } else {
        echo '<meta http-equiv="refresh" content="0; URL=index.php">';
        $_SESSION['loggedin'] = false;
    }
} else {
    echo '<meta http-equiv="refresh" content="0; URL=index.php">';
    $_SESSION['loggedin'] = false;
}
?>