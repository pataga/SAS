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

class Plugin extends Singleton {
    public static function install($repo, $activate = false) {
        if (!file_exists(self::getRootDir().'plugins/tmp'))
            mkdir(self::getRootDir().'plugins/tmp', 0777, true);

        Git::create_new(self::getRootDir().'plugins/tmp', $repo);

        $setup = parse_ini_file(self::getRootDir().'plugins/tmp/plugin.ini', true);

        $misc = $setup['misc'];

        self::getInstance('\Classes\MySQL')
        ->tableAction('sas_plugins')
        ->insert(['name' => $misc['name'], 'version' => $misc['version']]);

        if ($activate) {
            $scripts = $setup['scripts'];
            $hId = Plugin::getHighestId();
            if (is_array($scripts)) {
                foreach ($scripts as $key => $value) {
                    copy(self::getRootDir().'plugins/tmp/'.$key.'.script.php', self::getRootDir().'includes/Scripts/'.$key.'.script.php');

                    switch ($value) {
                        case 'MySQLScript':
                            self::getInstance('\Classes\MySQL')
                            ->tableAction('sas_plugin_scripts')
                            ->insert(['script' => $key, 'type' => 1, 'pid' => $hId]);
                            break;

                        case 'UserScript':
                            self::getInstance('\Classes\MySQL')
                            ->tableAction('sas_plugin_scripts')
                            ->insert(['script' => $key, 'type' => 2, 'pid' => $hId]);
                            break;

                        case 'PageScript':
                            self::getInstance('\Classes\MySQL')
                            ->tableAction('sas_plugin_scripts')
                            ->insert(['script' => $key, 'type' => 3, 'pid' => $hId]);
                            break;
                    }
                }
            }

            $sql = $setup['sql'];
            if (is_array($sql)) {
                foreach ($sql as $key => $value) {
                    $queries = file_get_contents(self::getRootDir().'plugins/tmp/'.$value);
                    $data = explode(';', $queries);
                    foreach ($data as $key => $quy) {
                        self::getInstance('\Classes\MySQL')->query($quy);
                    }
                }
            }

            self::getInstance('\Classes\MySQL')->query("UPDATE sas_plugins SET installed = 1 WHERE id = $hId");
        }

        Directory::removeDir(self::getRootDir().'plugins/tmp', false);
    }

    public static function getInstalledPlugins() {
        $result = self::getInstance('\Classes\MySQL')
        ->tableAction('sas_plugins')
        ->select();

        $data = [];

        while ($row = $result->fetch()) {
            $data[] = [
                'id' => $row->id,
                'name' => $row->name,
                'version' => $row->version,
                'installed' => $row->installed == 1 ? true : false
            ];
        }

        return $data;
    }

    public static function getHighestId() {
        $result = self::getInstance('\Classes\MySQL')->query("SELECT * FROM sas_plugins ORDER BY id DESC LIMIT 1");
        if ($row = $result->fetch()) {
            return $row->id;
        }

        return 1;
    }
}

?>
