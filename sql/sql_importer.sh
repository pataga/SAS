#!/bin/bash

echo -e '##### SAS SQL IMPORTER ####\n\n\n'
read -p 'Bitte Host eingeben (zB localhost): ' host
read -p 'Bitte Benutzernamen eingeben (zB root): ' user
read -p 'Bitte Passwort eingeben (Wenn nicht festgelegt einfach ENTER): ' pw
read -p 'Bitte Datenbank eingeben (zB sas): ' db

if [ "$pw" = "" ]; then
    mysql -u$user -h$host $db < sas_full_v8.sql
    echo "Datenbank wurde eingespielt!"
    quit
fi

mysql -u$user -p$pw -h$host $db < sas_full_v8.sql
echo "Datenbank wurde eingespielt!"