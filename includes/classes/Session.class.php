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

class Session {
    private $mysql = NULL, $main = NULL;
    /**
     * Starte Session 
     */
    public function __construct($main) {
        $this->mysql = $main->getMySQLInstance();
        $this->main = $main;

        session_start();

        //User Data Initialisierung
        $_SESSION['user']['authenticated'] = false;
        $_SESSION['user']['failedAuths'] = 0;
        $_SESSION['user']['id'] = 0;
        $_SESSION['user']['name'] = '';
        $_SESSION['user']['email'] = '';
        $_SESSION['user']['admin'] = 0;

        //Server Data Initialisierung
        $_SESSION['server']['chosen'] = false;
        $_SESSION['server']['id'] = 0;
        $_SESSION['server']['name'] = '';
        $_SESSION['server']['address'] = '';

        //Debug Data Initialisierung
        $_SESSION['debug']['logLevel'] = 2; //Userspezifisches logLevel (für Entwicklung)
        $_SESSION['debug']['errorsCount'] = 0;
    }

    /**
     * Überprüft, ob der Benutzer sich authentifiziert hat
     * @return bool 
     */
    public function IsLoggedIn() {
        return isset($_SESSION['user']['authenticated']) && $_SESSION['user']['authenticated'];
    }

    /**
     * Gibt einen boolschen Wert zurück, der angibt, ob ein Server ausgewählt wurde.
     * @return bool
     */
    public function IsServerChosen() {
        return $_SESSION['server']['chosen'];
    }

    /**
     * Gibt die Datenbank ID des Servers zurück
     * @return int id
     */
    public function GetServerID() {
        return $_SESSION['server']['id'];
    }

    /**
     * Gibt Server Namen zurück
     * @return String name
     */
    public function GetServerName() {
        return $_SESSION['server']['name'];
    }

    /**
     * Gibt Server Adresse zurück
     * @return String address
     */
    public function GetServerAddress() {
        return $_SESSION['server']['address'];
    }

    /**
     * Gibt den Auth Status des Benutzers zurück
     * @return bool status
     */
    public function IsAuthenticated() {
        return $_SESSION['user']['authenticated'];
    }

    /**
     * Gibt zurück, wie oft mit den falschen Benutzerdaten ein Login versucht wurde.
     * @return int count
     */
    public function GetFailedAuths() {
        return $_SESSION['user']['failedAuths'];
    }

    /**
     * Gibt die ID des Benutzers zurück
     * @return int id
     */
    public function GetUserId() {
        return $_SESSION['user']['id'];
    }

    /**
     * Gibt den Benutzernamen zurück
     * @return String username
     */
    public function GetUserName() {
        return $_SESSION['user']['name'];
    }

    /**
     * Gibt die Emailadresse des Benutzers zurück
     * @return String email
     */
    public function GetUserEmail() {
        return $_SESSION['user']['email'];
    }

    /**
     * Gibt zurück ob der Benutzer ein Administrator ist
     * @return bool admin
     */
    public function IsAdmin() {
        return $_SESSION['user']['admin'];
    }

    /**
     * Gibt die Anzahl der Fehler auf der aktuelle Seite zurück
     * @return int count
     */
    public function GetErrorsCount() {
        return $_SESSION['debug']['errorsCount'];
    }

    /**
     * Gibt Userspezifisches logLevel zurück
     * @return int logLevel
     */
    public function GetLogLevel() {
        return $_SESSION['debug']['logLevel'];
    }

    /**
     * Überprüft die Zugangsdaten des Benutzers und setzt entsprechende Session Daten
     * Zudem wird eine Instanz der Klasse User angelegt.
     * @param String username
     * @param String password
     * @return bool / User
     */
    public function AuthChallenge($username, $password) {
        if (empty($username) || empty($password)) {
            $_SESSION['user']['failedAuths']++;
            return false;
        } 

        $users = $this->mysql->tableAction('sas_users');
        $result = $users->select(NULL, ['username' => $username]);
        if (!$result) {
            $_SESSION['user']['failedAuths']++;
            return false;
        }

        $user = $result->fetchObject();
        if ($user->password != md5($password)) {
            $_SESSION['user']['failedAuths']++;
            return false;
        }

        $_SESSION['user']['authenticated'] = true;
        $_SESSION['user']['failedAuths'] = 0;
        $_SESSION['user']['id'] = $user->id;
        $_SESSION['user']['name'] = $user->username;
        $_SESSION['user']['email'] = $user->email;
        $_SESSION['user']['admin'] = $user->admin;

        //Klasse User noch nicht umgeschrieben, daher noch nicht funktionsfähig
        $userInstance = new User($this->main);
        if (!$userInstance->SetData())
            return false;
        
        return $userInstance;
    }
}

?>
