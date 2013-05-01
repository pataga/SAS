<?php

/**
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.1.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
 * @author Patrick Farnkopf
 *
 */

if (isset($_POST['del'])) {
    \Classes\Plugin::remove($_GET['id']);
    header('Location: ?p=plugins');
    exit;
}

if (isset($_POST['update'])) {
    $result = \Classes\Main::MySQL()->Query("SELECT * FROM sas_plugins WHERE id = ".$_GET['id']);
    if ($row = $result->fetch()) {
        \Classes\Plugin::install($row->repo);
        header('Location: ?p=plugins');
        exit;
    }
}

if (isset($_GET['id'])) {
    $result = \Classes\Main::MySQL()->Query("SELECT * FROM sas_plugins WHERE id = ".$_GET['id']);
    if ($row = $result->fetch()) {
        ?>
        <h2><?=$row->name?></h2>
        <fieldset>
            <legend>Plugin Operationen</legend>
            <form action="?p=plugins&s=show&id=<?= $row->id ?>" method="post">
                <input class="button pink" type="submit" name="del" value="Plugin entfernen"/>
                <input class="button green" type="submit" name="update" value="Plugin aktualisieren"/>
            </form>
        </fieldset>
        <br>
        <?php
        if (file_exists('./includes/Plugins/Content/'.$row->name.'/'.$row->content))
            require_once './includes/Plugins/Content/'.$row->name.'/'.$row->content;
        else
            echo '<fieldset><span class="error">Plugin Seite wurde nicht gefunden</span></fieldset>';
    } else {
        echo '<fieldset><span class="error">Plugin Seite wurde nicht gefunden</span></fieldset>';
    }
} else {
    echo '<fieldset><span class="error">Plugin Seite wurde nicht gefunden</span></fieldset>';
}

?>
