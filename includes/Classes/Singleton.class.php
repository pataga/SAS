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

namespace Classes;
abstract class Singleton {
    private static $instance = [];

    final public static function getInstance($class) {
        if (!isset(self::$instance[$class])) {
            self::$instance[$class] = new $class();
        }

        return self::$instance[$class];
    }

    final public function __clone() {
        throw new \Exception('Singleton Klassen duerfen nicht geklont werden!', 0xA1);
    }
}

?>
