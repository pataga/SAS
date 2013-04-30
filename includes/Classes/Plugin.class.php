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

class Plugin {
    public static function install($repo, $activate = true) {
        $sessionId = session_id();
        echo $sessionId;
        if (!file_exists(Singleton::getRootDir().'/tmp/plugins/'.$sessionId))
            @mkdir(Singleton::getRootDir().'/tmp/plugins/'.$sessionId, 0777, true);

        Git::create_new(Singleton::getRootDir().'/tmp/plugins/'.$sessionId, $repo);

        $setup = parse_ini_file(Singleton::getRootDir().'/tmp/plugins/'.$sessionId.'/plugin.ini', true);

        $misc = $setup['misc'];

        Main::MySQL()
        ->tableAction('sas_plugins')
        ->insert(['name' => $misc['name'], 'version' => $misc['version']]);

        if ($activate) {
            $scripts = $setup['scripts'];
            $hId = Plugin::getHighestId();
            if (is_array($scripts)) {
                foreach ($scripts as $key => $value) {
                    mkdir(Singleton::getRootDir().'/includes/Plugins/Scripts/'.$misc['name']);
                    copy(Singleton::getRootDir().'/tmp/plugins/'.$sessionId.'/'.$key.'.script.php', Singleton::getRootDir().'/includes/Plugins/Scripts/'.$misc['name'].'/'.$key.'.script.php');

                    switch ($value) {
                        case 'MySQLScript':
                            Main::MySQL()
                            ->tableAction('sas_plugin_scripts')
                            ->insert(['script' => $key, 'type' => 1, 'pid' => $hId]);
                            break;

                        case 'UserScript':
                            Main::MySQL()
                            ->tableAction('sas_plugin_scripts')
                            ->insert(['script' => $key, 'type' => 2, 'pid' => $hId]);
                            break;

                        case 'PageScript':
                            Main::MySQL()
                            ->tableAction('sas_plugin_scripts')
                            ->insert(['script' => $key, 'type' => 3, 'pid' => $hId]);
                            break;
                    }
                }
            }

            $sql = $setup['sql'];
            if (is_array($sql)) {
                foreach ($sql as $key => $value) {
                    $queries = file_get_contents(Singleton::getRootDir().'/tmp/plugins/'.$sessionId.'/'.$value);
                    $data = explode(';', $queries);
                    foreach ($data as $key => $quy) {
                        Main::MySQL()->query($quy);
                    }
                }
            }

            Main::MySQL()->Query("UPDATE sas_plugins SET installed = 1 WHERE id = $hId");
        }

        Directory::removeDir(Singleton::getRootDir().'/tmp/plugins/'.$sessionId, false);
        rmdir(Singleton::getRootDir().'/tmp/plugins/'.$sessionId);
    }

    public static function getInstalledPlugins() {
        $result = Main::MySQL()
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
        $result = Main::MySQL()->Query("SELECT * FROM sas_plugins ORDER BY id DESC LIMIT 1");
        if ($row = $result->fetch()) {
            return $row->id;
        }

        return 1;
    }
}

?>
