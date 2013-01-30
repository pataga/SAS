<?php
$url = $_SERVER['REQUEST_URI'];
$exp = explode("/", $url);
$file = end($exp);


?>

<br>
<fieldset>
    <legend>Seite wurde nicht gefunden</legend>
    <img src="img/robot.png" alt="404" style="float:left;">
    <h1>Error 404!</h1>
    <span>Die angegebene Seite <b><?=$file?></b> wurde nicht gefunden!<br><br> Bitte überprüfen Sie die URL.</span>

    <div class="clearfix"></div>

</fieldset>