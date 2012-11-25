<?php
	class User
	{
		private $_userID = "";
		private $_username = "";
		private $_password = "";

		function __construct ()
		{
			$this->_userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : 0;
		}

		function setUsername ($username)
		{
			$this->_username = $username;
		}

		function setPassword ($password)
		{
			$this->_password = $password;
		}

		function getUsername ()
		{
			return isset($_SESSION['username']) ? $_SESSION['username'] : "";
		}

		function isLoggedIn ()
		{
			return isset($_SESSION['loggedIn'])&&$_SESSION['loggedIn'];
		}

		function AuthChallenge ()
		{
			$user = mysql_real_escape_string($this->_username);
			$result = mysql_query("SELECT * FROM sas_users WHERE username = '$user'") or die (mysql_error());

			if (mysql_num_rows($result) > 0)
			{
				$row = mysql_fetch_object($result);

				if ($row->password == md5($this->_password))
					$this->setAuthState(true, $row->id);
				else
					$this->setAuthState(false);
			} else $this->setAuthState(false);
		}

		function setAuthState ($authState, $id = 0)
		{
			$_SESSION['userID'] = $id;
			$_SESSION['loggedIn'] = $authState;
			$_SESSION['username'] = $this->_username;
		}

		function Logout ()
		{
			session_unset();
			session_destroy();
		}

		function addUser ($username, $password, $passwordr, $email)
		{
			if ($password == $passwordr)
			{
				$result = mysql_query("SELECT * FROM sas_users WHERE username = '$username' OR email = '$email'");
				if (mysql_num_rows($result) == 0)
				{
					$password = md5($password);
					mysql_query("INSERT INTO sas_users (username,password,email) VALUES ('$username','$password','$email')");
					return 1;
				} else return -1;
			} else return -2;
		}

		function setPermission ($sid, $permission, $active)
		{
			$query;
			$result = mysql_query("SELECT * FROM sas_user_permission WHERE uid = $this->_userID AND sid = $sid");
			if (mysql_num_rows($result) > 0)
				$query = "UPDATE sas_user_permission SET $permission = $active WHERE uid = $this->_userID AND sid = $sid";
			else
				$query = "REPLACE sas_user_permission SET $permission = $active WHERE uid = $this->_userID AND sid = $sid";
			mysql_query($query);
		}
	}
?>
