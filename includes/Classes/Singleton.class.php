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
abstract class Singleton {
    private static $instance = [];
    private static $dir;

    final public static function getInstance($class) {
        if (!isset(self::$instance[$class])) {
            self::$instance[$class] = new $class();
        }

        return self::$instance[$class];
    }

    public static function registerSelf($name, $object) {
        self::$instance[$name] = $object;
    }

    public static function setRootDir($dir) {
        self::$dir = $dir;
    }

    public static function getRootDir() {
        return self::$dir;
    }

    final public function __clone() {
        throw new \Exception('Singleton Klassen duerfen nicht geklont werden!', 0xA1);
    }
}

?>
