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

namespace Classes\Scripting;

class MySQLScript {

    function OnConnect() { }
    function OnClose() { }
    function OnQueryExecute(&$sql) { }

    public static function _OnConnect() {
        foreach (\Classes\ScriptLoader::$mysqlScripts as $script) {
            $script->OnConnect();
        }
    }

    public static function _OnClose() {
        foreach (\Classes\ScriptLoader::$mysqlScripts as $script) {
            $script->OnClose();
        }
    }

    public static function _OnQueryExecute(&$sql) {
        foreach (\Classes\ScriptLoader::$mysqlScripts as $script) {
            $script->OnQueryExecute($sql);
        }
    }
}

?>
