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

if (isset($_GET['id'])) {
    $result = \Classes\Main::MySQL()->Query("SELECT * FROM sas_plugins WHERE id = ".$_GET['id']);
    if ($row = $result->fetch()) {
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
