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

class XMLReader {
    private $content;
    public function __construct($file) {
        if (!file_exists($file)) {
            throw new \Data\Exception("XML Datei nicht gefunden.", 1);
        } else {
            $this->content = file_get_contents($file);
        }
    } 
}

?>