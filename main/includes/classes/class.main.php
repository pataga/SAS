<?php

class Main {

    private $mysql_data, $mysql, $db, $result, $server, $ssh, $user, $tableaction, $loader;

    public function __construct($data = false) {
        if (!$data) {
            if(!file_exists('./install')) {
                header('Location: ./install');
            } else {
                throw new Exception("Fehler in ./includes/config/config.mysql.php");
            }
        } else {
            $this->mysql_data = $data;
            $this->initialisizeInstances();
        }
    }

    private function initialisizeInstances() {
        $this->mysql = new MySQL($this->mysql_data[0], $this->mysql_data[1], $this->mysql_data[2], $this->mysql_data[3], $this->mysql_data[4]);
        $this->loader = new Loader($this);
        $this->user = new User($this);
        $this->server = new Server($this);
        $this->database = new Database($this);
    }

    public function getServerInstance() { return $this->server; }
    public function getSSHInstance() { return $this->ssh; }
    public function getMySQLInstance() { return $this->mysql; }
    public function getUserInstance() { return $this->user; }
    public function getDatabaseInstance() { return $this->database; }
    public function getLoaderInstance() { return $this->loader; }
}

?>