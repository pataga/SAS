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

class UserScript {
    function OnLogin(\Classes\User $user) { }
    function OnLogout(\Classes\User $user) { }
    function OnRegister(\Classes\User $user) { }

    public static function _OnLogin(\Classes\User $user) {
        foreach (\Classes\ScriptLoader::$userScripts as $script) {
            $script->OnLogin($user);
        }
    }

    public static function _OnLogout(\Classes\User $user) {
        foreach (\Classes\ScriptLoader::$userScripts as $script) {
            $script->OnLogout($user);
        }
    }

    public static function _OnRegister(\Classes\User $user) {
        foreach (\Classes\ScriptLoader::$userScripts as $script) {
            $script->OnRegister($user, $status);
        }
    }
}

?>
