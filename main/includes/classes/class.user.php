<?php
	class User
	{
		private $_username = "";
		private $_password = "";

		function setUsername ($username)
		{
			$this->_username = $username;
		}

		function setPassword ($password)
		{
			$this->_password = $password;
		}

		function isLoggedIn ()
		{
			return isset($_SESSION['loggedIn'])&&$_SESSION['loggedIn'];
		}

		function AuthChallenge ()
		{
			$result = mysql_query("SELECT * FROM sas_users WHERE username = '$this->_username'") or die (mysql_error());

			if (mysql_num_rows($result) > 0)
			{
				$row = mysql_fetch_object($result);

				if ($row->password == md5($this->_password))
					$this->setAuthState(true);
				else
					$this->setAuthState(false);
			}
			else
			{
				$this->setAuthState(false);
			}
		}

		function setAuthState ($authState)
		{
			$_SESSION['loggedIn'] = $authState;
			$_SESSION['username'] = $this->_username;
		}
	}
?>