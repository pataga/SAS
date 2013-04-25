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
class User {
    //Objects
    private $db, $session, $uTable, $main;
    //User Data
    private $id=0, $name, $email, $admin, $self, $password;

    /**
     * Initialisiert Instanzvariablen
     * @param Main
     * @param int id
     */
    public function __construct($id = false) {
        $this->uTable = Main::MySQL()->tableAction('sas_users');
        $this->session = Main::Session();
        $s = $this->session;

        if (!$id) {
            $this->id = $s->getUserId();
            $this->name = $s->getUserName();
            $this->email = $s->getUserEmail();
            $this->admin = $s->isAdmin();
        } else {
            $result = $this->uTable->select(NULL, ['id' => $id]);
            if ($result && $result->getRowsCount() > 0) {
                $row = $result->fetchObject();
                $this->id = $row->id;
                $this->name = $row->username;
                $this->email = $row->email;
                $this->admin = $row->admin;
                $this->self = $s->getUserId() == $this->id;
            } else {
                $res = Main::MySQL()->Query("SELECT * FROM sas_users ORDER BY id DESC LIMIT 1");
                if ($r = $res->fetchObject()) {
                    $this->id = $r->id+1;
                    $this->uTable->insert(['id' => $this->id]);
                }
            }
        }
    }

    public function getPermission() {
        return new User\Permission($this);
    }

    /**
     * Setzt neues Passwort
     * @param String
     * @return bool
     */
    public function setPassword($newPass) {
        if (!empty($newPass)) {
            $md5Hash = md5($newPass);
            $this->uTable->update(['password' => $md5Hash], ['id' => $this->id]);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Setzt neuen Benutzernamen
     * @param String
     * @return bool
     */
    public function setName($newName) {
        if (!empty($newName)) {
            $this->uTable->update(['username' => $newName], ['id' => $this->id]);
            if ($this->self) $this->session->setUserName($newName);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Setzt neue Email
     * @param String
     * @return bool
     */
    public function setEmail($newEmail) {
        if (!empty($newEmail)) {
            $this->uTable->update(['email' => $newEmail], ['id' => $this->id]);
            if ($this->self) $this->session->setUserEmail($newEmail);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Setzt Admin Berechtigung
     * @param bool
     * @return bool
     */
    public function setAdmin($newRights) {
        if (is_bool($newRights)) {
            $this->uTable->update(['admin' => ($newRights?1:0)], ['id' => $this->id]);
            if ($this->self) $this->session->setAdmin($newRights);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Löscht Benutzer dieser Instanz. Geht wenn der ausführende Benutzer nicht selbst der zu Löschende ist
     * @return bool
     */
    public function delete() {
        if (!$this->self) {
            $this->uTable->delete(['id' => $this->id]);
            return true;
        } else {
            return false;
        } 
    }

    public function saveToDB() {
        if (empty($this->password) || empty($this->username)) {
            return false;
        } else {
            $this->uTable->insert([
                'username'=>$this->username, 
                'password' => md5($this->password),
                'email' => $this->email,
                'admin' => $this->admin ? 1:0]);
        }
    }

    /**
     * Gibt ID zurück
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Gibt Benutzernamen zurück
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Gibt Email zurück
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Gibt Admin Status zurück
     */
    public function isAdmin() {
        return $this->admin;
    }
}
?>
