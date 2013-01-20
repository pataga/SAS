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


namespace Main;
class Loader {

    public $_page = "";
    public $_spage = "";
    private $content = "";
    private $mysql = null;
    private $main = null;

    public function __construct($main)
    {
        try {
            $this->mysql = $main->MySQL();
        } catch (\Exception\MySQLException $e) {
            $this->main->Debug()->error($e);
        }

        $this->main = $main;
    }


    private function loadUserInterface() {
        $this->content .= sprintf('<div class="top"><div class="logo"><h1>Server <span>Admin</span> System</h1>
						           </div><div class="usermenu"><img src="img/profile/ubuntu.png" alt="Profilbild">
                                   <h3>%s</h3><a href="?server=change">Server wechseln</a><br>
                                   <a href="javascript:poppy();">SAS Notification Center
                                   <span class="notify">2</span></a><br>
						           <a href="?user=logout">Logout</a></div></div>',
                                   $this->main->Session()->getUsername());
    }

    private function loadMainMenu() {
        $this->content .= '<div id="wrapper"><div id="nav"><ul>';
        $result = $this->mysql->Query("SELECT * FROM sas_menu_main");
        while ($row = $result->fetchObject()) {
            $name = $row->name;
            $page = $row->page;

            if ($this->_page == $page)
                $this->content .= sprintf('<li><a class="aktiv" href="?p=%s">%s</a></li>',$page,$name);
            else
                $this->content .= sprintf('<li><a href="?p=%s">%s</a></li>',$page,$name);
        }

        $this->content .= '</ul><br style="clear:left"></div>';
    }

    private function loadSideMenu() {
        $this->content .= '<div id="sidebar"><ul>';
        $page = mysql_real_escape_string($this->_page);
        $result = $this->mysql->Query("SELECT * FROM sas_menu_side WHERE page = '$page'");
        while ($row = $result->fetchObject()) {
            $name = $row->name;
            $page = $row->page;
            $spage = $row->spage;

            if ($this->_spage == $spage)
                $this->content .= sprintf('<li class="aktiv"><a href="?p=%s&s=%s">%s</a></li>',$page,$spage,$name);
            else
                $this->content .= sprintf('<li><a href="?p=%s&s=%s">%s</a></li>',$page,$spage,$name);
        }

        $this->content .= '</ul></div>';
    }

    public function getIncFile() {
        if (!$this->main->Session()->isServerChosen() && $this->main->Session()->isAuthenticated())
            return 'includes/content/home/server.inc.php';
        if (!$this->main->Session()->isAuthenticated())
            $this->reload();
        $page = mysql_real_escape_string($this->_page);
        $spage = mysql_real_escape_string($this->_spage);

        $result = $this->mysql->Query("SELECT inc_path FROM sas_content WHERE page = '$page' AND spage = '$spage'");
        if ($result->getRowsCount() > 0) {
            $row = $result->fetchObject();
            if (!is_file($row->inc_path))
                throw new \Main\Exception('Fatal Error: Incorrect include file for page '.$page.' and subpage '.$spage);
            return $row->inc_path;
        } else {
            throw new \Main\Exception('Fatal Error: Incorrect include file for page '.$page.' and subpage '.$spage);
        }
    }

    public function loadMenues() {
        $this->loadUserInterface();
        $this->loadMainMenu();
        $this->content .= '<div id="main">';
        $this->loadSideMenu();
        $this->content .= '<div id="content">';
        return $this->content;
    }

    public function loadLoginMask() {
        header("Location: ./login/");
        die;
    }

    public function reload() {
        if (!empty($this->_spage) && !empty($this->_page))
            header("Location: ?p=$this->_page&s=$this->_spage");
        else if (!empty($this->_page))
            header("Location: ?p=$this->_page");
        else
            header("Location: ");
    }

}
?>
