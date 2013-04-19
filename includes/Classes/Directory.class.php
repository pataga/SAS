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
class Directory extends \Classes\Singleton {
    private $dirCont, $path;
    public function __construct($path = false) {
        $this->path = $path;
        $this->loadDir();
    }

    private function loadDir() {
        if ($this->path && is_dir($this->path)) {
            $files['dir'] = [];
            $files['file'] = [];
            $dir = scandir($this->path);

            for ($i=0;$i<count($dir);$i++) {
                if (is_dir($dir[$i]))
                    $files['dir'][] = $dir[$i];
                else
                    $files['file'][] = $dir[$i];
            }

            $this->dirCont = $files;
            return true;
        } else return false;
    }

    public function getContent() {
        return $this->dirCont;
    }

    public function getDirs() {
        if (isset($this->dirCont['dir'][0]))
            return $this->dirCont['dir'];
        else
            return false;
    }

    public function getFiles() {
        if (isset($this->dirCont['file'][0]))
            return $this->dirCont['file'];
        else
            return false;
    }

    public function join($path) {
        $this->path = $path;
        return $this->loadDir();
    }

    public static function removeDir($dir, $delAll) {
        if(!$dh = @opendir($dir)) return;
        while (false !== ($obj = readdir($dh))) {
            if($obj=='.' || $obj=='..') continue;
            if (is_dir($dir.'/'.$obj)) self::removeDir($dir.'/'.$obj, true);
            else @unlink($dir.'/'.$obj);
        }

        closedir($dh);
        if ($delAll){
            @rmdir($dir);
        }
    }
}
