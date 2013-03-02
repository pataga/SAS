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


namespace Classes\Main;
class Loader {
    private $window = 'included';
    private $p,$s,$xmlData,$mysql,$main,$pageName;

    const CONTENT_PATH          = 'includes/Content/';
    const CONTENT_MENU_DATA     = 'data/MainMenu.xml';
    const CONTENT_TOP           = 'includes/Content/main/top.inc.php';

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

    public function getMenu() {
        return $this->prepareTop();
    }

    private function prepareTop() {
        $this->loadWindowType();
        $top = file_get_contents(Loader2::CONTENT_TOP);
        preg_match('/-----MENUSTART-----(.*?)-----MENUEND-----/',$top,$menuArr);
        $menu = $menuArr[1];
        preg_match('/-----SIDEBARSTART-----(.*?)-----SIDEBAREND-----/',$top,$sidebar);
        $sidebar = $sidebar[1];

        $fullMenu = '';

        for ($i=0;$i<count($this->xmlData);$i++) {
            if ($this->p == $this->xmlData[$i]['menu']['name']) {
                $fullMenu .= str_replace(['#{PAGE_NAME}','#{PAGE_PARAM}','#{STATUS}'],
                    [$this->xmlData[$i]['menu']['display'],$this->xmlData[$i]['menu']['name'],'aktiv'],$menu);
                $this->pageName = $this->xmlData[$i]['menu']['display'];
            }
            else
                $fullMenu .= str_replace(['#{PAGE_NAME}','#{PAGE_PARAM}','#{STATUS}'],
                    [$this->xmlData[$i]['menu']['display'],$this->xmlData[$i]['menu']['name'],'inaktiv'],$menu);
        }

        $subFull = '';

        for ($i=0;$i<count($this->xmlData);$i++) {
            if ($this->xmlData[$i]['menu']['name'] == $this->p) {
                for ($s=0;$s<count($this->xmlData[$i])-1;$s++) {
                    if (!isset($this->xmlData[$i]['sub'.$s])) continue;
                    $sub = $this->xmlData[$i]['sub'.$s];
                    if (empty($sub['display'])) continue;
                    if ($this->s == $sub['name']) {
                        $subFull .= str_replace(['#{PAGE_NAME}','#{PAGE_PARAM}','#{SUBPAGE_NAME}','#{SUBPAGE_PARAM}','#{STATUS}'],
                            [$this->xmlData[$i]['menu']['display'],$this->xmlData[$i]['menu']['name'],$this->xmlData[$i]['sub'.$s]['display'],$sub['name'],'aktiv'],$sidebar);
                    } else {
                        $subFull .= str_replace(['#{PAGE_NAME}','#{PAGE_PARAM}','#{SUBPAGE_NAME}','#{SUBPAGE_PARAM}','#{STATUS}'],
                            [$this->xmlData[$i]['menu']['display'],$this->xmlData[$i]['menu']['name'],$this->xmlData[$i]['sub'.$s]['display'],$sub['name'],'inaktiv'],$sidebar);
                    }
                }
            }
        }

        $top = preg_replace('/-----MENUSTART-----(.*?)-----MENUEND-----/',$this->window==='included'?$fullMenu:'',$top); 
        $top = preg_replace('/-----SIDEBARSTART-----(.*?)-----SIDEBAREND-----/',$this->window==='included'?$subFull:'',$top); 

        $search = [
            '#{PAGE_NAME}',
            '#{USERNAME}',
            '#{NOTIFICATION_COUNT}',
            '#{VISIBILITY}'
        ];

        $replace = [
            $this->pageName,
            $this->main->Session()->getUsername(),
            $this->getNotificationCount(),
            $this->window === 'included' ? '' : 'display:none;'
        ];

        $top = str_replace($search, $replace, $top);

        return $top;
    }

    public function getMenuData() {
        return $this->xmlData;
    }

    private function getNotificationCount() {
        $server = $this->main->Server();
        $soap = $server->getSoap();
        if (!$soap || !$soap->isAlive()) {
            return 0;
        } else {
            return $soap->noticeCount();
        }
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
}
?>
