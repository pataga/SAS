<?php


/**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt
* @author Patrick Farnkopf
*
*/


if (isset($_POST['console']))
    $output = $_POST['console'];
else {
    $output = "root@server: ";
}
    

if (isset($_POST['command'])) {
    $output .= $server->execute(/*'cd '.$_POST['path'].' && '.*/$_POST['command']);
}
?>

<form action="?p=system&s=console" method="POST">
    <h3>Konsole</h3>
    <fieldset>

        <label>Befehl ausf&uuml;hren:</label>
        <input type="text" name="command" class="text-long" />
        <input type="submit" value="Befehl ausf&uuml;hren" class="button black"/>
        <input type="hidden" name="path" value="<?=$server->execute('pwd')?>">
        <br> <br> <br> 
        <label>Konsolenausgabe:</label>
        <textarea name="console" id="console" readonly="readonly"><?php echo $output; ?></textarea>

    </fieldset>
</form>

