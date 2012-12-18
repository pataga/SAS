<?php
    /*
     *  Mit der Klasse User, kann auf Eigenschaften eines Benutzers zugegriffen,
     *  sowie Benutzer Aktionen ausgeführt werden.
     *  Das Objekt der Klasse User heißt $user und ist aus jeder include Datei erreichbar
     */

    $user->validatePassword($password);     //Prüft, ob das übergebene Passwort mit dem des angemeldeten Benutzers übereinstimmt
    $username = $user->getUsername();       //Gibt den Benutzernamen der derzeitigen Session zurück
    $user->setUsername($username);          //Übergibt an die Klasse User den Benutzernamen
    $user->setPassword($password);          //Übergibt an die Klasse User das Passwort
    if ($user->isLoggedIn())                //Überprüft, ob der Benutzer angemeldet ist
        echo 'Angemeldet';
    else
        echo 'nicht angemeldet';

    $user->addUser($username, $password, $passwordr, $email);   //Fügt neuen Benutzer hinzu
    $user->setPermission ($sid, $permission, $active);          //Setzt Zugangsberechtigung

    $user->AuthChallenge();                 //Nimmt die Anmeldung vor. Funktioniert nur, wenn Benutzername und Passwort gesetzt wurden
    $user->Logout();                        //Meldet Benutzer ab

?>
