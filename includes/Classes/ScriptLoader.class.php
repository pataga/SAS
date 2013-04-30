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

namespace Classes;

class ScriptLoader {

    const TYPE_MYSQL    = 1;
    const TYPE_USER     = 2;

    public static $mysqlScripts = [];
    public static $userScripts = [];

    public static function loadMySQLScripts() {
        self::$mysqlScripts = [
            //Hier die MySQL Scripts registrieren
            new \Plugins\Scripts\MySQLExample(),
        ];
    }

    public static function loadUserScripts() {
        self::$userScripts = [
            //Hier die User Scripts registrieren
        ];
    }

    public static function loadScriptsFromPlugins() {
        $result = Main::MySQL()
            ->tableAction('sas_plugin_scripts')
            ->select();

        while ($row = $result->fetch()) {
            $script = '\Plugins\Scripts\\'.$row->script;
            switch ($row->type) {
                case ScriptLoader::TYPE_MYSQL:
                    self::$mysqlScripts[] = new $script();
                    break;

                case ScriptLoader::TYPE_USER:
                    self::$userScripts[] = new $script();
                    break;
            }
        }
    }
}

?>
