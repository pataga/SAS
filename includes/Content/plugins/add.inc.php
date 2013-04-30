<?php

/**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
* @author Patrick Farnkopf
*
*/

if (isset($_POST['url'])) {
    \Classes\Plugin::install($_POST['url']);
}
?>
<br>
<fieldset>
    <legend>Plugin installieren</legend>
    <label>Git URL:</label>
    <form action="?p=plugins&s=add" method="post">
        <input type="text" class="text-long" name="url">
        <input type="submit" class="button black" name="install" value="installieren">
    </form>
</fieldset>
