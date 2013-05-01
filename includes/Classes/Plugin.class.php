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

class Plugin {
    public static function remove($id) {
        $result = Main::MySQL()->tableAction('sas_plugins')
            ->select(null, ['id' => $id]);
        if ($row = $result->fetch()) {
            Directory::removeDir(Singleton::getRootDir().'/includes/Plugins/Content/'.$row->name, false);
            @rmdir(Singleton::getRootDir().'/includes/Plugins/Content/'.$row->name);
            Directory::removeDir(Singleton::getRootDir().'/includes/Plugins/Scripts/'.$row->name, false);
            @rmdir(Singleton::getRootDir().'/includes/Plugins/Scripts/'.$row->name);
            Main::MySQL()->tableAction('sas_plugins')->delete(['id' => $id]);
            Main::MySQL()->tableAction('sas_plugin_scripts')->delete(['pid' => $id]);
        }
    }

    public static function install($repo, $activate = true) {
        $sessionId = session_id();
        if (!file_exists(Singleton::getRootDir().'/tmp/plugins/'.$sessionId))
            @mkdir(Singleton::getRootDir().'/tmp/plugins/'.$sessionId, 0777, true);

        Git::create_new(Singleton::getRootDir().'/tmp/plugins/'.$sessionId, $repo);

        $setup = parse_ini_file(Singleton::getRootDir().'/tmp/plugins/'.$sessionId.'/plugin.ini', true);

        $misc = $setup['misc'];

        if (file_exists(Singleton::getRootDir().'/includes/Plugins/Content/'.$misc['name'])) {
            Directory::removeDir(Singleton::getRootDir().'/includes/Plugins/Content/'.$misc['name'], false);
            rmdir(Singleton::getRootDir().'/includes/Plugins/Content/'.$misc['name']);
        }

        if (isset($_GET['id'])) {
            Main::MySQL()
                ->tableAction('sas_plugins')
                ->delete(['id' => $_GET['id']]);
            Main::MySQL()
                ->tableAction('sas_plugins')
                ->delete(['id' => $_GET['id']]);
            Main::MySQL()
                ->tableAction('sas_plugin_scripts')
                ->delete(['pid' => $_GET['id']]);
        } else {
            Main::MySQL()->Query("DELETE FROM sas_plugins WHERE name = '".$misc['name']."'");
            Main::MySQL()->Query("DELETE FROM sas_plugin_scripts WHERE pid NOT IN (SELECT id FROM sas_plugins)");
        }

        Main::MySQL()
            ->tableAction('sas_plugins')
            ->insert(['name' => $misc['name'], 'version' => $misc['version'], 'content' => isset($misc['content'])?$misc['content']:0, 'repo' => $repo]);

        if (isset($misc['content']) && file_exists(Singleton::getRootDir().'/tmp/plugins/'.$sessionId.'/'.$misc['content'])) {
            mkdir(Singleton::getRootDir().'/includes/Plugins/Content/'.$misc['name']);
            copy(Singleton::getRootDir().'/tmp/plugins/'.$sessionId.'/'.$misc['content'], Singleton::getRootDir().'/includes/Plugins/Content/'.$misc['name'].'/'.$misc['content']);
        }

        if ($activate) {
            $scripts = isset($setup['scripts']) ? $setup['scripts'] : false;
            $hId = Plugin::getHighestId();
            if (file_exists(Singleton::getRootDir().'/includes/Plugins/Scripts/'.$misc['name'])) {
                Directory::removeDir(Singleton::getRootDir().'/includes/Plugins/Scripts/'.$misc['name'], false);
                rmdir(Singleton::getRootDir().'/includes/Plugins/Scripts/'.$misc['name']);
            }
            mkdir(Singleton::getRootDir().'/includes/Plugins/Scripts/'.$misc['name']);
            if (is_array($scripts)) {
                foreach ($scripts as $key => $value) {
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

            $sql = isset($setup['sql']) ? $setup['sql'] : false;
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
