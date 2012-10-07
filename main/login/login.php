<?php
session_start();

include '../conf/config.php';
include '../classes/class.auth.php';

if (isset($_POST['user']) && isset($_POST['pass']))
    $_SESSION['loggedin'] = AuthChallenge($_POST['user'], $_POST['pass']);

echo '<meta http-equiv="refresh" content="0; URL=../">';
?>