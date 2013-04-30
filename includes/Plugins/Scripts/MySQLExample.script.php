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

namespace Plugins\Scripts;

class MySQLExample extends \Classes\Scripting\MySQLScript {
    function OnConnect() {
        //Wird beim Verbinden mit dem MySQL Server aufgerufen
    }

    function OnClose() {
        //Wird beim Trennen der MySQL Server Verbindung aufgerufen
    }

    function OnQueryExecute(&$sql) {
        //Wird aufgerufen bevor ein Query durchgeführt wird.
    }
}

?>
