<?php


/**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
* @author Patrick Farnkopf
*
*/

namespace Classes;
class Session {
    private $mysql;
    /**
     * Starte Session 
     */
    public function __construct() {
        if (!isset($_SESSION['user']['authenticated'])) {
            self::initSession();
        }
    }

    private static function initSession() {
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
     * Gibt einen boolschen Wert zurück, der angibt, ob ein Server ausgewählt wurde.
     * @return bool
     */
    public function isServerChosen() {
        return $_SESSION['server']['chosen'];
    }

    /**
     * Gibt die Datenbank ID des Servers zurück
     * @return int id
     */
    public function getServerID() {
        return $_SESSION['server']['id'];
    }

    /**
     * Gibt Server Namen zurück
     * @return String name
     */
    public function getServerName() {
        return $_SESSION['server']['name'];
    }

    /**
     * Gibt Server Adresse zurück
     * @return String address
     */
    public function getServerAddress() {
        return $_SESSION['server']['address'];
    }

    /**
     * Gibt den Auth Status des Benutzers zurück
     * @return bool status
     */
    public function isAuthenticated() {
        if ($_SESSION['user']['authenticated']) {
            Main::setUser(new User());
        }

        return $_SESSION['user']['authenticated'];
    }

    /**
     * Gibt zurück, wie oft mit den falschen Benutzerdaten ein Login versucht wurde.
     * @return int count
     */
    public function getFailedAuths() {
        return $_SESSION['user']['failedAuths'];
    }

    /**
     * Gibt die ID des Benutzers zurück
     * @return int id
     */
    public function getUserId() {
        return $_SESSION['user']['id'];
    }

    /**
     * Gibt den Benutzernamen zurück
     * @return String username
     */
    public function getUserName() {
        return $_SESSION['user']['name'];
    }

    /**
     * Gibt die Emailadresse des Benutzers zurück
     * @return String email
     */
    public function getUserEmail() {
        return $_SESSION['user']['email'];
    }

    /**
     * Gibt zurück ob der Benutzer ein Administrator ist
     * @return bool admin
     */
    public function isAdmin() {
        return $_SESSION['user']['admin'];
    }

    /**
     * Gibt die Anzahl der Fehler auf der aktuelle Seite zurück
     * @return int count
     */
    public function getErrorsCount() {
        return $_SESSION['debug']['errorsCount'];
    }

    /**
     * Gibt Userspezifisches logLevel zurück
     * @return int logLevel
     */
    public function getLogLevel() {
        return $_SESSION['debug']['logLevel'];
    }

    /**
     * Überprüft die Zugangsdaten des Benutzers und setzt entsprechende Session Daten
     * Zudem wird eine Instanz der Klasse User angelegt.
     * @param String username
     * @param String password
     * @return \Classes\User
     */
    public function authChallenge($username, $password) {
        if (empty($username) || empty($password)) {
            $_SESSION['user']['failedAuths']++;
            return false;
        } 

        $users = Main::MySQL()->tableAction('sas_users');
        $result = $users->select(NULL, ['username' => $username]);
        if (!$result) {
            $_SESSION['user']['failedAuths']++;
            return false;
        }

        if ($result->getRowsCount() == 0) {
            $_SESSION['user']['failedAuths']++;
            return false;
        }

        $user = $result->fetchObject();
        echo $user->password.'<br>';
        echo sha1(sha1($username).sha1($password));
        if ($user->password != sha1(sha1($username).sha1($password))) {
            $_SESSION['user']['failedAuths']++;
            return false;
        }

        $_SESSION['user']['authenticated'] = true;
        $_SESSION['user']['failedAuths'] = 0;
        $_SESSION['user']['id'] = $user->id;
        $_SESSION['user']['name'] = $user->username;
        $_SESSION['user']['email'] = $user->email;
        $_SESSION['user']['admin'] = $user->admin;

        $userInstance = new User();
        Scripting\UserScript::_OnLogin($userInstance);
        return $userInstance;
    }

    public function logout() {
        $_SESSION['user']['authenticated'] = false;
        $_SESSION['user']['failedAuths'] = 0;
        $_SESSION['user']['id'] = 0;
        $_SESSION['user']['name'] = '';
        $_SESSION['user']['email'] = '';
        $_SESSION['user']['admin'] = 0;
        $_SESSION['server']['chosen'] = false;
        $_SESSION['server']['id'] = 0;
        $_SESSION['server']['name'] = '';
        $_SESSION['server']['address'] = '';
        $_SESSION['debug']['logLevel'] = 2; //Userspezifisches logLevel (für Entwicklung)
        $_SESSION['debug']['errorsCount'] = 0;
        Scripting\UserScript::_OnLogout(Main::User());
    }

    /**
     * Login-Fehlermeldung
     * @return Errormelding
     */
    public function loginErrorMessage() {
        return '<p style="width:500px;font-family:sans-serif;font-size:14px;font-weight:700;padding:10px;margin:5px auto;border:1px solid #881414;border-radius:5px;background:#C62525;color:#fff;">Login fehlgeschlagen!</p>';
    }

    /**
     * Server Session
     * @param String
     */
    public function selectServer() {
        $_SESSION['server']['chosen'] = true;
    }

    /**
     * Setzt Server Session zurück
     * @param String
     */
    public function unselectServer() {
        $_SESSION['server']['chosen'] = false;
    }

    /**
     * Setzt neue Email
     * @param String
     */
    public function setUserEmail($newEmail) {
        $_SESSION['user']['email'] = $newEmail;
    }

    /**
     * Setzt neuen Benutzernamen
     * @param String
     */
    public function setUserName($newName) {
        $_SESSION['user']['name'] = $newName;
    }

    /**
     * Setzt neue ID
     * @param int
     */
    public function setUserId($newId) {
        $_SESSION['user']['id'] = $newId;
    }

    /**
     * Setzt neuen Admin Status
     * @param bool
     */
    public function setAdmin($admin) {
        $_SESSION['user']['admin'] = $admin;
    }

    /**
     * Setzt Server ID
     * @param int
     */
    public function setServerId($id) {
        $_SESSION['server']['id'] = $id;
    }
}

?>
