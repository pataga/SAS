<?php

class User {

    private $_userID = null;
    private $_username = null;
    private $_password = null;
    private $_mysql = null;

    function __construct($mysql) {
        $this->_userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : 0;
        $this->_mysql = $mysql;
    }

    public function setUsername($username) {
        $this->_username = $username;
    }

    public function setPassword($password) {
        $this->_password = $password;
    }

    public function getUsername() {
        return isset($_SESSION['username']) ? $_SESSION['username'] : "";
    }

    public function isLoggedIn() {
        return isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'];
    }

    public function validatePassword($pass) {
        $result = $this->_mysql->Query("SELECT password FROM sas_users WHERE id = $this->_userID");

        if ($result->getRowsCount() > 0) {
            $row = $this->_mysql->fetchObject();
            if ($row->password == md5($pass))
                return true;
            else
                return false;
        } else
            return false;
    }

    public function AuthChallenge() {
        $user = mysql_real_escape_string($this->_username);
        $result = $this->_mysql->Query("SELECT * FROM sas_users WHERE username = '$user'") or die(mysql_error());

        if ($result->getRowsCount() > 0) {
            $row = $this->_mysql->fetchObject();

            if ($row->password == md5($this->_password))
                $this->setAuthState(true, $row->id);
            else
                $this->setAuthState(false);
        } else
            $this->setAuthState(false);
    }

    private function setAuthState($authState, $id = 0) {
        $_SESSION['userID'] = $id;
        $_SESSION['loggedIn'] = $authState;
        $_SESSION['username'] = $this->_username;
    }

    public function Logout() {
        session_unset();
        session_destroy();
    }

    public function addUser($username, $password, $passwordr, $email) {
        if ($password == $passwordr) {
            $result = $this->_mysql->Query("SELECT * FROM sas_users WHERE username = '$username' OR email = '$email'");
            if ($result->getRowsCount() == 0) {
                $password = md5($password);
                $this->_mysql->Query("INSERT INTO sas_users (username,password,email) VALUES ('$username','$password','$email')");
                return 1;
            } else
                return -1;
        } else
            return -2;
    }

    public function setUserPassword($username, $password, $passwordr) {
        if ($password == $passwordr) {
            $password = md5($password);
            $result = $this->_mysql->Query("UPDATE sas_users SET password = '$password' WHERE username = '$username'");
            return 1;
        } else {
            return 0;
        }
    }

    public function setPermission($sid, $permission, $active) {
        $query;
        $result = $this->_mysql->Query("SELECT * FROM sas_user_permission WHERE uid = $this->_userID AND sid = $sid");
        if ($result->getRowsCount() > 0)
            $query = "UPDATE sas_user_permission SET $permission = $active WHERE uid = $this->_userID AND sid = $sid";
        else
            $query = "REPLACE sas_user_permission SET $permission = $active WHERE uid = $this->_userID AND sid = $sid";
        $this->_mysql->Query($query);
    }

}
?>
