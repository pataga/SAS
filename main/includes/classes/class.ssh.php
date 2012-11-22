<?php
	class SSH
	{
		private $_host;
		private $_post;
		private $_user;
		private $_pass;

		private $_connection;
		private $_out;

		function __construct ($host = '', $port = '', $user = '', $pass = '') 
		{
			if (!empty($host)) 
				$this->_host = $host;
			if (!empty($port)) 
				$this->_port = $port;
			if (!empty($user))
				$this->_user = $user;
			if (!empty($pass))
				$this->_pass = $pass;

			$this->_connection  = ssh2_connect($this->_host, $this->_port);
			if (!$this->_connection) 
			  	throw new Exception('SSH Connection failed');
		}

		function authenticate ()
		{
			if (!ssh2_auth_password( $this->_connection, $this->_user, $this->_pass )) 
				throw new Exception('SSH Autentication failed');
		}

		function execute ($command) 
		{
			$output = "";
			if (!($os = ssh2_exec($this->_connection, $command, "bash"))) 
				throw new Exception('SSH command failed');

			stream_set_blocking($os, true);

			while($line = fgets($os)) 
			{
				flush();
				$output .= $line;
			}

			return $output;
		}   
	}
?>
