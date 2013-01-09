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


class User {
    //Objects
    private $db = NULL, $session = NULL, $uTable = NULL;
    //User Data
    private $id=0, $name=NULL, $email=NULL, $admin=NULL, $self = true;

    /**
     * Initialisiert Instanzvariablen
     * @param Main
     * @param int id
     */
    public function __construct($main, $id = false) {
        $this->db = $main->getMySQLInstance();
        $this->uTable = $this->db->tableAction('sas_users');
        $this->session = $main->getSession();
        $s = $this->session;
        if (!$id) {
            $this->id = $s->getUserId();
            $this->name = $s->getUserName();
            $this->email = $s->getUserEmail();
            $this->admin = $s->isAdmin();
        } else {
            $result = $this->uTable->select(NULL, ['id' => $id]);
            if ($result) {
                $row = $result->fetchObject();
                $this->id = $row->id;
                $this->name = $row->username;
                $this->email = $row->email;
                $this->admin = $row->admin;
                $this->self = $s->getUserId() == $this->id;
            }
        }
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
