<?php
	class Server
	{
		private $server_id;
		private $mysql;

		function __construct ($_mysql)
		{
			$this->mysql = $_mysql;
		}

		function getID()
		{
			return $this->server_id;
		}

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
				$data[3] = $row->name;

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
			} else return false;
		}

		function getMySQLData ()
		{
			if ($this->isInstalled("mysql"))
			{
				$result = mysql_query("SELECT * FROM sas_server_mysql WHERE sid = $this->server_id");

				if (mysql_num_rows($result) > 0)
				{
					$data = array();
					$row = mysql_fetch_object($result);
					$data[0] = $row->host;
					$data[1] = $row->port;
					$data[2] = $row->username;
					$data[3] = $row->password;
					return $data;
				}
			}
			
			return false;
		}

		function serviceStatus ($ssh)
		{
			$data = array();
			$data[0] = $this->getServiceStatus($ssh, 'smbd');
			$data[1] = $this->getServiceStatus($ssh, 'apache2');
			$data[2] = $this->getServiceStatus($ssh, 'postfix');
			$data[3] = $this->getServiceStatus($ssh, 'proftpd');
			$data[4] = $this->getServiceStatus($ssh, 'mysql');
			return $data;
		}

		function getServiceStatus ($ssh, $service)
		{
			$line = $ssh->execute('service '.$service.' status');
			$exp = explode(" ", $line);

			if ($exp[1] == "start/running," || $exp[2] == "is" && $exp[3] == "running")
				return true;
			else
				return false;
		}	
	}
?>
