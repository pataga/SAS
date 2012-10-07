<?php
    session_start();
    unset($_SESSION['loggedin']);
    unset($_SESSION['username']);
    unset($_SESSION['id']);
    session_destroy();
    echo '<meta http-equiv="refresh" content="0; URL=login/">';
?>
