<?php
	class Server
	{
		private $server_id;

		private $server_mysql_host;
		private $server_mysql_port;
		private $server_mysql_user;
		private $server_mysql_pass;

		function getServerData ($id = 1)
		{
			$this->server_id = $id;
			$result = mysql_query("SELECT * FROM sas_server_data WHERE id = $this->server_id");

			if (mysql_num_rows($result) > 0)
			{
				$row = mysql_fetch_object($result);
				$data = array();

				$data[0] = $row->host;
				$data[1] = $row->user;
				$data[2] = $row->pass;

				return $data;
			}
		}

		function isInstalled ($package)
		{
			$result = mysql_query("SELECT * FROM sas_server_data WHERE id = $this->server_id");

			if (mysql_num_rows($result) > 0)
			{
				$row = mysql_fetch_object($result);

				switch ($package)
				{
					case 'mysql': if ($row->mysql == "1") return true;
					case 'postfix': if ($row->postfix == "1") return true;
					case 'ftp': if ($row->ftp == "1") return true;
					case 'samba': if ($row->samba == "1") return true;
					case 'apache': if ($row->apache == "1") return true;
					default: return false;
				}
			}

			return false;
		}

		function getMySQLData ()
		{
			if ($this->isInstalled("mysql"))
			{
				$result = mysql_query("SELECT * FROM sas_server_mysql WHERE sid = $this->server_id");

				if (mysql_num_rows($result) > 0)
				{
					$row = mysql_fetch_object($result);
					$this->server_mysql_host = $row->host;
					$this->server_mysql_port = $row->port;
					$this->server_mysql_user = $row->username;
					$this->server_mysql_pass = $row->password;
					return true;
				}
			}
			
			return false;
		}

		function connectToMySQLServer ()
		{
			if ($this->getMySQLData())
				return mysql_connect($this->server_mysql_host, $this->server_mysql_user, $this->server_mysql_pass);
			else
				return false;
		}

		function getMySQLDatabases ()
		{
			if ($this->connectToMySQLServer())
			{
				$result = mysql_query("SHOW DATABASES");
				$database = array();

				for ($itr = 0; ($row = mysql_fetch_object($result)); $itr++)
					$database[$itr] = $row->Database;

				return $database;
			} else return 0;
		}

		function serviceStatus ($ssh)
		{
			$data = array();
			$data[0] = $this->getServiceStatus($ssh, 'smbd');
			$data[1] = $this->getServiceStatus($ssh, 'apache2');
			$data[2] = $this->getServiceStatus($ssh, 'postfix');
			$data[3] = $this->getServiceStatus($ssh, 'ftp');
			$data[4] = $this->getServiceStatus($ssh, 'mysql');
			return $data;
		}

		function getServiceStatus ($ssh, $service)
		{
			$line = $ssh->execute('service '.$service.' status');
			$exp = explode(" ", $line);

			if ($exp[1] == "start/running,")
				return true;
			else
				return false;
		}

		function addServer ($name, $host, $port, $user, $pass)
		{
			mysql_query("INSERT INTO sas_server_data (host,port,user,pass,name) VALUES ('$host','$port','$user','$pass','$name')");
		}
	}
?>
