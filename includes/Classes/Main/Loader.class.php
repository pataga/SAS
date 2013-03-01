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


namespace Classes\Main;
class Loader {

    private $content = '';
    private $mysql, $main ;
    private $xmlData;
    private $window = 'included';
    private $p,$s;

    const CONTENT_PATH          = 'includes/Content/';
    const CONTENT_MENU_DATA     = 'data/MainMenu.xml';


    public function __construct($main)
    {
        $this->p = isset($_GET['p']) ? $_GET['p'] : 'home';
        $this->s = isset($_GET['s']) ? $_GET['s'] : null;

        try {
            $this->mysql = $main->MySQL();
        } catch (\Exception $e) {
            $this->main->Debug()->error($e);
        }
        $this->loadXML();
        $this->main = $main;
    }

    public function getMenuData() {
        return $this->xmlData;
    }

    private function loadNotifications() {
        $server = $this->main->Server();
        $soap = $server->getSoap();
        if (!$soap || !$soap->isAlive()) {
            return '<a href="javascript:poppy();">SAS Notification Center<div id="notify"><div class="notify_bubble">0</div></div></a><br>';
        } else {
            return '<a href="javascript:poppy();">SAS Notification Center<div id="notify"><div class="notify_bubble">'.$soap->noticeCount().'</div></div></a><br>';
        }
    }

    private function loadUserInterface() {
        $this->content .= sprintf('<div class="top"><div class="logo"><h1>Server <span>Admin</span> System</h1>
						           </div><div class="usermenu"><img src="img/profile/ubuntu.png" alt="Profilbild">
                                   <h3>%s</h3><a href="?server=change">Server wechseln</a><br>
                                   '.$this->loadNotifications().'
						           <a href="?user=logout">Logout</a></div></div>',
                                   $this->main->Session()->getUsername());
    }

    private function loadMainMenu() {
        $this->content .= '<div id="wrapper"><div id="nav"><ul>';
        for ($i=0;$i<count($this->xmlData);$i++) {
            if ($this->p == $this->xmlData[$i]['menu']['name'])
                $this->content .= sprintf('<li><a class="aktiv" href="?p=%s">%s</a></li>',$this->xmlData[$i]['menu']['name'],$this->xmlData[$i]['menu']['display']);
            else
                $this->content .= sprintf('<li><a href="?p=%s">%s</a></li>',$this->xmlData[$i]['menu']['name'],$this->xmlData[$i]['menu']['display']);
        }
        $this->content .= '</ul><br style="clear:left"></div>';
    }

    private function loadSideMenu() {
        $this->content .= '<div id="sidebar"><ul>';
        for ($i=0;$i<count($this->xmlData);$i++) {
            if ($this->xmlData[$i]['menu']['name'] == $this->p) {
                for ($s=0;$s<count($this->xmlData[$i])-1;$s++) {
                    if (!isset($this->xmlData[$i]['sub'.$s])) continue;
                    $sub = $this->xmlData[$i]['sub'.$s];
                    if (empty($sub['display'])) continue;
                    if ($this->s == $sub['name']) {
                        $this->content .= sprintf('<li class="aktiv"><a href="?p=%s&s=%s">%s</a></li>',
                                          $this->xmlData[$i]['menu']['name'],$sub['name'],$this->xmlData[$i]['sub'.$s]['display']);
                    } else {
                        $this->content .= sprintf('<li><a href="?p=%s&s=%s">%s</a></li>',
                                          $this->xmlData[$i]['menu']['name'],$sub['name'],$this->xmlData[$i]['sub'.$s]['display']);
                    }
                }
            }
        }

        $this->content .= '</ul></div>';
    }

    public function loadWindowType() {
        for ($i=0;$i<count($this->xmlData);$i++) {
            if ($this->xmlData[$i]['menu']['name'] == $this->p) {
                for ($s=0;$s<count($this->xmlData[$i])-1;$s++) {
                    if (!isset($this->xmlData[$i]['sub'.$s])) continue;
                    $sub = $this->xmlData[$i]['sub'.$s];
                    if ($this->s == $sub['name'])
                        $this->window = $sub['window'];
                }
            }
        }
    }

    public function getIncFile() {
        if (!$this->main->Session()->isServerChosen() && $this->main->Session()->isAuthenticated())
            return Loader::CONTENT_PATH.'home/server.inc.php';
        if (!$this->main->Session()->isAuthenticated())
            $this->reload();
        $default = Loader::CONTENT_PATH.'error/404.inc.php';
        for ($i=0;$i<count($this->xmlData);$i++) {
            if ($this->xmlData[$i]['menu']['name'] == $this->p) {
                $default = $this->xmlData[$i]['menu']['default'];
                for ($s=0;$s<count($this->xmlData[$i])-1;$s++) {
                    if (!isset($this->xmlData[$i]['sub'.$s])) continue;
                    $sub = $this->xmlData[$i]['sub'.$s];
                    if ($this->s == $sub['name']) {
                        if (file_exists($sub['path']))
                            return $sub['path'];
                        else
                            return Loader::CONTENT_PATH.'error/404.inc.php';
                    } 
                }
            }
        }

        if (file_exists($default))
            return $default;
        
        return Loader::CONTENT_PATH.'error/404.inc.php';
    }

    public function loadMenues() {
        $this->loadWindowType();
        if ($this->window == 'included') {
            $this->loadUserInterface();
            $this->loadMainMenu();      
            $this->content .= '<div id="main">';
            $this->loadSideMenu();
            $this->content .= '<div id="content">';
        }
        return $this->content;
    }

    public function loadLoginMask() {
        $this->main->Header()->relocate("./login/");
        die;
    }

    public function reload() {
        $header = $this->main->Header();
        if (!empty($this->s) && !empty($this->p))
            $header->relocate('?p='.$this->p.'&s='.$this->s);
        else if (!empty($this->p))
            $header->relocate('?p='.$this->p);
        else
            $header->relocate(" ");
    }

    private function loadXML() {
        $xml = new \Classes\XML();
        $xml->open(Loader::CONTENT_MENU_DATA);
        $content = $this->xmlData;
        $mi = 0;
        $si = 0;
        $inSub = false;

        while ($xml->read()) {
            if ($xml->nodeType == \Classes\XML::END_ELEMENT && $xml->name == 'sub') {
                $si++;
                $inSub = false;
            } elseif ($xml->nodeType == \Classes\XML::END_ELEMENT && $xml->name == 'menu') {
                $mi++;
                $si = 0;     
                $inSub = false;   
            } elseif ($xml->nodeType == \Classes\XML::ELEMENT && $xml->name == 'sub') { 
                $inSub = true;   
            }

            if ($xml->nodeType == \Classes\XML::ELEMENT && !$inSub && $xml->name != 'sub' && $xml->name != 'menu' && $xml->name != 'navigation') {
                $content[$mi]['menu'][$xml->name] = htmlentities($xml->readString());
            } elseif ($xml->nodeType == \Classes\XML::ELEMENT && $inSub && $xml->name != 'sub' && $xml->name != 'menu' && $xml->name != 'navigation') {
                $content[$mi]['sub'.$si][$xml->name] = htmlentities($xml->readString());
            } 
        }
        $this->xmlData = $content;
    }

}
?>
