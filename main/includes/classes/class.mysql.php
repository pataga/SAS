<?php
    class MySQL
    {
        private $mysql_host;
        private $mysql_port;
        private $mysql_user;
        private $mysql_pass;
        private $mysql_database;

        private $remote_mysql_host;
        private $remote_mysql_port;
        private $remote_mysql_user;
        private $remote_mysql_pass;

        private $server_id;

        function __construct ($mysql_data)
        {
            $this->mysql_host = $mysql_data[0];
            $this->mysql_port = $mysql_data[1];
            $this->mysql_user = $mysql_data[2];
            $this->mysql_pass = $mysql_data[3];
            $this->mysql_database = $mysql_data[4];

            if (!$this->openHostConnection())
            {
                echo ("FATAL ERROR: Verbindung zum Host MySQL Server konnte nicht aufgebaut werden!");
                die;
            }
        }

        public function setServerID($id)
        {
            $this->server_id = $id;
            $this->getRemoteData();
        }

        public function openHostConnection ()
        {
            if (mysql_connect($this->mysql_host,$this->mysql_user,$this->mysql_pass))
                if (mysql_select_db($this->mysql_database))
                    return true;
                else
                    return false;
            else
                return false;
        }

        public function HQuery ($query)
        {
            $this->openHostConnection();
            $result = mysql_query($query);
            $data = array();

            for ($i=0;$row = mysql_fetch_array($result);$i++)
            {
                $ai = 0;
                foreach ($row as $attr) {
                    $data[$i][$ai] = $attr;
                    $ai++;
                }
            }

            return $data;
        }

        public function RQuery ($query)
        {
            $this->openRemoteConnection();
            $result = mysql_query($query);
            $data = array();

            for ($i=0;$row = mysql_fetch_array($result);$i++)
            {
                $ai = 0;
                foreach ($row as $attr) {
                    $data[$i][$ai] = $attr;
                    $ai++;
                }
            }

            return $data;
        }

        private function getRemoteData ()
        {
            $data = $this->HQuery("SELECT host,port,username,password FROM sas_server_mysql WHERE sid = $this->server_id");
            $this->remote_mysql_host = $data[0][0];
            $this->remote_mysql_port = $data[0][1];
            $this->remote_mysql_user = $data[0][2];
            $this->remote_mysql_pass = $data[0][3];
        }

        public function openRemoteConnection ()
        {
            return mysql_connect($this->remote_mysql_host,$this->remote_mysql_user,$this->remote_mysql_pass);
        }
    }
?>