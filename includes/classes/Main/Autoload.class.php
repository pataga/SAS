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

namespace Main;
abstract class AutoLoad {
    /**
     * Erstellt aus dem übergebenen Namespace den Verzeichnispfad
     * @param String namespace_
     * @return String path
     */
    public static function getFilePath($namespace_) {
        if (empty($namespace_))
            throw new Exception('Variable $namespace_ ist leer! (AutoLoad::getFilePath(String))');
        return './includes/classes/'.str_replace('\\','/',$namespace_).'.class.php';
    }
}