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

namespace Classes\User;
class Permission {
    private $user,$main;

    // Permission BitMask Values
    const HOME_OVERVIEW         = 0x01;
    const HOME_QUICKPANEL       = 0x02;
    const HOME_ABOUT            = 0x04;
    const HOME_DOCUMENTATION    = 0x08;
    const HOME_REPOSITORY       = 0x10;

    const APACHE_OVERVIEW       = 0x01;
    const APACHE_CONFIGURATION  = 0x02;
    const APACHE_CONTROL        = 0x04;
    const APACHE_VHOSTS         = 0x08;
    const APACHE_MODULE         = 0x10;
    const APACHE_PHP            = 0x20;
    const APACHE_PHPINFO        = 0x40;
    const APACHE_STATS          = 0x80;

    const PROFTP_OVERVIEW       = 0x01;
    const PROFTP_CONFIGURATION  = 0x02;
    const PROFTP_CONTROL        = 0x04;
    const PROFTP_FILES          = 0x08;
    const PROFTP_STATS          = 0x10;

    const MYSQL_OVERVIEW        = 0x01;
    const MYSQL_ADDUSER         = 0x02;
    const MYSQL_CONTROL         = 0x04;
    const MYSQL_INSTALL         = 0x08;
    const MYSQL_MANAGEDB        = 0x10;
    const MYSQL_MODULE          = 0x20;
    const MYSQL_IMPORT_EXPORT   = 0x40;

    const SAMBA_OVERVIEW        = 0x01;
    const SAMBA_DRIVES          = 0x02;
    const SAMBA_CONFIGURATION   = 0x04;
    const SAMBA_CONTROL         = 0x08;
    const SAMBA_USERS           = 0x10;

    const LOGS_OVERVIEW         = 0x01;
    const LOGS_SHOW             = 0x02;
    const LOGS_TEST             = 0x04;

    const SYSTEM_OVERVIEW       = 0x01;
    const SYSTEM_CONSOLE        = 0x02;
    const SYSTEM_CRONJOBS       = 0x04;
    const SYSTEM_TASKMGR        = 0x08;
    const SYSTEM_USER_GROUPS    = 0x10;
    const SYSTEM_SUICIDE        = 0x20;
    const SYSTEM_PACKETMGR      = 0x40;

    const TOOLS_OVERVIEW        = 0x01;
    const TOOLS_HWINFO          = 0x02;
    const TOOLS_HDDINFO         = 0x04;
    const TOOLS_RAMINFO         = 0x08;
    const TOOLS_NETWORK         = 0x10;
    const TOOLS_MISC            = 0x20;

    const USER_OVERVIEW         = 0x01;
    const USER_ADD              = 0x02;
    const USER_EDIT             = 0x04;

    const PLUGINS_GENERAL       = 0x01;

    const HOME_PERMISSION       = 0x00100;
    const APACHE_PERMISSION     = 0x00200;
    const PROFTP_PERMISSION     = 0x00400;
    const MYSQL_PERMISSION      = 0x00800;
    const SAMBA_PERMISSION      = 0x01000;
    const LOGS_PERMISSION       = 0x02000;
    const SYSTEM_PERMISSION     = 0x04000;
    const TOOLS_PERMISSION      = 0x08000;
    const USER_PERMISSION       = 0x10000;
    const PLUGINS_PERMISSION    = 0x20000;

    public function __construct($user) {
        $this->user = $user;
    }

    public function setPermission($bitMask) {
        $isPermitted = false;
        $db = \Classes\Main::MySQL();

        if ($bitMask & Permission::HOME_PERMISSION) {
            $db->tableAction('sas_user_permission')->replace(['bitmask' => $bitMask, 'uid' => $this->user->getId()]);
        }

        if ($bitMask & Permission::APACHE_PERMISSION) {
            $db->tableAction('sas_user_permission')->replace(['bitmask' => $bitMask, 'uid' => $this->user->getId()]);            
        }

        if ($bitMask & Permission::PROFTP_PERMISSION) {
            $db->tableAction('sas_user_permission')->replace(['bitmask' => $bitMask, 'uid' => $this->user->getId()]);            
        }

        if ($bitMask & Permission::MYSQL_PERMISSION) {
            $db->tableAction('sas_user_permission')->replace(['bitmask' => $bitMask, 'uid' => $this->user->getId()]);            
        }

        if ($bitMask & Permission::SAMBA_PERMISSION) {
            $db->tableAction('sas_user_permission')->replace(['bitmask' => $bitMask, 'uid' => $this->user->getId()]);            
        }

        if ($bitMask & Permission::LOGS_PERMISSION) {
            $db->tableAction('sas_user_permission')->replace(['bitmask' => $bitMask, 'uid' => $this->user->getId()]);            
        }

        if ($bitMask & Permission::SYSTEM_PERMISSION) {
            $db->tableAction('sas_user_permission')->replace(['bitmask' => $bitMask, 'uid' => $this->user->getId()]);            
        }

        if ($bitMask & Permission::TOOLS_PERMISSION) {
            $db->tableAction('sas_user_permission')->replace(['bitmask' => $bitMask, 'uid' => $this->user->getId()]);            
        }

        if ($bitMask & Permission::USER_PERMISSION) {
            $db->tableAction('sas_user_permission')->replace(['bitmask' => $bitMask, 'uid' => $this->user->getId()]);            
        }

        if ($bitMask & Permission::PLUGINS_PERMISSION) {
            $db->tableAction('sas_user_permission')->replace(['bitmask' => $bitMask, 'uid' => $this->user->getId()]);            
        }
    }

    public function isPermitted($bitMaskGlobal, $bitMaskLocal = false) {
        $db = \Classes\Main::MySQL();
        $result = $db->Query("SELECT * FROM sas_user_permission WHERE uid = ".$this->user->getID());

        while ($data = $result->fetch()) {
            if ($data->bitmask & $bitMaskGlobal && !$bitMaskLocal) {
                return true;
            } elseif (($data->bitmask & $bitMaskGlobal) && ($data->bitmask & $bitMaskLocal)) {
                return true;
            }
        }

        return false;
    }
}

?>
