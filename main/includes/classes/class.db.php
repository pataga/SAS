<?php
    class Database
    {
        private $mysql;
        private $server;

        function __construct ($mysql, $server)
        {
            $this->mysql = $mysql;
            $this->server = $server;
        }

        public function getMySQLDatabases ()
        {
            $con = $this->mysql;
            $con->openRemoteConnection();
            $result = mysql_query("SHOW DATABASES") or die (mysql_error());
            $database = array();

            for ($itr = 0; ($row = mysql_fetch_object($result)); $itr++)
                $database[$itr] = $row->Database;

            return $database;
        }

        public function getMySQLTables ($db)
        {
            $con = $this->mysql;
            $con->openRemoteConnection();
            $result = mysql_query("SHOW TABLES FROM $db") or die (mysql_error());
            $tables = array();
            for ($itr = 0; ($row = mysql_fetch_array($result)); $itr++)
                $tables[$itr] = $row[0];

            return $tables;
        }

        public function getMySQLColumns ($db, $table)
        {
            $con = $this->mysql;
            $con->openRemoteConnection();
            if (mysql_select_db($db))
            {
                $result = mysql_query("SHOW COLUMNS FROM $table") or die (mysql_error());
                $colums = array();
                for ($i = 0;$row = mysql_fetch_array($result);$i++)
                {
                    $colums[$i][0] = $row[0];
                    $colums[$i][1] = $row[1];
                }
                return $colums;
            } else return 0;
        }

        public function addServer ($name, $host, $port, $user, $pass)
        {
            mysql_query("INSERT INTO sas_server_data (host,port,user,pass,name) VALUES ('$host','$port','$user','$pass','$name')");
        }

        public function addMySQL ($host, $user, $pass)
        {
            $server = $this->server;
            mysql_query("INSERT INTO sas_server_mysql (sid,host,username,password) VALUES ('$server->getID()','$host','$user','$pass')");
            mysql_query("UPDATE sas_server_data SET mysql = 1 WHERE id = ".$server->getID());
        }
    }
?>