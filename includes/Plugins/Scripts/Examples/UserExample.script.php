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

namespace Scripts;

class UserExample extends \Classes\Scripting\UserScript {
    function OnLogin(\Classes\User $user) {
        //Code wird beim Login ausgeführt
    }

    function OnLogout(\Classes\User $user) {
        //Code wird beim Logout ausgeführt
    }

    function OnRegister(array $data) {
        //Code wird beim Registrieren ausgeführt
    }
}

?>
